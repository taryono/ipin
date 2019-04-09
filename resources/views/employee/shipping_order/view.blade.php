<style type="text/css">
    .control-label {
        font-weight: bold;
        text-align: left;
    }
</style>
 
<form class="form-horizontal" method="POST" action="{{ route('shipping_order.update',$shipping_order->id) }}">     
     
    <div class="form-group">
        <label for="customer_id" class="col-md-5 control-label">Customer :</label> 
        <div class="col-md-1">
            :
        </div>
        <div class="col-md-6">
            {{$shipping_order->customer->name}}
        </div> 
    </div>
    <div class="form-group">
        <label for="work_order_id" class="col-md-5 control-label">Customer :</label> 
        <div class="col-md-1">
            :
        </div>
        <div class="col-md-6">
            {{$shipping_order->work_order->code}}
        </div> 
    </div>
    <div class="form-group">
        <label for="request_date" class="col-md-5 control-label">Tanggal Permintaan :</label> 
        <div class="col-md-1">
            :
        </div>
        <div class="col-md-6"> 
            {{dateFormatIndo($shipping_order->request_date)}}
        </div> 
    </div>
    <div class="form-group">
        <label for="send_date" class="col-md-5 control-label">Tanggal Pengiriman :</label> 
        <div class="col-md-1">
            :
        </div>
        <div class="col-md-6"> 
            {{dateFormatIndo($shipping_order->send_date)}}
        </div> 
    </div> 
    <div class="form-group">
        <label for="description" class="col-md-5 control-label">Keterangan :</label> 
        <div class="col-md-1">
            :
        </div>
        <div class="col-md-6"> 
            {{$shipping_order->description}}
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
                                <th>Nama</th>   
                                <th>Harga</th>  
                                <th>Jumlah Pengiriman</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            @if($shipping_order->shipping_order_detail->count() > 0)
                            @foreach($shipping_order->shipping_order_detail as $key => $s)
                            @php $c = $s->goods;@endphp
                            <tr class="ordering-list">  
                                <td>{{$c->name}}</td>   
                                <td>{{rupiahFormat($s->price)}}</td>  
                                <td>{{$s->amount}}
                                </td>  
                            </tr>
                            @endforeach
                            @else
                            <tr> 
                                <td colspan="9"> 
                                    <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
                                </td> 
                            </tr>
                            @endif
                        </tbody> 
                    </table>  
                </div> 
            </div>
            <div class="table-list-footer">
                <span class="result-count"></span> 
            </div>
        </div> 
    </div> 
</form>
 <script type="text/javascript">
    $(document).ready(function () {
         pagination(".data-table tbody tr.ordering-list", '.result-count');
        $("input.data-table-search-goods").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".data-table tr.ordering-list").filter(function (e) {
                var checkbox = $(this).find('input.checked_ids');
                if (checkbox.prop('checked', false)) {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                }

            });
        });
    });
</script>
