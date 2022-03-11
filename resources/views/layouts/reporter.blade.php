@if(!$errors->isEmpty())
<div class="alert alert-danger">
    {{$errors->first()}}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <div class="alert alert-{{ $msg }}">
        	{{ Session::get($msg) }}
        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif
@endforeach