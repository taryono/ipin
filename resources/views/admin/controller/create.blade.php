<form class="form-horizontal" method="POST" action="{{ route('controller.store') }}">
    {{ csrf_field() }} 
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
        <div class="col-md-3"><label for="name" class="col-md-11 control-label">Path </label></div>
        <div class="col-md-4"><input  class="form-control"  type="text" value="\\App\\Http\\Controllers\\" readonly="readonly" size="30%"></div>
        <div class="col-md-5"> 
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Admin\RoleController">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div> 
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
        <div class="col-md-7"><label for="title" class="col-md-11 control-label">Title</label></div> 
        <div class="col-md-5"> 
            <input id="name" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus placeholder="role">
            @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
    </div> 
    <div class="form-group{{ $errors->has('group_menu_id') ? ' has-error' : '' }}">
        <label for="group_menu_id" class="col-md-7 control-label">Group Menu</label>

        <div class="col-md-5"> 
            <select name="group_menu_id" class="form-control example-getting-started"> 
                @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>  
                @endforeach
            </select>
            @if ($errors->has('group_menu_id'))
            <span class="help-block">
                <strong>{{ $errors->first('group_menu_id') }}</strong>
            </span>
            @endif
        </div>
    </div>  
    <div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
        <label for="sequence" class="col-md-7 control-label">Group Menu</label>

        <div class="col-md-5"> 
            <input id="sequence" type="number" class="form-control" name="sequence" value="{{ old('sequence') }}" required autofocus placeholder="Urutan ke" size="2">
            @if ($errors->has('sequence'))
            <span class="help-block">
                <strong>{{ $errors->first('sequence') }}</strong>
            </span>
            @endif
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