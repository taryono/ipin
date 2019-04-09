<form class="form-horizontal" method="POST" action="{{ route('district.update', $subdistrict->id) }}">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" name="_method" value="PUT">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Nama</label> 
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $subdistrict->name }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="district" class="col-md-4 control-label">Kota Kabupaten</label> 
        <div class="col-md-6">
            <select name="district_id" class="form-control example-getting-started"> 
                @foreach($districts as $r)
                <option value="{{$r->id}}" {{($r->id == $subdistrict->district_id)?'selected="selected"':NULL}}>{{ucfirst($r->name)}}</option> 
                @endforeach
            </select>
        </div>
    </div> 
</form>