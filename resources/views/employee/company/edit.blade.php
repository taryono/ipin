<form class="form-horizontal" method="POST" action="{{ route('category.update', $category->id) }}">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" name="_method" value="PUT">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label> 
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div> 
</form>