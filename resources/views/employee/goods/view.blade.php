<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">    
     
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $goods->name }}">

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
                <option value="{{$k->id}}">{{ucfirst($k->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="supplier" class="col-md-4 control-label">Supplier</label> 
        <div class="col-md-6">
            <select name="supplier_id" class="form-control example-getting-started"> 
                @foreach($suppliers as $s)
                <option value="{{$s->id}}">{{ucfirst($s->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="package" class="col-md-4 control-label">Satuan</label> 
        <div class="col-md-6">
            <select name="package_id" class="form-control example-getting-started"> 
                @foreach($packages as $p)
                <option value="{{$p->id}}">{{ucfirst($p->name)}} ({{$p?$p->symbol:""}})</option> 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <label for="amount" class="col-md-4 control-label">Jumlah</label>
        <div class="col-md-6">
            <input id="amount" type="text" class="form-control" name="amount" value="{{ $goods->amount }}">

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
            <input id="price" type="text" class="form-control" name="price" value="{{ $goods->price }}">

            @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
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

    <div class="form-group{{ $errors->has('min_amount') ? ' has-error' : '' }}">
        <label for="min_amount" class="col-md-4 control-label">Stok Minimal</label>

        <div class="col-md-6">
            <input id="min_amount" type="text" class="form-control" name="min_amount" value="{{ $goods->min_amount }}"> 
            @if ($errors->has('min_amount'))
            <span class="help-block">
                <strong>{{ $errors->first('min_amount') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_limit') ? ' has-error' : '' }}">
        <label for="request_limit" class="col-md-4 control-label">Limit Pemesanan</label> 
        <div class="col-md-6">
            <input id="request_limit" type="text" class="form-control" name="request_limit" value="{{ $goods->request_limit }}">
            @if ($errors->has('request_limit'))
            <span class="help-block">
                <strong>{{ $errors->first('request_limit') }}</strong>
            </span>
            @endif
        </div>
    </div> 
</form>