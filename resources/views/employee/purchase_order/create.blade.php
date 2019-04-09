<form class="form-horizontal" method="POST" action="{{ route('purchase_order.store') }}">
    {{ csrf_field() }} 
    <div class="form-group">
        <label for="code" class="col-md-3 control-label">Kode PO :</label> 
        <div class="col-md-6">
            <input id="name" type="text" class="form-control {{ $errors->has('request_date') ? ' has-error' : '' }}" name="code" value="<?php echo App\Libraries\MailLib::generatePOCode() ?>" readonly="readonly">
            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="code" class="col-md-3 control-label">Supplier :</label> 
        <div class="col-md-6">
            <select id="supplier_id" name="supplier_id" class="form-control example-getting-started"> 
                <option value="">--Pilih Supplier--</option> 
                @foreach($suppliers as $sup)
                <option value="{{$sup->id}}">{{ucfirst($sup->name)}}</option> 
                @endforeach
            </select>
        </div> 
    </div>
    <div class="form-group">
        <label for="approved_by" class="col-md-3 control-label">Disetujui oleh :</label> 
        <div class="col-md-6"> 
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="" required autofocus placeholder="Disetujui oleh">
             
        </div> 
    </div>
    <div class="form-group">
        <label for="approval_date" class="col-md-3 control-label">Tgl Disetujui :</label> 
        <div class="col-md-6"> 
            <input id="approval_date" type="date" class="form-control" name="approval_date" value="" required autofocus placeholder="Tanggal Disetujui">
             
        </div> 
    </div>
    <div class="form-group">
        <label for="purchase_date" class="col-md-3 control-label">Tanggal Pembelian :</label> 
        <div class="col-md-6">
            <input id="purchase_date" type="date" class="form-control {{ $errors->has('purchase_date') ? ' has-error' : '' }}" name="purchase_date">
            @if ($errors->has('purchase_date'))
            <span class="help-block">
                <strong>{{ $errors->first('purchase_date') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="request_receive_date" class="col-md-3 control-label">Tanggal Diterima :</label> 
        <div class="col-md-6">
            <input id="request_receive_date" type="date" class="form-control {{ $errors->has('request_receive_date') ? ' has-error' : '' }}" name="request_receive_date">
            @if ($errors->has('request_receive_date'))
            <span class="help-block">
                <strong>{{ $errors->first('request_receive_date') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="description" class="col-md-3 control-label">Keterangan :</label> 
        <div class="col-md-6"> 
            <textarea id="description"  class="form-control" name="description" required></textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    
    <div class="row hide list-goods"> 
    </div> 
</form> 
<script type="text/javascript">
    $(document).ready(function () { 
        $("#supplier_id").change(function (e) {
            $id = $(this).val(); 
            $.get('{{route("purchase_order.list_by_supplier")}}?id='+$id, function(res){
                $(".list-goods").removeClass("hide");
                $(".list-goods").html(res);
            });
        });
    });
</script> 