<table class="table table-striped table-check data-table"> 
    <thead>
        <tr class="header"> 
            <th width="50px" nowrap="nowrap">@if($request_order_details->count()>0 && $request_order_details[0])<input type="checkbox" class="checked_ids"><div>@endif</th>
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
            <th>{{$c->goods->goods_code->name}}</th>   
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