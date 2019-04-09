<form class="form-horizontal" method="POST" action="{{ route('goods.update', $goods->id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" name="_method" value="PUT">
    <div class="form-group{{ $errors->has('goods_code_id') ? ' has-error' : '' }}">
        <label for="goods_code_id" class="col-md-4 control-label">Kode Barang</label>
        <div class="col-md-6">
            <select name="goods_code_id" class="form-control" id="example-getting-started">
                @foreach($goods_codes as $goods_code)
                <option value="{{$goods_code->id}}" {{$goods_code->id==$goods->goods_code_id?'selected="selected"':NULL}}>{{$goods_code->code}}</option>
                @endforeach
            </select>

            @if ($errors->has('goods_code_id'))
            <span class="help-block">
                <strong>{{ $errors->first('goods_code_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $goods->name }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Deskripsi Barang</label>

        <div class="col-md-6">
            <textarea id="description" type="text" class="form-control" name="description">{{$goods->description}}</textarea>

            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="goods" class="col-md-4 control-label">Kategori</label> 
        <div class="col-md-6">
            <select name="category_id" class="form-control example-getting-started"> 
                @foreach($categories as $k)
                <option value="{{$k->id}}" {{$k->id==$goods->category_id?'selected="selected"':NULL}}>{{ucfirst($k->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
        <label for="department_id" class="col-md-4 control-label">Department</label>
        <div class="col-md-6">
            <select name="department_id" class="form-control" id="example-getting-started">
                @foreach($departments as $department)
                <option value="{{$department->id}}" {{$department->id==$goods->department_id?'selected="selected"':NULL}}>{{$department->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('department_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
        <label for="type_id" class="col-md-4 control-label">Tipe</label>
        <div class="col-md-6">
            <select name="type_id" class="form-control" id="example-getting-started">
                @foreach($types as $type)
                <option value="{{$type->id}}" {{$type->id==$goods->type_id?'selected="selected"':NULL}}>{{$type->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('type_id'))
            <span class="help-block">
                <strong>{{ $errors->first('type_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="supplier" class="col-md-4 control-label">Supplier</label> 
        <div class="col-md-6">
            <select name="supplier_id" class="form-control example-getting-started"> 
                @foreach($suppliers as $s)
                <option value="{{$s->id}}" {{$s->id==$goods->supplier_id?'selected="selected"':NULL}}>{{ucfirst($s->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="package" class="col-md-4 control-label">Satuan</label> 
        <div class="col-md-6">
            <select name="package_id" class="form-control example-getting-started"> 
                @foreach($packages as $p)
                <option value="{{$p->id}}" {{$p->id==$goods->package_id?'selected="selected"':NULL}}>{{ucfirst($p->name)}} ({{$p?$p->symbol:""}})</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <label for="amount" class="col-md-4 control-label">Jumlah</label>

        <div class="col-md-6">
            <input id="amount" type="text" class="form-control" name="amount" value="{{ $goods->amount }}" required autofocus>

            @if ($errors->has('amount'))
            <span class="help-block">
                <strong>{{ $errors->first('amount') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="col-md-4 control-label">Harga</label>

        <div class="col-md-6">
            <input id="price" type="text" class="form-control" name="price" value="{{ $goods->price }}" required autofocus>

            @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('min_amount') ? ' has-error' : '' }}">
        <label for="min_amount" class="col-md-4 control-label">Stok Minimal</label>

        <div class="col-md-6">
            <input id="min_amount" type="text" class="form-control" name="min_amount" value="{{ $goods->min_amount }}" required autofocus> 
            @if ($errors->has('min_amount'))
            <span class="help-block">
                <strong>{{ $errors->first('min_amount') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_limit') ? ' has-error' : '' }}">
        <label for="request_limit" class="col-md-4 control-label">Bats Pemesanan</label> 
        <div class="col-md-6">
            <input id="request_limit" type="text" class="form-control" name="request_limit" value="{{ $goods->request_limit }}" required autofocus>

            @if ($errors->has('request_limit'))
            <span class="help-block">
                <strong>{{ $errors->first('request_limit') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="preview" class="col-md-4 control-label"></label> 
        <div class="col-md-6 post-review">
            <img src="/{{$goods->image}}" class="img-responsive">
        </div>
    </div>
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label for="image" class="col-md-4 control-label">Gambar Produk</label> 
        <div class="col-md-6">
            <input id="image" type="file" class="form-control post-input" name="image" value="{{ old('image') }}" autofocus>
            @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
            @endif
        </div>
    </div>
     
</form>
<script src="{{ asset('js/apps.js') }}"></script>  