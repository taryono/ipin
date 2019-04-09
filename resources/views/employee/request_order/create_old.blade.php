<form class="form-horizontal" method="POST" action="{{ route('request_order.store') }}">
    {{ csrf_field() }} 
    <div class="form-group">
        <label for="department_id" class="col-md-2 control-label">Divisi :</label> 
        <div class="col-md-3">
            <select name="department_id" class="form-control example-getting-started">  
                @foreach($departments as $p)
                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option> 
                @endforeach
            </select>
            @if ($errors->has('department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('department_id') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-9"></div>

    </div>
    <div class="form-group">
        <label for="request_date" class="col-md-2 control-label">Tanggal Permintaan :</label> 
        <div class="col-md-2">
            <input id="name" type="text" class="form-control {{ $errors->has('request_date') ? ' has-error' : '' }}" name="request_date" value="{{ date('d/m/Y') }}" readonly="readonly" autofocus>
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('request_date') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="work_order_id" class="col-md-2 control-label">Work Order :</label> 
        <div class="col-md-3">
            <select name="work_order_id" class="form-control example-getting-started">  
                @foreach($work_orders as $w)
                <option value="{{$w->id}}">{{ucfirst($w->code)}}</option> 
                @endforeach
            </select>
            @if ($errors->has('work_order_id'))
            <span class="help-block">
                <strong>{{ $errors->first('work_order_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('requested_by') ? ' has-error' : '' }}">
        <label for="requested_by" class="col-md-2 control-label">Diajukan Oleh :</label> 
        <div class="col-md-2">
            <input id="request_by" type="text" class="form-control" name="requested_by" value="" autofocus>
            @if ($errors->has('requested_by'))
            <span class="help-block">
                <strong>{{ $errors->first('requested_by') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="approved_by" class="col-md-2 control-label">Disetujui Oleh :</label> 
        <div class="col-md-3">
            @if(Auth::user()->hasRole('gudang') || Auth::user()->hasRole('kepala_produksi') || Auth::user()->hasRole('produksi'))
            <select name="approved_by" class="form-control example-getting-started">
                <option value="{{Auth::user()->name}}">{{ucfirst(Auth::user()->name)}}</option>                                      
            </select> 
            @else 
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="" readonly="readonly" autofocus> 
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
        <label for="approved_date" class="col-md-2 control-label">Tanggal Disetujui :</label> 
        <div class="col-md-3">
            @if(Auth::user()->hasRole('kepala_produksi') || Auth::user()->hasRole('produksi'))
            <input id="approved_date" type="date" class="form-control" name="approved_date" value="{{date('d-m-Y')}}" autofocus>
            @else 
            <input id="approved_date" type="date" class="form-control" name="approved_date" value="" readonly="readonly" autofocus>
            @endif
            @if ($errors->has('approved_date'))
            <span class="help-block">
                <strong>{{ $errors->first('approved_date') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('request_receive_date') ? ' has-error' : '' }}">
        <label for="request_receive_date" class="col-md-2 control-label">Tanggal Pemesanan :</label> 
        <div class="col-md-2">
            <input id="request_receive_date" type="date" class="form-control" name="request_receive_date" value="" disabled>
            @if ($errors->has('request_receive_date'))
            <span class="help-block">
                <strong>{{ $errors->first('request_receive_date') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-3"></div>
        <label for="description" class="col-md-2 control-label">Keterangan :</label> 
        <div class="col-md-3">
            <textarea class="form-control" name="description"></textarea>
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
            <input type="text" name="search" class="form-control data-table-searching" placeholder="Search.." style="width: 20% !important" data-class="\App\Models\Goods" data-template="employee.request_order.search">
            <br>
            <div style="overflow-y: scroll; height: 400px;">
                <table class="table table-striped table-check data-table"> 
                    <thead>
                        <tr class="header"> 
                            <th width="50px" nowrap="nowrap">@if($goods[0])<input type="checkbox" class="checked_ids"><div>@endif</th>
                            <th>No</th> 
                            <th>Kode</th>   
                            <th>Nama</th>   
                            <th>Stok</th> 
                            <th>Harga</th>  
                            <th>Kategori</th> 
                            <th>Supplier</th> 
                            <th>Jumlah</th>  
                        </tr> 
                    </thead>
                    <tbody> 
                        @if($goods->count() > 0)
                        @foreach($goods as $key => $c)
                        <tr class="ordering">
                            <th><input type="checkbox" class="ids unchecked" name="ids[]" value="{{$c->id}}"></th>
                            <th>{{++$key}}</th>
                            <th>{{$c->goods_code?$c->goods_code->code:NULL}}</th>   
                            <th>{{$c->name}}</th>  
                            <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                            <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                            <th>{{rupiahFormat($c->price)}}</th>   
                            <th>{{$c->category?$c->category->name:""}}</th> 
                            <th>{{$c->supplier?$c->supplier->name:""}}</th> 
                            <th nowrap="nowrap">
                                <input type="hidden" class="temp" value="0"> 
                                <input type="hidden" class="total_temp" value="0">
                                <input  type="text" data-price="{{$c->price}}" data-request_limit="{{$c->amount}}" class="form-control amount" name="request_amount[{{$c->id}}][{{$c->price}}]" value="" disabled style="width: 60px" maxlength="4" onkeyup="setAmount(this);" onmouseout="hitungTotal();"></th> 
                        </tr>
                        @endforeach
                        @else
                        <tr class="ordering">
                            <th colspan="4">
                                <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
                            </th> 
                        </tr>
                        @endif
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="col-md-6"> &nbsp;
        </div>
        <div class="col-md-3">
            <div class="alert alert-info">Jumlah Total Permintaan Belanja :</div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-success total" style="font-weight: bold;">Rp 0</div>
        </div>
    </div> 
</form>
@section('script')
<script type="text/javascript">
    var total = 0;
    function setAmount(element) {
        $v = parseInt($(element).val());
        $request_limit = $(element).data('request_limit');
        $price = parseInt($(element).data('price'));
        if ($v > 0) {
            if ($v <= $request_limit) {
                $total_temp = $v * $price;
                $(element).parent().find('input.temp').val($v);
                $(element).parent().find('input.total_temp').val($total_temp);
            } else {
                alert("Jumlah melebihi stok");
                $(element).val("");
                $(element).parent().find('input.temp').val(0);
                $(element).parent().find('input.total_temp').val(0);
                hitungTotal();
                return false;
            }
        }
    }

    function hitungTotal() {
        var total = 0;
        $.each($('input.total_temp'), function (i, v) {
            var amount = parseInt($(v).val());
            total = total + parseInt(amount);
        });
        $("div.total").text(app.rupiah(total));
    }
    $(function () {

        $(".data-table-searching").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".data-table tr.ordering").filter(function (e) {
                var test = $(this).has("input.unchecked");
                $.each(test, function (i, v) {
                    $(v).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });

            });
        });

        $('.ids').change(function () {
            if (this.checked) {
                $(this).addClass('checked').removeClass('unchecked');
                $(this).parent().parent().find('th input.amount').removeAttr('disabled')
            } else {
                $(this).removeClass('checked').addClass("unchecked");
                $(this).parent().parent().find('th input.amount').val("");
                $(this).parent().parent().find('th input.amount').attr('disabled', 'disabled')
            }
        });

        $('.checked_ids').change(function () {
            if (this.checked) {

                $.each($('.ids'), function (k, v) {
                    $(v).parent().parent().find('th input.amount').removeAttr('disabled')
                });

            } else {
                $.each($('.ids'), function (k, v) {
                    $(v).parent().parent().find('th input.amount').val("");
                    $(v).parent().parent().find('th input.amount').attr('disabled', 'disabled')
                });

            }
        });
    });
</script>
@endsection 
