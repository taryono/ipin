<style>
#code{
    text-transform: uppercase;
}
</style>
<form class="form-horizontal" method="POST" action="{{ route('supplier.store') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        <label for="code" class="col-md-4 control-label">Kode</label>
        <div class="col-md-6">
            <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus minlength="3" maxlength="3" style="width: 60px;">

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
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
        <label for="cellphone" class="col-md-4 control-label">Handphone</label>

        <div class="col-md-6">
            <input id="name" type="number" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required autofocus>

            @if ($errors->has('cellphone'))
            <span class="help-block">
                <strong>{{ $errors->first('cellphone') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone" class="col-md-4 control-label">No Telp</label>

        <div class="col-md-6">
            <input id="name" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

            @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label for="address" class="col-md-4 control-label">Alamat</label>

        <div class="col-md-6">
            <textarea id="address" type="address" class="form-control" name="address" value="{{ old('address') }}" required></textarea>

            @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="country" class="col-md-4 control-label">Negara</label> 
        <div class="col-md-6">
            <select name="country_id" class="form-control  example-getting-started">
                @foreach($countries as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="region" class="col-md-4 control-label">Provinsi</label> 
        <div class="col-md-6 region">
            <select name="region_id" class="form-control example-getting-started" id="city">
                @foreach($regions as $r)
                <option value="{{$r->id}}">{{$r->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="city" class="col-md-4 control-label">Kabupaten</label> 
        <div class="col-md-6 city">
            <select name="city_id" class="form-control example-getting-started" id="district"> 
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="district" class="col-md-4 control-label">Kecamatan</label> 
        <div class="col-md-6 district">
            <select name="district_id" class="form-control example-getting-started" id="subdistrict"> 
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="subdistrict" class="col-md-4 control-label">Kecamatan</label> 
        <div class="col-md-6 subdistrict">
            <select name="subdistrict_id" class="form-control example-getting-started"> 
            </select>
        </div>
    </div> 
</form> 
<script type="text/javascript">
    $(function () {
        $("select#city,select#district,select#subdistrict").change( function () {
            var id = $(this).attr("id"); 
            $.get('/home/select_area?type=' + $(this).attr("id") + '&id=' + $(this).val(), function (res) {                
                $("div." + id).html(res);
            })
        }); 
    });
</script> 