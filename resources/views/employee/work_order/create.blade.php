<form class="form-horizontal" method="POST" action="{{ route('work_order.store') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode</label>

        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="<?php echo App\Libraries\MailLib::generateWOCode() ?>" readonly>

            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
        <label for="status" class="col-md-4 control-label">Customer</label>

        <div class="col-md-6">
            <select name="customer_id" class="form-control example-getting-started">  
                @foreach($customers as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('customer_id'))
            <span class="help-block">
                <strong>{{ $errors->first('customer_id') }}</strong>
            </span>
            @endif 
        </div>
    </div> 
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Keterangan</label>
        <div class="col-md-6">
            <textarea id="description" name="description" class="form-control text-left" style="text-align: left">
                                    {{ old('description') }}
            </textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        <label for="date" class="col-md-4 control-label">Tanggal Pembuatan</label>

        <div class="col-md-6">
            <input id="description" type="date" class="form-control" name="date" value="{{ old('date') }}" required autofocus>

            @if ($errors->has('date'))
            <span class="help-block">
                <strong>{{ $errors->first('date') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_by') ? ' has-error' : '' }}">
        <label for="request_by" class="col-md-4 control-label">Dibuat Oleh</label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control" name="request_by" value="{{ old('request_by') }}" required autofocus>

            @if ($errors->has('request_by'))
            <span class="help-block">
                <strong>{{ $errors->first('request_by   ') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('target_date') ? ' has-error' : '' }}">
        <label for="target_date" class="col-md-4 control-label">Tanggal Janji Selesai</label>

        <div class="col-md-6">
            <input id="description" type="date" class="form-control" name="target_date" value="{{ old('target_date') }}" required autofocus>

            @if ($errors->has('target_date'))
            <span class="help-block">
                <strong>{{ $errors->first('target_date   ') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label for="status" class="col-md-4 control-label">Status</label>

        <div class="col-md-6">
            <select name="status" class="form-control example-getting-started"> 
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
            @if ($errors->has('status'))
            <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
            @endif
            @if ($errors->has('status'))
            <span class="help-block">
                <strong>{{ $errors->first('status   ') }}</strong>
            </span>
            @endif
        </div>
    </div>  
</form>