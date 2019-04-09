<style>
    ul.multiselect-container.dropdown-menu {
        width: 201px;
        padding-left: 30px;
    }
</style>
<form class="form-horizontal" method="POST" action="{{ route('employee.store') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label for="first_name" class="col-md-4 control-label">Nama Depan</label>

        <div class="col-md-6">
            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

            @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        <label for="last_name" class="col-md-4 control-label">Nama Belakang</label>

        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

            @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
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
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            <textarea name="address"  class="form-control" required>{{ old('address') }} </textarea>

            @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
        <label for="cellphone" class="col-md-4 control-label">Handphone</label>

        <div class="col-md-6">
            <input id="cellphone" type="number" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required autofocus>

            @if ($errors->has('cellphone'))
            <span class="help-block">
                <strong>{{ $errors->first('cellphone') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
        <label for="phone_number" class="col-md-4 control-label">No Telp</label>

        <div class="col-md-6">
            <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

            @if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
        <label for="date_of_birth" class="col-md-4 control-label">Tanggal Lahir</label>

        <div class="col-md-6">
            <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}" required autofocus>

            @if ($errors->has('date_of_birth'))
            <span class="help-block">
                <strong>{{ $errors->first('date_of_birth') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
        <label for="sex" class="col-md-4 control-label">Jenis Kelamin</label>

        <div class="col-md-6"> 
            <label class="radio-inline">
                <input id="sexM" type="radio" class="radio" name="sex" value="M" required autofocus checked>Laki - laki
            </label>
            <label class="radio-inline">
                <input id="sexF" type="radio" class="radio" name="sex" value="F" required autofocus>Perempuan
            </label>
            @if ($errors->has('sex'))
            <span class="help-block">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="religion" class="col-md-4 control-label">Agama</label> 
        <div class="col-md-6">
            <select name="religion_id" class="form-control example-getting-started"> 
                @foreach($religions as $r)
                <option value="{{$r->id}}">{{ucfirst($r->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="department" class="col-md-4 control-label">Department</label> 
        <div class="col-md-6">
            <select name="department_id" class="form-control example-getting-started"> 
                @foreach($departments as $d)
                <option value="{{$d->id}}">{{ucfirst($d->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="position" class="col-md-4 control-label">Jabatan</label> 
        <div class="col-md-6">
            <select name="position_id" class="form-control example-getting-started"> 
                @foreach($positions as $p)
                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="role" class="col-md-4 control-label">Role</label> 
        <div class="col-md-6">
            <select name="roles[]" class="form-control example-getting-started" multiple="multiple">
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
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