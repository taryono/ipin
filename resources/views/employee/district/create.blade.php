<form class="form-horizontal" method="POST" action="{{ route('district.store') }}">
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
        <label for="city" class="col-md-4 control-label">Kota Kabupaten</label> 
        <div class="col-md-6">
            <select name="city_id" class="form-control example-getting-started"> 
                @foreach($cities as $r)
                <option value="{{$r->id}}">{{ucfirst($r->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div> 
</form>