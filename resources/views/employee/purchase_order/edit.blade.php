<form class="form-horizontal" action="{{ route('purchase_order.update', $purchase_order->id) }}">
    {{ csrf_field() }} 
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="code" class="col-md-3 control-label">Kode PO :</label> 
        <div class="col-md-6">
            <input id="name" type="text" class="form-control {{ $errors->has('code') ? ' has-error' : '' }}" name="code" value="{{$purchase_order->code}}" readonly="readonly">
            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="supplier_id" class="col-md-3 control-label">Supplier :</label> 
        <div class="col-md-6">
            <select id="supplier_id" name="supplier_id" class="form-control example-getting-started"> 
                <option value="{{$purchase_order->supplier->id}}">{{$purchase_order->supplier->name}}</option>  
            </select>
        </div> 
        @if ($errors->has('supplier_id'))
            <span class="help-block">
                <strong>{{ $errors->first('supplier_id') }}</strong>
            </span>
            @endif
    </div> 
    <div class="form-group">
        <label for="approved_by" class="col-md-3 control-label">Disetujui oleh :</label> 
        <div class="col-md-6"> 
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="{{$purchase_order->approved_by}}" required autofocus placeholder="Disetujui oleh">
        </div> 
    </div>
    <div class="form-group">
        <label for="approval_date" class="col-md-3 control-label">Tgl Disetujui :</label> 
        <div class="col-md-6"> 
            <input id="approval_date" type="date" class="form-control" name="approval_date" value="{{$purchase_order->approval_date}}" required autofocus placeholder="Tanggal Disetujui">
        </div> 
    </div>
    <div class="form-group">
        <label for="purchase_date" class="col-md-3 control-label">Tanggal Pembelian :</label> 
        <div class="col-md-4">
            <input id="purchase_date" type="date" class="form-control {{ $errors->has('purchase_date') ? ' has-error' : '' }}" name="purchase_date" value="{{$purchase_order->purchase_date}}">
            @if ($errors->has('purchase_date'))
            <span class="help-block">
                <strong>{{ $errors->first('purchase_date') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="request_receive_date" class="col-md-3 control-label">Tanggal Diterima :</label> 
        <div class="col-md-4">
            <input id="request_receive_date" type="date" class="form-control {{ $errors->has('request_receive_date') ? ' has-error' : '' }}" name="request_receive_date" value="{{$purchase_order->request_receive_date}}">
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
            <textarea id="description"  class="form-control" name="description" required>{{$purchase_order->description}}</textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="code" class="col-md-3 control-label">Status Pemesanan :</label> 
        <div class="col-md-6">
            <select id="status_id" name="status_id" class="form-control example-getting-started"> 
                <option value="">--Pilih Status--</option> 
                @foreach($statutes as $s)
                <option value="{{$s->id}}" {{($purchase_order->status_id==$s->id)?'selected="selected"':''}}>{{ucfirst($s->name)}}</option> 
                @endforeach
            </select>
        </div> 
    </div>
    <div class="row list-goods"> 
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Barang</div>
                <div class="panel-body" style="overflow: auto">
                    <input type="text" name="search" class="form-control data-table-search-goods" placeholder="Search.." style="width: 20% !important">
                    <br>
                    <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
                        <thead>
                            <tr class="header">  
                                <th scope="col">#</th>  
                                <th>Nama</th>  
                                <th>Stok</th> 
                                <th>Harga</th> 
                                <th nowrap="nowrap">Batas Pesan</th> 
                                <th>Jumlah Pesan</th>  
                                <th>Jumlah Diterima</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            @if($purchase_order->purchase_order_detail->count() > 0)
                            @foreach($purchase_order->purchase_order_detail as $key => $s)
                            @php $c = $s->goods;@endphp
                            <tr class="ordering-list-all"> 
                                <th><input class="checked" type="checkbox" name="goods_ids[]" data-good_id="{{$c->id}}" value="{{$c->id}}" data-check="unchecked" checked="checked"></th> 
                                <th>{{$c->name}}</th>  
                                <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                                <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                                <th>{{rupiahFormat($c->price)}}</th> 
                                <th>{{$c->purchase_limit}}</th> 
                                <th>
                                    <input type="hidden" name="prices[{{$c->id}}]" value="{{$c->price}}">
                                    <input class="amount amount{{$c->id}}" type="text" value="{{$s->amount}}" name="request_amounts[{{$c->id}}]" size="2" data-purchase_limit="{{$c->purchase_limit}}">
                                </th>  
                                <th> 
                                    <input class="amount amount{{$c->id}}" type="text" value="{{$s->received_amount}}" name="received_amounts[{{$c->id}}]" size="2">
                                </th>
                            </tr>
                            @endforeach
                            @foreach($goods as $good)
                            <tr class="ordering-list-all ordering-list"> 
                                <th><input class="checked" type="checkbox" name="goods_ids[]" data-good_id="{{$good->id}}" value="{{$good->id}}" data-check="unchecked"></th> 
                                <th>{{$good->name}}</th>  
                                <?php $color = ($good->amount <= $good->min_amount) ? 'red' : "green" ?>
                                <th style="color:{{$color}}; font-weight:bold;">{{$good->amount}} ({{$good->package?$good->package->symbol:""}})</th> 
                                <th>{{rupiahFormat($good->price)}}</th> 
                                <th>{{$good->purchase_limit}}</th> 
                                <th>
                                    <input type="hidden" name="prices[{{$good->id}}]" value="{{$good->price}}">
                                    <input disabled="disabled" class="amount amount{{$good->id}}" type="text"  name="request_amounts[{{$good->id}}]" size="2" data-purchase_limit="{{$good->purchase_limit}}">
                                </th>  
                            </tr>
                            @endforeach                            
                            @else
                            <tr> 
                                <th colspan="9"> 
                                    <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
                                </th> 
                            </tr>
                            @endif
                        </tbody> 
                    </table>  
                </div> 
            </div>
            <div class="table-list-footer">
                <span class="result-count-modal"></span> 
            </div>
        </div>
    </div> 
</form> 

<script type="text/javascript">
    $(function () {
        pagination(".data-table tbody tr.ordering-list-all", '.result-count-modal'); 
        $(".checked").click(function (e) {
            $id = $(this).attr('data-good_id');
            if ($(this).prop('checked')) {
                $("input.amount" + $id).removeAttr('disabled', 'disabled');
                $(this).parent().parent().removeClass('ordering-list');
            } else {
                $("input.amount" + $id).attr('disabled', 'disabled');
                $("input.amount" + $id).val("");
                $(this).parent().parent().addClass('ordering-list');
            }
        });

        $(".amount").keyup(function (e) {
            $purchase_limit = $(this).attr('data-purchase_limit');
            if (parseInt($(this).val()) > parseInt($purchase_limit)) {
                alert('Tidak boleh melebihi batas pesan. Pesan:' + $(this).val() + " Batas:" + $purchase_limit);
                $(this).val($purchase_limit)
            }
            if (parseInt($(this).val()) < 1) {
                alert('Tidak boleh 0 atau kosong:' + $(this).val() + " Batas:" + $purchase_limit);
                $(this).val($purchase_limit)
            }
            
        });
        $("input.data-table-search-goods").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".data-table tr.ordering-list").filter(function (e) {
                var checkbox = $(this).find('input.checked_ids');
                if (checkbox.prop('checked', false)) {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                }

            });
        });

        $(".amount").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }

                    if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).val(0);
                    }
                });
    });
</script>