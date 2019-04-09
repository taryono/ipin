<form class="form-horizontal" method="POST" action="{{ route('position.store') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode Jabatan</label>
        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div>
    </div>

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
    <div class="form-group{{ $errors->has('position_category_id') ? ' has-error' : '' }}">
        <label for="position_category_id" class="col-md-4 control-label">Kategori Jabatan</label>
        <div class="col-md-6">
            <select name="position_category_id" class="form-control" id="example-getting-started">
                @foreach($position_categories as $position_category)
                <option value="{{$position_category->id}}">{{$position_category->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('position_category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('position_category_id') }}</strong>
            </span>
            @endif
        </div>
    </div>

</form>
@section('script') 
<script>
    $(function () {
        $("body").on('change', "select[name=region_id],select[name=city_id],select[name=district_id]", function () {
            $.get('/home/select_area?type=' + $(this).attr("id") + '&id=' + $(this).val(), function (res) {
                $("div." + $(this).attr("id")).html(res);
            })
        });
    });
</script>
@endsection  