<style>
    ul.multiselect-container.dropdown-menu {
        width: 201px;
        padding-left: 30px;
    }
</style>
<form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">Alamat Email</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Konfirmasi Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
    <div class="form-group">
        <label for="role" class="col-md-4 control-label">Role</label>

        <div class="col-md-6">
            <select name="roles[]" class="form-control example-getting-started" multiple="multiple">
                @foreach($roles as $role)
                <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div> 
</form>

<script>
    $(document).ready(function () {
        $('.example-getting-started').multiselect({
            enableFiltering: true,
        });
    });
</script> 