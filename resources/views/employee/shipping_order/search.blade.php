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
            <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
            <th>{{++$key}}</th>
            <th>{{$c->goods_code->code}}</th>   
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