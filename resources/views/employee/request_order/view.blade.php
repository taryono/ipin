<style type="text/css">
    .control-label {
        font-weight: bold;
        text-align: left;
    }
    div label {
        text-align: left;
    }
</style> 
    
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
            <tr> 
                <td colspan="3"> 
                    <b>Detail Permintaan Barang</b>
                </td> 
            </tr>
            <tr> 
                <td>Dari Department</td> 
                <td>:</td> 
                <td>{{$request_order->department?$request_order->department->name:NULL}}</td> 
            </tr>
            <tr> 
                <td>Ditujukan ke Department</td> 
                <td>:</td> 
                <td>{{$request_order->to_department?$request_order->to_department->name:NULL}}</td> 
            </tr>
            <tr> 
                <td>a/n</td> 
                <td>:</td> 
                <td>{{$request_order->request_by}}</td> 
            </tr>
            <tr> 
                <td>Disetujui oleh</td> 
                <td>:</td> 
                <td>{{$request_order->approved_by}}</td> 
            </tr>
            <tr> 
                <td>Tanggal Disetujui</td> 
                <td>:</td> 
                <td>{{dateFormatIndo($request_order->approval_date)}}</td> 
            </tr>
            
            <tr> 
                <td>Tanggal Permintaan</td> 
                <td>:</td> 
                <td>{{dateFormatIndo($request_order->request_date)}}</td> 
            </tr>
            <tr> 
                <td>Tanggal Kirim</td> 
                <td>:</td> 
                <td>{{dateFormatIndo($request_order->send_date)}}</td> 
            </tr>
            
            <tr> 
                <td>Keterangan</td> 
                <td>:</td> 
                <td>{{$request_order->description}}</td> 
            </tr>
            <tr> 
                <td>Status</td> 
                <td>:</td> 
                <td>{{$request_order->status?$request_order->status->name:""}}</td> 
            </tr>
        </table>  
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
                            <th nowrap="nowrap">Batas Pesan</th> 
                            <th>Jumlah Permintaan</th>  
                        </tr>
                    </thead>
                    <tbody> 
                        @if($request_order->request_order_detail->count() > 0)
                        @foreach($request_order->request_order_detail as $key => $s)
                        @php $c = $s->goods;@endphp
                        <tr class="ordering-list">  
                            <td>{{$c->name}}</td>   
                            <td>{{rupiahFormat($c->price)}}</td> 
                            <td>{{$c->request_limit}}</td> 
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
