<form class="form-horizontal" method="POST" action="{{ route('group_menu.update',$group->id) }}">
    <input type="hidden" class="form-control" name="_method" value="PUT">
    {{ csrf_field() }} 
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label> 
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{$group->name}}" required autofocus placeholder="menu.edit">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div> 
    <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
        <label for="icon" class="col-md-4 control-label">Nama</label> 
        <div class="col-md-6">
            <input id="icon" type="text" class="form-control" name="icon" value="{{$group->icon}}" required autofocus placeholder="menu.edit">
            @if ($errors->has('icon'))
            <span class="help-block">
                <strong>{{ $errors->first('icon') }}</strong>
            </span>
            @endif
        </div>
    </div> 
    <div class="form-group">
        <label for="is_published" class="col-md-4 control-label">Status</label> 
        <div class="col-md-6">
            <select name="is_published" class="form-control"> 
                <option value="0" {{($group->is_published == 0)?'selected="selected"':''}}>Tidak Aktif</option>                       
                <option value="1" {{($group->is_published == 1)?'selected="selected"':''}}">Aktif</option>
            </select>
        </div>
    </div>  
</form>