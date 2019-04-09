<form class="form-horizontal" method="POST" action="{{ route('role.update',$role->id) }}">
    <input type="hidden" class="form-control" name="_method" value="PUT">
{{ csrf_field() }} 
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Nama</label>

    <div class="col-md-6"> 
        <input id="name" type="text" class="form-control" name="name" value="{{ $role->name }}" required autofocus>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <input id="email" type="text" class="form-control" name="description" value="{{ $role->description }}" required>

        @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>
</div> 
</form>