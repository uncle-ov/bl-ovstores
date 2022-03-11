<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ShopSetting;
use App\Models\ShippingAddress;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Cookie;

class CartController extends Controller
{
    //
    public function index() {
        $shop_setting = ShopSetting::first();
        // dd($products);
        return view('cart', [
            'cart_items' => $this->getCartItems(),
            'shop_settings' => $shop_setting,
        ]);
    }

    public function checkout() {
        $shop_setting = ShopSetting::first();
        $cart_items = $this->getCartItems();
        $discount = 0;
        $shipping = 0;

        if(empty(count($cart_items))) return redirect('/cart');

        $subtotal = 0;
        foreach ($cart_items as $key => $item) {
            $subtotal += ($item->quantity * $item->product->price);
        }

        $data = [
            'cart_items' => $cart_items,
            'shop_settings' => $shop_setting,
            'user' => $this->getUser(),
            'summary' => [
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $subtotal + $shipping - $discount,
            ],
        ];

        // dd($data);
        return view('checkout', $data);
    }

    public function submitCheckout(Request $request) {
        $data = $request->all();
        $validate_fields = [
            'firstname' => 'required',
            'lastname' => 'required',
            "address" => 'required',
            "city" => 'required',
            "postal_code" => 'required',
            "country" => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'payment_method' => 'required',
            'accept_terms' => 'required',
        ];

        if(!empty($data['checkout_create_account'])) {
            $validate_fields['email'] = 'required|unique:users|max:255';
            $validate_fields['password'] = 'required|confirmed|min:6';
        }

        $request->validate($validate_fields);

        if(!Auth::guest()) {
            $user = Auth::user();
            $user_id = $user->id;
        } else {
            $user_id = 0;
        }

        if(!empty($data['checkout_create_account'])) {
            // Create new user
            $user_details = [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'password' => $data['password'],
            ];
            $user_id = app(\App\Http\Controllers\UserController::class)->registerUser($user_details);

            if (Auth::attempt([
                'email' => $data['email'],
                'password' => $data['password'],
            ])) {
                $request->session()->regenerate();
            }
        }

        if(!empty($user_id)) {
            // Save shipping details
            ShippingAddress::updateOrCreate([
                "user_id"           => $user_id,
            ], [
                "user_id"           => $user_id,
                "address"           => $data['address'],
                "city"              => $data['city'],
                "postal_code"       => $data['postal_code'],
                "country"           => $data['country'],    
                "phone"             => $data['phone'],
            ]);
        }

        $shop_setting = ShopSetting::first();
        $cart_items = $this->getCartItems();
        $discount = 0;
        $shipping = 0;

        if(empty($cart_items)) return redirect('/cart');

        $subtotal = 0;
        foreach ($cart_items as $key => $item) {
            $subtotal += ($item->quantity * $item->product->price);
        }

        $total = $subtotal + $shipping - $discount;

        $shipping_details = [
            "firstname"         => $data['firstname'],
            "lastname"          => $data['lastname'],
            "phone"             => $data['phone'],
            "email"             => $data['email'],
            "address"           => $data['address'],
            "city"              => $data['city'],
            "postal_code"       => $data['postal_code'],
            "country"           => $data['country'],
        ];

        $order_id = Order::insertGetId([
            'user_id' => $user_id,
            'payment_id' => 0,
            'currency' => $shop_setting->currency,
            'payment_method' => $data['payment_method'],
            'shipping_amount' => $shipping,
            'discount_amount' => $discount,
            'total_amount' => $total,
            'shipping_details' => json_encode($shipping_details),
            'status' => 'pending',
        ]);

        foreach ($cart_items as $key => $item) {
            $subtotal += ($item->quantity * $item->product->price);
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $this->clearCartItems();

        return redirect('/checkout/success/'.$order_id);
    }

    public function checkoutSuccess($order_id) {
        $order = Order::find($order_id);

        if(empty($order)) {
            return redirect('/cart');
        }

        return view('checkout_success', [
            'order' => $order,
        ]);
    }

    private function addItem($item) {
        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        $match = [
            'user_id' => $user_id,
            'guest_id' => $guest_id,
            'product_id' => $item['product_id']
        ];

        $cart_item = array_merge($match, $item);

        CartItem::updateOrCreate($match, $cart_item);

        return true;
    }

    private function getUser() {
        $default_shipping = (object) [
            'address' => '',
            'city' => '',
            'postal_code' => '',
            'country' => '',
            'phone' => '',
        ];

        if(Auth::guest()) {
            return (object) [
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'phone' => '',
                'shipping_address' => $default_shipping,
            ];
        } else {
            // Use database
            $user = Auth::user();
            $shipping_address = ShippingAddress::where('user_id', $user->id)->first();

            $user->shipping_address = !empty($shipping_address) ? $shipping_address : $default_shipping;
            return $user;
        }
    }

    private function getUserID() {
        if(Auth::guest()) {
            $guest_id = Cookie::get('guest_id');
            $user_id = 0;

            if(empty($guest_id)) {
                $guest_id = 'guest_'.date('Ymd.His').rand(1000000, 9999999);
                Cookie::queue('guest_id', $guest_id, (60*24*365));//1yr
            }
        } else {
            // Use database
            $user = Auth::user();
            $user_id = $user->id;

            if(!empty($guest_id)) {
                // update the db
                CartItem::where('guest_id', $guest_id)->update([
                    'user_id' => $user_id,
                    'guest_id' => '',
                ]);

                Cookie::queue('guest_id', '', -120);
            }

            $guest_id = '';
        }

        return ['user_id' => $user_id, 'guest_id' => $guest_id];
    }

    public function removeCartItem($item_id) {
        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        CartItem::where('id', $item_id)
                ->where('user_id', $user_id)
                ->where('guest_id', $guest_id)
                ->delete();

        return redirect()->back()->with('success', 'This item was successfully removed from cart');
    }

    public function getCartItems() {
        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        return CartItem::where('user_id', $user_id)
                ->where('guest_id', $guest_id)
                ->get();
    }

    public function clearCartItems() {
        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        return CartItem::where('user_id', $user_id)
                ->where('guest_id', $guest_id)
                ->delete();
    }

    public function addToCart(Request $request) {
        $data = $request->all();

        if(empty($pid)) return redirect()->back();
        $pid = $pid;
        
        $product = Product::where('id', $pid)->first();

        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        $saved_cart_item = CartItem::where('user_id', $user_id)
                ->where('guest_id', $guest_id)
                ->where('product_id', $pid)
                ->first();

        if(empty($product)) return redirect()->back();

        $quantity = intval($data['quantity']);

        if(empty($quantity) || $quantity < 1) {
            // remove item
            return redirect()->back()->with('error', 'Please enter a valid quantity.');
        }

        if(!empty($saved_cart_item)) {
            $quantity += intval($saved_cart_item->quantity);
        }

        // Build cart
        $cart_item = [
            'product_id' => $pid,
            'size' => !empty($data['size']) ? $data['size'] : '',
            'quantity' => $quantity,
        ];

        $this->addItem($cart_item);

        if(!empty($data['buy_now'])) {
            return redirect('/checkout');
        }

        return redirect()->back()->with('success', 'This item was successfully added to cart');
    }

    public function addToCartNow($pid, $type) {
        $ids = $this->getUserID();
        extract($ids); //$user_id and $guest_id

        $product = Product::where('id', $pid)->first();

        $saved_cart_item = CartItem::where('user_id', $user_id)
                ->where('guest_id', $guest_id)
                ->where('product_id', $pid)
                ->first();

        if(empty($product)) return redirect()->back();

        $quantity = 1;

        if(!empty($saved_cart_item)) {
            $quantity += intval($saved_cart_item->quantity);
        }

        // Build cart
        $cart_item = [
            'product_id' => $pid,
            'size' => '',
            'quantity' => $quantity,
        ];

        $this->addItem($cart_item);

        if(!empty($type == 'buy')) {
            return redirect('/checkout');
        }

        return redirect()->back()
                ->with('success', 'An item was successfully added to cart');
    }

    public function removeFromCart($id) {
        $this->removeCartItem($id);
        return redirect()
                ->back()
                ->with('success', 'An item was removed from cart.');
    }
}
