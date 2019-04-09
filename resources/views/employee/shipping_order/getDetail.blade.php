<td></td>
<td></td>
<td colspan="9">
<table class="table table-responsive table-striped"> 
    <tr>  
        <th>No</th>  
        <th>Nama Barang</th>
        <th>Jumlah</th>     
        <th>Harga</th>
        <th>Subtotal</th> 
    </tr>
    @if($shipping_order_details->count() > 0)
        @foreach($shipping_order_details as $key => $c)
        <tr class="ordering"> 
            <td>{{++$key}}</td> 
            <td>{{$c->goods?$c->goods->name:NULL}}</td>
            <td>{{$c->amount}}</td>   
            <td>{{rupiahFormat($c->price)}}</td> 
            <td>{{rupiahFormat($c->subtotal)}}</td> 
        </tr> 
        @endforeach
    @endif 
</table> 
</td>