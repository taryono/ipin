<style type="text/css">
    a.collapsing:hover {
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Pembelian Barang <div style="text-align: right">{!!getActions('purchase_order', 'create')?str_replace('Tambah','Beli Barang',getActions('purchase_order', 'create')):NULL!!} &nbsp; @if($purchase_orders->count() > 0)<button class="btn btn-success button-cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan </button>@endif</div></div>
                 
                <div class="row search-content hide form-search" style="margin: 5px;"> 
                    <div class="panel">
                        <div class="panel-heading">
                           <label for="print" class="control-label">Silahkan masukan kriteria yang akan dicetak :</label>
                        </div>
                        <div class="panel-body">
                            <form class="search-po" method="POST" action="{{ route('purchase_order.searching') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="print" class="form-control print">
                                <label for="name" class="col-md-2 control-label">Nama Barang</label>
                                <div class="col-md-3">
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <label for="supplier" class="col-md-2 control-label">Status Pembelian</label>
                                <div class="col-md-3">
                                    <select name="status_id" class="form-control">
                                        <option value="">--Pilih Status--</option>
                                        @foreach(App\Models\status::where('type',3)->get() as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br><br><br>
                                <label for="code" class="col-md-2 control-label">Kode PO</label>
                                <div class="col-md-3">
                                    <input type="text" name="code" class="form-control">
                                </div>
                                <label for="supplier" class="col-md-2 control-label">Supplier</label>
                                <div class="col-md-3">
                                    <input type="text" name="supplier" class="form-control">
                                </div>
                                <br><br><br>
                                <label for="purchase_date_from" class="col-md-2 control-label">Tanggal Pemesanan dari :</label> 
                                <div class="col-md-3"> 
                                    <input type="date" name="purchase_date_from" class="form-control">
                                </div>
                                <label for="purchase_date_to" class="col-md-2 control-label">Sampai :</label> 
                                <div class="col-md-3"> 
                                    <input type="date" name="purchase_date_to" class="form-control">
                                </div>
                                <br>
                                <br>
                                <br>
                                <label for="receive_date_from" class="col-md-2 control-label">Tanggal Diterima dari:</label>
                                <div class="col-md-3">
                                    <input type="date" name="receive_date_from" class="form-control">
                                </div> 
                                <label for="receive_date_to" class="col-md-2 control-label">Sampai</label>
                                <div class="col-md-3">
                                    <input type="date" name="receive_date_to" class="form-control">
                                </div>
                                <br><br><br>
                                
                                <label for="receive_date_to" class="col-md-6 control-label"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success searching"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Cari</button>                            
                                    <button type="button" class="btn btn-success print"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Cetak</button>
                                    <button type="button" class="btn btn-success reset"><i class="fa fa-eraser" aria-hidden="true"></i> &nbsp;Reset</button>
                                    <button type="button" class="btn btn-success history"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;Tutup</button>
                                </div>

                                <br>
                            </form>
                        </div>
                        <div class="panel-heading"> 
                            &nbsp;
                        </div>
                    </div>


                    <hr style="height: 5px; color: black">
                </div>
                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check data-table list-po"> 
                                <thead>
                                    <tr class="header"> 
                                        @if(getActions('purchase_order', 'destroy', 1))
                                        <th nowrap="nowrap"> 
                                            @if($purchase_orders->count() > 0 && $purchase_orders[0])<input type="checkbox" class="checked_ids"> &nbsp;
                                            <a href="" data-class="{{get_class($purchase_orders[0])}}" id="delete_all" data-model="Pembelian">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <div>
                                                @endif 
                                        </th>
                                        @endif
                                        <th>No</th>  
                                        <th nowrap="nowrap">Kode PO</th>
                                        <th>Tanggal pembelian</th>  
                                        <th>Status Pembelian</th>
                                        <th nowrap="nowrap">Tanggal Diterima</th>
                                        <th>Supplier</th> 
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($purchase_orders->count() > 0)
                                    @foreach($purchase_orders as $key => $c)
                                    <tr class="ordering">
                                        @if(getActions('purchase_order', 'destroy', $c->id))
                                        <th width="50px"><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        @endif
                                        <th>{{++$key}}</th>
                                        <th><a href="#" class="collapsing"><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{url('purchase_order/getDetail?id='.$c->id)}}"></i>
                                                {{$c->code}}</a>
                                        </th> 
                                        <th>{{dateFormatIndo($c->purchase_date)}}</th> 
                                        <th>{{$c->status?$c->status->name:NULL}}</th> 
                                        <th>{{dateFormatIndo($c->receive_date)}}</th>
                                        <th>{{$c->supplier?$c->supplier->name:NULL}}</th> 
                                        <th>{{rupiahFormat($c->total)}}</th>  
                                        <th nowrap="nowrap">
                                            {!!getActions('purchase_order', 'show', $c->id)?getActions("purchase_order", 'show', $c->id):NULL!!} 
                                            @if($c->status_id != 8)
                                            {!!getActions('purchase_order', 'edit', $c->id)?getActions("purchase_order", 'edit', $c->id):NULL!!} 
                                            {!!getActions('purchase_order', 'destroy', $c->id)?getActions('purchase_order', 'destroy', $c->id):NULL!!}
                                            @endif
                                        </th> 
                                    </tr>
                                    <tr class="hidden row_collapse" id="row_collapse_{{$c->id}}"></tr>
                                    @endforeach
                                    @else
                                    <tr class="purchase_ordering">
                                        <th colspan="11">
                                            <div class="alert alert-info" style="text-align: center"> Data Pembelian Kosong.. </div>
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
                $('#row_collapse_' + id).removeClass('hidden');
                $(this).removeClass('fa-plus-square');
                $(this).addClass('fa-minus-square');
                $("div.content").addClass("loading");
                $.ajax({
                    url: url,
                    success: function (e) {
                        $("div.content").removeClass("loading");
                        $('#row_collapse_' + id).html(e);
                    },
                    error: function (e) {
                        alert('error ' + e);
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
            $("form.search-po input").val("");
            $("input.data-table-search").removeClass("hide");
        });
         $("button.searching").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $.post($("form.search-po").attr('action'),$("form.search-po").serialize(),function(res){
                $("div.content").removeClass("loading");
                $("table.list-po tbody").html(res);
                pagination(".data-table tbody tr.ordering",'.result-count');
            }).fail(function(err){ 
                $("table.list-po tbody").html(err.responseText);
                $("div.content").removeClass("loading"); 
                
            }); 
        });
        $("button.reset").click(function(e){
            e.preventDefault(); 
            $("form.search-po input").val("");
            $("form.search-po select").val("");
        });
        
        $("button.print").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $("form.search-po input.print").val("print");
            $("form.search-po").submit(); 
            $("div.content").removeClass("loading"); 
            $("form.search-po input").val("");
            
        });
    });
</script>