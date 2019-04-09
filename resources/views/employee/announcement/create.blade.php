<form class="form-horizontal" method="POST" action="{{ route('announcement.store') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>
        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label for="content" class="col-md-4 control-label">Content</label>
        <div class="col-md-6">
            <textarea id="content"  class="form-control" name="content" required></textarea>

            @if ($errors->has('content'))
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('from_department_id') ? ' has-error' : '' }}">
        <label for="from_department_id" class="col-md-4 control-label">Dari Department</label>

        <div class="col-md-6">
            <select name="from_department_id" class="form-control  example-getting-started">
                @foreach($departments as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('from_department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('from_department_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('to_department_id') ? ' has-error' : '' }}">
        <label for="to_department_id" class="col-md-4 control-label">Untuk Departmen</label>

        <div class="col-md-6">
            <select name="to_department_id" class="form-control  example-getting-started">
                @foreach($departments as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('to_department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('to_department_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
        <label for="icon" class="col-md-4 control-label">Icon</label>

        <div class="col-md-6">
            <input type="file" class="form-control" name="icon" value="{{ old('icon') }}" required>
            @if ($errors->has('icon'))
            <span class="help-block">
                <strong>{{ $errors->first('icon') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="is_publish" class="col-md-4 control-label">Status</label> 
        <div class="col-md-6">
            <select name="is_publish" class="form-control  example-getting-started">
                @foreach(['1'=> 'Publish','2'=> 'Draft'] as $key=> $value)
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div> 
</form> 
<script type="text/javascript">
    $(function () {
        $("select#city,select#district,select#subdistrict").change( function () {
            var id = $(this).attr("id"); 
            $.get('/home/select_area?type=' + $(this).attr("id") + '&id=' + $(this).val(), function (res) {                
                $("div." + id).html(res);
            })
        });
    });
</script> 