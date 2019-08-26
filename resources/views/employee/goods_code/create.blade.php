<form class="form-horizontal" method="POST" action="{{ route('goods_code.store') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode</label>
        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus maxlength="2" style="width: 60px;">

            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('goods_type_id') ? ' has-error' : '' }}">
        <label for="goods_type_id" class="col-md-4 control-label">Tipe</label>

        <div class="col-md-6">
            @if($goods_types->count() > 0)
            <select name="goods_type_id" class="form-control example-getting-started">  
                @foreach($goods_types as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('goods_type_id'))
            <span class="help-block">
                <strong>{{ $errors->first('goods_type_id') }}</strong>
            </span>
            @endif 
            @else 
            Tipe barang belum dibuat
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label for="category_id" class="col-md-4 control-label">Kategori</label>

        <div class="col-md-6">
            @if($goods_categories->count() > 0)
            <select name="category_id" class="form-control example-getting-started">  
                @foreach($goods_categories as $goods_category)
                <option value="{{$goods_category->id}}">{{$goods_category->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
            @endif 
            @else 
            Kategori barang belum dibuat
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