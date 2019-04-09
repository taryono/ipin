<form class="form-horizontal" method="POST" action="{{ route('city.store') }}">
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
    <div class="form-group">
        <label for="region" class="col-md-4 control-label">Provinsi</label> 
        <div class="col-md-6">
            <select name="region_id" class="form-control example-getting-started"> 
                @foreach($regions as $r)
                <option value="{{$r->id}}">{{ucfirst($r->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div> 
</form>