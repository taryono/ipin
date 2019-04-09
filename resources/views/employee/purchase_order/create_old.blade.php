<form class="form-horizontal" method="POST" action="{{ route('purchase_order.store') }}">
    {{ csrf_field() }} 
    <div class="form-group">
        <label for="code" class="col-md-2 control-label">Kode PO :</label> 
        <div class="col-md-2">
            <input id="name" type="text" class="form-control {{ $errors->has('request_date') ? ' has-error' : '' }}" name="code" value="<?php echo App\Libraries\MailLib::generatePOCode() ?>" readonly="readonly">
            @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6"></div>

    </div>
    <div class="form-group">
        <label for="order_date" class="col-md-2 control-label">Tanggal PO :</label> 
        <div class="col-md-2">
            <input id="name" type="text" class="form-control {{ $errors->has('order_date') ? ' has-error' : '' }}" name="order_date" value="{{ date('d/m/Y') }}" readonly="readonly" autofocus>
            @if ($errors->has('order_date'))
            <span class="help-block">
                <strong>{{ $errors->first('order_date') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="supplier_id" class="col-md-2 control-label">Supplier :</label> 
        <div class="col-md-3">
            <select name="supplier_id" class="form-control example-getting-started" id="supplier_id" required="">  
                <option value="">-- Pilih Supplier </option>
                @foreach($suppliers as $s)
                <option value="{{$s->id}}">{{ucfirst($s->name)}}</option> 
                @endforeach
            </select>
            @if ($errors->has('supplier_id'))
            <span class="help-block">
                <strong>{{ $errors->first('supplier_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_by') ? ' has-error' : '' }}">
        <label for="request_by" class="col-md-2 control-label">Diajukan Oleh :</label> 
        <div class="col-md-2">
            <input id="request_by" type="text" class="form-control" name="requested_by" value="" required autofocus>
            @if ($errors->has('request_by'))
            <span class="help-block">
                <strong>{{ $errors->first('request_by') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="approved_by" class="col-md-2 control-label">Disetujui Oleh :</label> 
        <div class="col-md-3">
            @if(Auth::user()->hasRole('kepala_produksi') || Auth::user()->hasRole('produksi'))
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="{{Auth::user()->name}}" autofocus>
            @else
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="" disabled autofocus>
            @endif
            @if ($errors->has('approved_by'))
            <span class="help-block">
                <strong>{{ $errors->first('approved_by') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        <label for="user_id" class="col-md-2 control-label">Petugas :</label> 
        <div class="col-md-2">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input id="user_id" type="text" class="form-control" value="{{Auth::user()->name}}" readonly="readonly">
            @if ($errors->has('user_id'))
            <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
            @endif
        </div> 
        <div class="col-md-3"></div>
        <label for="approval_date" class="col-md-2 control-label">Tanggal Disetujui :</label> 
        <div class="col-md-3">
            @if(Auth::user()->hasRole('kepala_produksi') || Auth::user()->hasRole('produksi'))
            <input id="approved_date" type="text" class="form-control" name="approval_date" value="{{date('d/m/Y')}}" autofocus>
            @else
            <input id="approved_date" type="text" class="form-control" name="approval_date" value="" disabled autofocus>
            @endif
            @if ($errors->has('approved_date'))
            <span class="help-block">
                <strong>{{ $errors->first('approval_date') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_receive_date') ? ' has-error' : '' }}">
        <label for="request_receive_date" class="col-md-2 control-label">Tanggal Pemesanan :</label> 
        <div class="col-md-2">
            <input id="request_receive_date" type="date" class="form-control" name="request_receive_date" value="" required>
            @if ($errors->has('request_receive_date'))
            <span class="help-block">
                <strong>{{ $errors->first('request_receive_date') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="description" class="col-md-2 control-label">Keterangan :</label> 
        <div class="col-md-3">
            <textarea class="form-control" name="description" required></textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group"> 
        <div class="col-md-11"><hr style="width: 100%;"></div>
    </div>
    <div class="form-group"> 
        <div class="col-md-11">
            <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
            <div class="wrapper1">
                <div class="div1"></div>
            </div> 
            <div class="wrapper2">
                <div class="div2">
                    <table class="table table-striped table-check data-table"> 
                        <thead>
                            <tr class="header"> 
                                <th width="50px" nowrap="nowrap">@if($request_order_details->count()>0)<input type="checkbox" class="checked_ids"><div>@endif</th>
                                <th>No</th> 
                                <th>Kode</th>   
                                <th>Nama</th>   
                                <th>Stok</th> 
                                <th>Harga</th> 
                                <th>Batas Pesan</th> 
                                <th>Kategori</th> 
                                <th>Supplier</th> 
                                <th>Jumlah Request</th> 
                                <th>Jumlah Disetujui</th>
                                <th>Harga Sekarang</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @if($request_order_details->count() > 0)
                            @foreach($request_order_details as $key => $c)
                            <tr class="ordering">
                                <th> 
                                    <input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}" checked="checked">
                                </th>
                                <th>{{++$key}}</th>
                                <th>{{$c->goods->code}}</th>   
                                <th>{{$c->goods->name}}</th>  
                                <?php $color = ($c->goods->amount <= $c->goods->min_amount) ? 'red' : "green" ?>
                                <th style="color:{{$color}}; font-weight:bold;">{{$c->goods->amount}} ({{$c->goods->package?$c->goods->package->symbol:""}})</th> 
                                <th>{{rupiahFormat($c->goods->price)}}</th> 
                                <th>{{$c->goods->purchase_limit}}</th> 
                                <th>{{$c->goods->category?$c->goods->category->name:""}}</th> 
                                <th>{{$c->goods->supplier?$c->goods->supplier->name:""}}</th> 
                                <th nowrap="nowrap"> 
                                    <input type="text" class="form-control amount" name="request_amount[{{$c->goods->id}}]" value="{{$c->request_amount}}" data-amount="{{$c->request_amount}}" readonly="readonly" style="width: 60px" maxlength="4">
                                    <input type="hidden" name="request_price[{{$c->goods->id}}]" value="{{$c->request_price}}"> 
                                </th> 
                                <th nowrap="nowrap" class="counted">
                                    <input data-type="real_amount_temp" type="hidden" class="real_amount_temp" value="{{$c->request_amount}}"> 
                                    <input type="number" class="form-control real_amount" name="real_amount[{{$c->goods->id}}]" value="{{$c->request_amount}}" style="width: 60px" maxlength="4" onkeyup="setRealAmount(this);" onmouseout="hitungTotal();"></th> 
                                <th nowrap="nowrap" class="counted">
                                    <input type="hidden" name="request_order_id[{{$c->goods->id}}]" value="{{$c->request_order_id}}"> 
                                    <input data-type="real_price_temp"  type="hidden" class="real_price_temp" value="{{$c->request_price}}"> 
                                    <input class="form-control real_price" name="real_price[{{$c->goods->id}}]" type="number" style="width: 100px" maxlength="7" value="{{$c->request_price}}" onkeyup="setRealPrice(this);" onmouseout="hitungTotal();">
                                    <input class="form-control total_temp"  type="hidden" value="{{$c->request_amount*$c->request_price}}">
                                </th>
                            </tr>
                            @endforeach 
                            @else
                            <tr class="ordering">
                                <th colspan="12">
                                    <div class="alert alert-info" style="text-align: center"> Data Permintaan Barang Kosong.. </div>
                                </th> 
                            </tr>
                            @endif
                        </tbody>
                    </table>  
                </div>
            </div>
        </div> 
    </div>
    <div class="form-group"> 
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: right">
            <div class="alert alert-info">Jumlah Total Pemesanan :</div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success total" style="font-weight: bold;">Rp 0</div>
        </div>
    </div>
</form>
@section('script') 
<script type="text/javascript">

    function setRealAmount(element) {
        $v = parseInt($(element).val());
        if ($v > 0) {
            $(element).parent().find('input.real_amount_temp').val($v);
        }
    }
    function setRealPrice(element) {
        $v = parseInt($(element).val());
        if ($v > 0) {
            $(element).parent().find('input.real_price_temp').val($v);
        }
    }
    function hitungTotal() {
        var total = 0;
        var real_amounts = [];
        var real_prices = [];
        $amounts = [];
        $.each($('tr.ordering'), function (i, v) {
            var real_amount_temp = 0, real_price_temp = 0;
            $.each($(v).find('th.counted'), function (j, k) {
                if (typeof $(k).find('input.real_amount_temp').val() != "undefined") {
                    real_amount_temp = $(k).find('input.real_amount_temp').val();
                }
                if (typeof $(k).find('input.real_price_temp').val() != "undefined") {
                    real_price_temp = $(k).find('input.real_price_temp').val();
                }
            });
            $(v).find('th.counted input.total_temp').val(real_amount_temp * real_price_temp);
            total += real_amount_temp * real_price_temp;
        });

        $("div.total").text(app.rupiah(total));
    }
    $(function () {
        hitungTotal();

        $('.ids').change(function () {
            if (this.checked) {
                $(this).parent().parent().find('th input#real_amount').removeAttr('disabled')
            } else {
                $(this).parent().parent().find('th input#real_amount').val("");
                $(this).parent().parent().find('th input#real_amount').attr('disabled', 'disabled')
            }
        });

        $('.checked_ids').change(function () {
            if (this.checked) {
                $.each($('.ids'), function (k, v) {
                    $(v).parent().parent().find('th input#real_amount').removeAttr('disabled')
                });
            } else {
                $.each($('.ids'), function (k, v) {
                    $(v).parent().parent().find('th input#real_amount').val("");
                    $(v).parent().parent().find('th input#real_amount').attr('disabled', 'disabled')
                });
            }
        });

        $('#supplier_id').change(function (e) {
            $.get('{{url("request_order/by_supplier")}}/' + $(this).val(), function (res) {
                $("div.div2").html(res);
                hitungTotal();
            });
        });
    });
</script>
@endsection 
