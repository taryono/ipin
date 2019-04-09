<style type="text/css">
    a:hover {
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Pengiriman Barang <div style="text-align: right">{!!getActions('shipping_order', 'create')?getActions('shipping_order', 'create'):NULL!!} &nbsp;@if($shipping_orders->count() > 0)<button class="btn btn-success button-cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan </button>@endif</div></div>

                <div class="row search-content hide form-search" style="margin: 5px;"> 
                    <div class="panel">
                        <div class="panel-heading">
                            <label for="print" class="control-label">Silahkan masukan kriteria pengiriman yang akan dicetak :</label>
                        </div>
                        <div class="panel-body">
                            <form class="shipping_search" method="POST" action="{{ route('shipping.searching') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="print" class="form-control print">
                                <label for="code" class="col-md-2 control-label">Work Order</label>
                                <div class="col-md-3">
                                    <input type="text" name="code" class="form-control">
                                </div>
                                <label for="customer_name" class="col-md-2 control-label">Customer</label>
                                <div class="col-md-3">
                                    <input type="text" name="customer_name" class="form-control">
                                </div>
                                <br><br><br>
                                <label for="request_date_from" class="col-md-2 control-label">Tanggal Permintaan dari</label> 
                                <div class="col-md-3"> 
                                    <input type="date" name="request_date_from" class="form-control">
                                </div>
                                <label for="request_date_to" class="col-md-2 control-label">Sampai</label> 
                                <div class="col-md-3"> 
                                    <input type="date" name="request_date_to" class="form-control">
                                </div>
                                <br><br><br>
                                <label for="send_date_from" class="col-md-2 control-label">Tanggal Pengiriman dari</label>
                                <div class="col-md-3">
                                    <input type="date" name="send_date_from" class="form-control">
                                </div> 
                                <label for="send_date_to" class="col-md-2 control-label">Sampai</label>
                                <div class="col-md-3">
                                    <input type="date" name="send_date_to" class="form-control">
                                </div>
                                <br><br><br>
                                <div class="form-group">
                                    <label for="code" class="col-md-5 control-label"></label>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-success searching"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Cari</button>                            
                                        <button type="button" class="btn btn-success print"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Cetak</button>
                                        <button type="button" class="btn btn-success reset"><i class="fa fa-eraser" aria-hidden="true"></i> &nbsp;Reset</button>
                                        <button type="button" class="btn btn-success history"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;Tutup</button>
                                    </div>
                                </div>
                                <br>
                            </form>
                        </div>
                        <div class="panel-heading"> 
                            &nbsp;
                        </div>
                        <hr style="height: 5px; color: black">
                    </div>
                </div>
                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important; margin-bottom: 5px;">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table width="100%" class="table table-striped table-check data-table list-shippings">
                                <thead>
                                    <tr class="header"> 
                                        @if(getActions('shipping_order', 'destroy', 1))
                                        <th width="50px" nowrap="nowrap">@if($shipping_orders->count() > 0)<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($shipping_orders[0])}}" id="delete_all" data-model="Pengiriman"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        @endif
                                        <th>No</th>  
                                        <th>Customer</th>
                                        <th>Work order</th>
                                        <th>Keterangan</th>     
                                        <th>Tanggal Pengiriman</th>
                                        <th>Total </th>
                                        <th>Tanggal kirim</th>                                         
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($shipping_orders->count() > 0)
                                    @foreach($shipping_orders as $key => $c)
                                    <tr class="ordering">
                                        @if(getActions('shipping_order', 'destroy', $c->id))
                                        <td>
                                            <input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}">                                            
                                        </td>
                                        @endif
                                        <td>{{++$key}}</td>
                                        <td><a href="#" class="collapsing"><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{url('shipping_order/getDetail')}}"></i>
                                                {{$c->customer?$c->customer->name:NULL}}</a>
                                        </td>  
                                        <td>{{$c->work_order?$c->work_order->code:NULL}}</td>  
                                        <td>{{$c->description}}</td>   
                                        <td>{{dateFormatIndo($c->request_date)}}</td> 
                                        <td>{{rupiahFormat($c->total)}}</td>
                                        <td>{{dateFormatIndo($c->send_date)}}</td>   
                                        <td nowrap="nowrap">
                                            {!!getActions('shipping_order', 'show', $c->id)?getActions("shipping_order", 'show', $c->id):NULL!!}
                                            &nbsp;       
                                            @if($c->status_id != 5)
                                            {!!getActions('shipping_order', 'edit', $c->id)?getActions("shipping_order", 'edit', $c->id):NULL!!}
                                            &nbsp;
                                            {!!getActions('shipping_order', 'destroy', $c->id)?getActions('shipping_order', 'destroy', $c->id):NULL!!}
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr class="hidden row_collapse" id="row_collapse_{{$c->id}}"></tr>
                                    @endforeach
                                    @else
                                    <tr class="ordering">
                                        @if(getActions('shipping_order', 'destroy', 1))
                                        <th colspan="13">
                                            @else 
                                        <th colspan="12">
                                            @endif
                                            <div class="alert alert-info" style="text-align: center"> Data Pengiriman Barang Kosong.. </div>
                                        </th> 
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
        </div>
    </div>
</div>  
<script type="text/javascript">
    $(function () {
        $(".wrapper1").scroll(function () {
            $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
        });
        $(".wrapper2").scroll(function () {
            $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () { 
        $('.plus-collapse').click(function () { 
            var id = $(this).data('rowid');
            var url = $(this).data('url-source');

            if ($(this).hasClass('fa-plus-square')) {
                $("div.content").addClass("loading"); 
                $('#row_collapse_' + id).removeClass('hidden');
                $(this).removeClass('fa-plus-square');
                $(this).addClass('fa-minus-square'); 
                $.ajax({
                    url: url,
                    data: {id: id},
                    success: function (e) {
                        $("div.content").removeClass("loading");
                        $('#row_collapse_' + id).html(e);
                    },
                    error: function(e){
                        alert('error '+e);
                    }
                });
            } else {
                $('#row_collapse_' + id).addClass('hidden');
                //$('#row_collapse_' + id).parent().addClass('hide');
                $(this).addClass('fa-plus-square');
                $(this).removeClass('fa-minus-square');
            }
        }); 
        
    });
</script>

<script>
    $(document).ready(function () {
        $(".data-table-search").on("keyup", function () {
            var value = $(this).val().toLowerCase(); 
            $(".data-table tr.ordering").filter(function (e) {
                var tr = $("tr.ordering").children();
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        $("button.button-cetak").click(function(e){
            $("div.search-content").removeClass("hide"); 
            $("input.data-table-search").addClass("hide");
        });
        
        $("button.history").click(function(e){
            $("div.search-content").addClass("hide"); 
            $("form.shipping_search input").val("");
            $("input.data-table-search").removeClass("hide");
        });
         $("button.searching").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $.post($("form.shipping_search").attr('action'),$("form.shipping_search").serialize(),function(res){
                $("div.content").removeClass("loading");
                $("table.list-shippings tbody").html(res);
                pagination(".data-table tbody tr.ordering",'.result-count');
            }).fail(function(err){ 
                $("table.list-shippings tbody").html(err.responseText);
                $("div.content").removeClass("loading"); 
                
            }); 
        });
        $("button.reset").click(function(e){
            e.preventDefault(); 
            $("form.shipping_search input").val("");
        });
        
        $("button.print").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $("form.shipping_search input.print").val("print");
            $("form.shipping_search").submit(); 
            $("div.content").removeClass("loading"); 
            $("form.shipping_search input").val(""); 
        });
    });
</script>