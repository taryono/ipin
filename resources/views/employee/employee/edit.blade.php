<style>
    ul.multiselect-container.dropdown-menu {
        width: 201px;
        padding-left: 30px;
    }
</style>
<form class="form-horizontal" method="POST" action="{{ route('employee.update',$employee->id) }}">
    <input type="hidden" class="form-control" name="_method" value="PUT">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{$employee->name}}" required autofocus>

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
            <input id="email" type="email" class="form-control" name="email" value="{{$employee->email}}" required>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
    </div> 
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            <textarea name="address"  class="form-control" required>{{$employee->address}} </textarea>

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
            <input id="name" type="number" class="form-control" name="cellphone" value="{{$employee->cellphone}}" required autofocus>

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
            <input id="name" type="text" class="form-control" name="phone_number" value="{{$employee->phone_number}}" required autofocus>

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
            <input id="name" type="date" class="form-control" name="date_of_birth" value="{{$employee->date_of_birth}}" required autofocus>

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
                <input id="name" type="radio" class="radio" name="sex" value="M" required autofocus {{(($employee->sex == "M")?"checked='checked'":"")}}>Laki - laki 
            </label>
            <label class="radio-inline">
                <input id="name" type="radio" class="radio" name="sex" value="F" required autofocus {{(($employee->sex == "F")?"checked='checked'":"")}}>Perempuan
            </label>
            @if ($errors->has('sex'))
            <span class="help-block">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="position" class="col-md-4 control-label">Jabatan</label> 
        <div class="col-md-6">
            <select name="position" class="form-control"> 
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
                <option value="hrd">HRD</option>
                <option value="finance">Finance</option>
                <option value="supervisor">Supervisor</option>

            </select>
        </div>
    </div>
    <?php
    $rs = [];
    foreach ($employee->user->roles()->get() as $r) {
        $rs[] = $r->name;
    }
    ?>
    <div class="form-group">
        <label for="roles" class="col-md-4 control-label">Role</label> 
        <div class="col-md-6">
            <select name="roles[]" class="form-control example-getting-started" multiple="multiple">
                @foreach($roles as $role)
                <option value="{{$role->name}}" {{(in_array($role->name,$rs))?"selected='selected'":NULL}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div> 
</form>