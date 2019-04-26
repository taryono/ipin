<style type="text/css">
    a:hover {
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Permintaan Barang <div style="text-align: right">{!!getActions('request_order', 'create')?getActions('request_order', 'create'):NULL!!} &nbsp;@if($request_orders->count() > 0)<button class="btn btn-success button-cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan </button>@endif</div></div>
                <div class="row search-content hide" style="margin: 5px;">
                    <div class="col-md-12">
                        <div class="alert alert-success"> 
                            <label for="print" class="control-label">Silahkan masukan kriteria yang akan dicetak :</label>
                        </div> 
                    </div> 
                </div>
                <div class="row search-content hide form-search" style="margin: 5px;"> 
                    <form class="request_search" method="POST" action="{{ route('request_order.searching') }}" enctype="multipart/form-data">
                         {{ csrf_field() }}
                        <input type="hidden" name="print" class="form-control print">
                        <label for="department" class="col-md-2 control-label">Department</label>
                        <div class="col-md-3">
                            <input type="text" name="department" class="form-control">
                        </div>
                        <label for="name" class="col-md-2 control-label">Nama Barang</label>
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control">
                        </div>
                        <br><br>
                        <label for="request_date_from" class="col-md-2 control-label">Tanggal Permintaan Dari</label> 
                        <div class="col-md-3"> 
                            <input type="date" name="request_date_from" class="form-control">
                        </div>
                        <label for="request_date_to" class="col-md-2 control-label">Sampai</label> 
                        <div class="col-md-3"> 
                            <input type="date" name="request_date_to" class="form-control">
                        </div>
                        <br><br><br><br>
                        <label for="description" class="col-md-2 control-label">Keterangan</label> 
                        <div class="col-md-3"> 
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <br><br>
                        <label for="request_date_to" class="col-md-8 control-label"></label> 
                        <button type="submit" class="btn btn-success searching"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Cari</button>                            
                            <button type="button" class="btn btn-success print"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Cetak</button>
                            <button type="button" class="btn btn-success reset"><i class="fa fa-eraser" aria-hidden="true"></i> &nbsp;Reset</button>
                            <button type="button" class="btn btn-success history"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;Tutup</button>
                        <br>
                    </form>
                    <hr style="height: 5px; color: black">
                </div>
                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important; margin-bottom: 5px;">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table width="100%" class="table table-striped table-check data-table list-requests">
                                <thead>
                                    <tr class="header"> 
                                        @if(getActions('request_order', 'destroy', 1) && $request_orders->count() > 0)
                                        <th width="50px" nowrap="nowrap">@if($request_orders[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($request_orders[0])}}" id="delete_all" data-model="Permintaan"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        @endif
                                        <th>No</th>  
                                        <th>Department</th>
                                        <th>Department Tujuan</th>
                                        <th>Keterangan</th>     
                                        <th>Tanggal Permintaan</th>
                                        <th>Total </th>
                                        <th>Request Tanggal kirim</th>  
                                        <th>Status Permintaan</th>
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($request_orders->count() > 0)
                                        @foreach($request_orders as $key => $c)
                                        <tr class="ordering">
                                            @if(getActions('request_order', 'destroy', $c->id))
                                            <td>
                                                <input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}">                                            
                                            </td>
                                            @endif
                                            <td>{{++$key}}</td>
                                            <td><a href="#" class="collapsing"><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{url('request_order/getDetail')}}"></i>
                                            {{$c->department?$c->department->name:NULL}}</a>
                                            </td>  
                                            <td> {{$c->to_department?$c->to_department->name:NULL}}</td>   
                                            <td>{{$c->description}}</td>   
                                            <td>{{dateFormatIndo($c->request_date)}}</td> 
                                            <td>{{rupiahFormat($c->total)}}</td>
                                            <td>{{dateFormatIndo($c->send_date)}}</td>   
                                            <td>{{$c->status?$c->status->name:NULL}}</td>   
                                            <td nowrap="nowrap">
                                                {!!getActions('request_order', 'show', $c->id)?getActions("request_order", 'show', $c->id):NULL!!}
                                                &nbsp;       
                                                @if($c->status_id != 5)
                                                {!!getActions('request_order', 'edit', $c->id)?getActions("request_order", 'edit', $c->id):NULL!!}
                                                &nbsp;
                                                {!!getActions('request_order', 'destroy', $c->id)?getActions('request_order', 'destroy', $c->id):NULL!!}
                                                @endif
                                            </td> 
                                        </tr>
                                        <tr class="hidden row_collapse" id="row_collapse_{{$c->id}}"></tr>
                                        @endforeach
                                    @else
                                    <tr class="ordering">
                                        @if(getActions('request_order', 'destroy', 1))
                                        <th colspan="13">
                                            @else 
                                        <th colspan="12">
                                            @endif
                                            <div class="alert alert-info" style="text-align: center"> Data Permintaan Barang Kosong.. </div>
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
            $("form.request_search input").val("");
            $("input.data-table-search").removeClass("hide");
        });
         $("button.searching").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $.post($("form.request_search").attr('action'),$("form.request_search").serialize(),function(res){
                $("div.content").removeClass("loading");
                $("table.list-requests tbody").html(res);
                pagination(".data-table tbody tr.ordering",'.result-count');
            }).fail(function(err){ 
                $("table.list-requests tbody").html(err.responseText);
                $("div.content").removeClass("loading"); 
                
            }); 
        });
        $("button.reset").click(function(e){
            e.preventDefault(); 
            $("form.request_search input").val("");
        });
        
        $("button.print").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $("form.request_search input.print").val("print");
            $("form.request_search").submit(); 
            $("div.content").removeClass("loading"); 
            $("form.request_search input").val(""); 
        });
    });
</script>