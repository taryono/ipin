<form class="form-horizontal" method="POST" action="{{ route('goods_code.update', $goods_code->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode</label>
        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="{{ $goods_code->code }}" required autofocus maxlength="4" style="width: 60px;">

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
                <option value="{{$c->id}}" {{($goods_code->goods_type_id == $c->id)?'selected="selected"':''}}>{{$c->name}}</option>
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
        <label for="category_id" class="col-md-4 control-label">Tipe</label>

        <div class="col-md-6">
            @if($goods_categories->count() > 0)
            <select name="category_id" class="form-control example-getting-started">  
                @foreach($goods_categories as $goods_category)
                <option value="{{$goods_category->id}}" {{($goods_code->category_id == $goods_category->id)?'selected="selected"':''}}>{{$goods_category->name}}</option>
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
            <input id="name" type="text" class="form-control" name="name" value="{{ $goods_code->name }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div> 
</form>