<style>
    ul.multiselect-container.dropdown-menu {
        width: 201px;
        padding-left: 30px;
    }
</style>
<form class="form-horizontal" method="POST" action="{{ route('employee.update',$user->id) }}">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">
    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label for="first_name" class="col-md-4 control-label">Nama Depan</label>

        <div class="col-md-6">
            <input id="first_name" type="text" class="form-control" name="first_name" value="{{$user->user_detail?$user->user_detail->first_name:NULL}}" required autofocus>

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
            <input id="last_name" type="text" class="form-control" name="last_name" value="{{$user->user_detail?$user->user_detail->last_name:NULL}}" required autofocus>

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
            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

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
            <textarea name="address"  class="form-control" required>{{$user->user_detail?$user->user_detail->address:NULL}} </textarea>

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
            <input id="name" type="number" class="form-control" name="cellphone" value="{{$user->user_detail?$user->user_detail->cellphone:NULL}}" required autofocus>

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
            <input id="name" type="number" class="form-control" name="phone_number" value="{{$user->user_detail?$user->user_detail->phone_number:NULL}}" required autofocus>

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
            <input id="name" type="date" class="form-control" name="date_of_birth" value="{{date('Y-m-d', strtotime($user->user_detail?$user->user_detail->date_of_birth:NULL))}}" required autofocus>

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
                <input id="name" type="radio" class="radio" name="sex" value="M" required autofocus {{(($user->user_detail && $user->user_detail->sex == "M")?"checked='checked'":"")}}>Laki - laki
            </label>
            <label class="radio-inline">
                <input id="name" type="radio" class="radio" name="sex" value="F" required autofocus {{(($user->user_detail && $user->user_detail->sex == "F")?"checked='checked'":"")}}>Perempuan
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
                <option value="{{$r->id}}" {{($user->user_detail && $user->user_detail->religion_id == $r->id)?'selected="selected"':''}}>{{ucfirst($r->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="department" class="col-md-4 control-label">Department</label> 
        <div class="col-md-6">
            <select name="department_id" class="form-control example-getting-started"> 
                @foreach($departments as $d)
                <option value="{{$d->id}}" {{($user->user_detail && $user->user_detail->department_id == $d->id)?'selected="selected"':''}}>{{ucfirst($d->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="position" class="col-md-4 control-label">Jabatan</label> 
        <div class="col-md-6">
            <select name="position_id" class="form-control example-getting-started"> 
                @foreach($positions as $p)
                <option value="{{$p->id}}" {{($user->user_detail && $user->user_detail->position_id == $p->id)?'selected="selected"':''}}>{{ucfirst($p->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label for="roles" class="col-md-4 control-label">Role</label> 
        <div class="col-md-6">
            <select name="roles[]" class="form-control example-getting-started" multiple="multiple">
                @foreach($roles as $role)
                <option value="{{$role->id}}" {{($user->hasRole($role->name))?"selected='selected'":NULL}}>{{$role->name}}</option>
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