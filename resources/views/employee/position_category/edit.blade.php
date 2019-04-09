<form class="form-horizontal" method="POST" action="{{ route('position_category.update', $position_category->id) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode Kategori Jabatan</label>
        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="{{ $position_category->code }}" required autofocus maxlength="4" style="width: 60px;">

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
            <input id="name" type="text" class="form-control" name="name" value="{{ $position_category->name }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>
</form>