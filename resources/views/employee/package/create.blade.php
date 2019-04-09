<form class="form-horizontal" method="POST" action="{{ route('package.store') }}">
    {{ csrf_field() }}

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
    <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
        <label for="symbol" class="col-md-4 control-label">Symbol</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="symbol" value="{{ old('symbol') }}" required autofocus>

            @if ($errors->has('symbol'))
            <span class="help-block">
                <strong>{{ $errors->first('symbol') }}</strong>
            </span>
            @endif
        </div>
    </div> 
</form>