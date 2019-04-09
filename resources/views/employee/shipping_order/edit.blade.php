<form class="form-horizontal" method="POST" action="{{ route('shipping_order.update',$shipping_order->id) }}">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" name="_method" value="PUT"> 
    <div class="form-group">
        <label for="customer_id" class="col-md-3 control-label">Customer :</label> 
        <div class="col-md-6">
            <select name="customer_id" class="form-control example-getting-started">  
                <option value="{{$shipping_order->customer->id}}">{{$shipping_order->customer->name}}</option>  
            </select> 
        </div> 
    </div>
    <div class="form-group">
        <label for="work_order_id" class="col-md-3 control-label">Work Order :</label> 
        <div class="col-md-6 work-order-dropdown">
            <select id="work_order_id" name="work_order_id" class="form-control example-getting-started">   
                <option value="{{$shipping_order->work_order_id}}">{{$shipping_order->work_order->code}}</option>
            </select>
            @if ($errors->has('work_order_id'))
            <span class="help-block">
                <strong>{{ $errors->first('work_order_id') }}</strong>
            </span>
            @endif
        </div> 
    </div> 
    <div class="form-group">
        <label for="request_date" class="col-md-3 control-label">Tanggal Permintaan :</label> 
        <div class="col-md-6"> 
            <input id="request_date" type="date" class="form-control" name="request_date" value="{{$shipping_order->request_date}}" required autofocus placeholder="Tanggal permintaan">
             
        </div> 
    </div>
    <div class="form-group">
        <label for="send_date" class="col-md-3 control-label">Tanggal Kirim :</label> 
        <div class="col-md-6"> 
            <input id="send_date" type="date" class="form-control" name="send_date" value="{{$shipping_order->send_date}}" required autofocus placeholder="Tanggal pengiriman">
            
        </div> 
    </div> 
    <div class="form-group">
        <label for="description" class="col-md-3 control-label">Keterangan :</label> 
        <div class="col-md-6"> 
            <textarea id="description"  class="form-control" name="description" required>{{$shipping_order->description}}</textarea>
              
        </div> 
    </div>
    <div class="form-group">
        <label for="code" class="col-md-3 control-label">Status Pengiriman :</label> 
        <div class="col-md-6">
            <select id="status_id" name="status_id" class="form-control example-getting-started"> 
                <option value="">--Pilih Status--</option> 
                @foreach($statutes as $s)
                <option value="{{$s->id}}" {{($shipping_order->status_id==$s->id)?'selected="selected"':''}}>{{ucfirst($s->name)}}</option> 
                @endforeach
            </select>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Barang</div>
                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search-goods" placeholder="Search.." style="width: 20% !important">
                    <br>
                    <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
                        <thead>
                            <tr class="header">  
                                <th scope="col">#</th>  
                                <th>Nama</th>  
                                <th>Stok</th> 
                                <th>Harga</th>  
                                <th>Jumlah Pengiriman</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            @if($shipping_order->shipping_order_detail->count() > 0)
                            @foreach($shipping_order->shipping_order_detail as $key => $s)
                            @php $c = $s->goods;@endphp
                            <tr class="ordering-all"> 
                                <th><input class="checked" type="checkbox" name="goods_ids[]" data-good_id="{{$c->id}}" value="{{$c->id}}" data-check="unchecked" checked="checked" {{$c->amount < 1?'disabled="disabled"':""}}></th> 
                                <th>{{$c->name}}</th>  
                                <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                                <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                                <th>{{rupiahFormat($c->price)}}</th>  
                                <th>
                                    <input type="hidden" name="prices[{{$c->id}}]" value="{{$c->price}}">
                                    <input class="amount amount{{$c->id}}" type="text" name="request_amounts[{{$c->id}}]" size="2" data-request_limit="{{$c->request_limit}}" value="{{$s->amount}}" >
                                </th>  
                            </tr>
                            @endforeach
                            @foreach($goods as $good)
                            <tr class="ordering-list ordering-all"> 
                                <th><input class="checked" type="checkbox" name="goods_ids[]" data-good_id="{{$good->id}}" value="{{$good->id}}" data-check="unchecked" {{$c->amount < 1?'disabled="disabled"':""}}></th> 
                                <th>{{$good->name}}</th>  
                                <?php $color = ($good->amount <= $good->min_amount) ? 'red' : "green" ?>
                                <th style="color:{{$color}}; font-weight:bold;">{{$good->amount}} ({{$good->package?$good->package->symbol:""}})</th> 
                                <th>{{rupiahFormat($good->price)}}</th>  
                                <th>
                                    <input type="hidden" name="prices[{{$good->id}}]" value="{{$good->price}}">
                                    <input disabled="disabled" class="amount amount{{$good->id}}" type="text"  name="request_amounts[{{$good->id}}]" size="2" data-request_limit="{{$good->amount}}">
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
    $(document).ready(function () {
         
        pagination(".data-table tbody tr.ordering-all", '.result-count-modal');
        $(".checked").click(function (e) {
            $id = $(this).attr('data-good_id');
            if ($(this).prop('checked')) {
                $("input.amount" + $id).removeAttr('disabled', 'disabled');
                $(this).parent().parent().removeClass('ordering-list');
            } else {
                $("input.amount" + $id).attr('disabled', 'disabled');
                $("input.amount" + $id).val('');
                $(this).parent().parent().addClass('ordering-list');
            }
        });

        $(".amount").keyup(function (e) { 
            if (parseInt($(this).val()) < 1) {
                alert('Tidak boleh 0');
                $(this).val($request_limit)
            }
            
            $request_limit = $(this).attr('data-request_limit'); 
            if (parseInt($(this).val()) > parseInt($request_limit)) {
                alert('Tidak boleh melebihi batas stok. Pesan:' + $(this).val() + " Stok tinggal :" + $request_limit);
                $(this).val($request_limit)
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
        
        $("body").on('change','select#customer_id', function(e){
            var cust_id = $(this).val();
            $.get('{{route("work_order.list_by_customer")}}?id='+cust_id, function(res){
                $("div.work-order-dropdown").html(res);
            }).fail(function(err){
                console.log(err.responseText);
            });
        });
    });
</script>

