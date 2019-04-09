<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Barang 
                    <div style="text-align: right">{!!getActions('goods', 'create')!!} &nbsp;<button class="btn btn-success button-cetak"><i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan </button> </div>                   
                </div>
                
                <div class="row search-content hide" style="margin: 5px;">
                    <div class="col-md-12">
                        <div class="alert alert-success"> 
                            <label for="print" class="control-label">Silahkan masukan kriteria yang akan dicetak :</label>
                        </div> 
                    </div> 
                </div>
                <div class="row search-content hide form-search" style="margin: 5px;"> 
                    <form class="search-goods" method="POST" action="{{ route('goods.searching') }}">
                         {{ csrf_field() }} 
                         <input type="hidden" name="print" class="form-control print">
                        <label for="code" class="col-md-1 control-label">Kode</label>
                        <div class="col-md-2">
                            <input type="text" name="code" class="form-control">
                        </div>
                        <label for="name" class="col-md-2 control-label">Nama</label>
                        <div class="col-md-2">
                            <input type="text" name="name" class="form-control">
                        </div>
                        <label for="price" class="col-md-2 control-label">Harga</label> 
                        <div class="col-md-2"> 
                            <input type="number" name="price" class="form-control">
                        </div>
                        <br><br>
                        <label for="code" class="col-md-1 control-label">Kategori</label>
                        <div class="col-md-2">
                            <input type="text" name="category" class="form-control">
                        </div>
                        <label for="name" class="col-md-2 control-label">Supplier</label>
                        <div class="col-md-2">
                            <input type="text" name="supplier" class="form-control">
                        </div> 
                        <label for="name" class="col-md-2 control-label">Keterangan</label>
                        <div class="col-md-3">
                            <textarea name="description" class="form-control"></textarea><br>
                        </div> 
                        <br><br>
                        <label for="code" class="col-md-1 control-label">Stok</label>
                        <div class="col-md-2">
                            <select name="operator" class="form-control">
                                <option value="">=</option>
                                <option value=">">></option>
                                <option value="<"><</option>
                            </select> 
                        </div> 
                        <div class="col-md-2">
                            <input type="number" name="amount" class="form-control">
                        </div> 
                        <label for="created_at" class="col-md-1 control-label">Tanggal</label>
                        <div class="col-md-3">
                            <input type="date" name="from" class="form-control">
                        </div> 
                        <div class="col-md-3">
                            <input type="date" name="to" class="form-control">
                        </div> 
                        <br><br>
                        <label for="name" class="col-md-2 control-label"></label>
                        <div class="col-md-12" style="text-align: right">
                            <button type="submit" class="btn btn-success searching"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;Cari</button>                            
                            <button type="button" class="btn btn-success print"><i class="fa fa-print" aria-hidden="true"></i> &nbsp;Cetak</button>
                            <button type="button" class="btn btn-success reset"><i class="fa fa-eraser" aria-hidden="true"></i> &nbsp;Reset</button>
                            <button type="button" class="btn btn-success history"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;Tutup</button>
                        </div>
                        
                        <br>
                    </form>
                    <hr style="height: 5px; color: black">
                </div>
                
                <div class="panel-body">
                     @if($goodies->count() > 0)<input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important; margin-bottom: 5px;" data-class="{{get_class($goodies[0])}}"> @endif
                    <div class="wrapper1">
                        <div class="div1">

                        </div>
                    </div>
                </div> 
                <div class="wrapper2">
                    <div class="div2">
                        <table class="table table-striped table-check data-table table-responsive list-goods"> 
                            <thead class="thead-dark">
                                <tr class="header"> 
                                    @if(getActions('goods', 'destroy', 1))
                                    <th width="50px" nowrap="nowrap">@if($goodies->count() > 0 )<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($goodies[0])}}" id="delete_all" data-model="Barang"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                    @endif
                                    <th scope="col">No</th> 
                                    <!--th>Kode</th-->   
                                    <th>Nama</th> 
                                    <th>Keterangan</th>   
                                    <th>Stok</th> 
                                    <th>Harga</th> 
                                    <th nowrap="nowrap">Batas Pesan</th> 
                                    <th>Kategori</th> 
                                    <th>Supplier</th>  
                                    <th>Aksi</th>  
                                </tr> 
                            </thead>
                            <tbody> 
                                @if($goodies->count() > 0)
                                @foreach($goodies as $key => $c)
                                <tr class="ordering">
                                    @if(getActions('goods', 'destroy', 1))
                                    <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                    @endif
                                    <th>{{++$key}}</th>
                                    <!--th>{{$c->goods_code?$c->goods_code->name:NULL}}</th-->   
                                    <th>{{$c->name}}</th> 
                                    <th>{{$c->description}}</th>  
                                    <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                                    <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                                    <th>{{rupiahFormat($c->price)}}</th> 
                                    <th>{{$c->request_limit}}</th> 
                                    <th>{{$c->category?$c->category->name:""}}</th> 
                                    <th>{{$c->supplier?$c->supplier->name:""}}</th>  
                                    <th nowrap="nowrap"> 
                                        {!!getActions('goods', 'show', $c->id)!!} 
                                        {!!getActions('goods', 'edit', $c->id)!!} 
                                        {!!getActions('goods', 'destroy', $c->id)!!} 
                                    </th> 
                                </tr>
                                @endforeach
                                @else
                                <tr class="ordering">
                                    @if(getActions('goods', 'destroy', 1))
                                    <th colspan="11">
                                        @else 
                                    <th colspan="10">
                                        @endif 
                                        <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
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
            $("form.search-goods input").val("");
            $("input.data-table-search").removeClass("hide");
        });
         $("button.searching").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $.post($("form.search-goods").attr('action'),$("form.search-goods").serialize(),function(res){
                $("div.content").removeClass("loading");
                $("table.list-goods tbody").html(res);
                pagination(".data-table tbody tr.ordering",'.result-count');
            }).fail(function(err){ 
                $("table.list-goods tbody").html(err.responseText);
                $("div.content").removeClass("loading"); 
                
            }); 
        });
        $("button.reset").click(function(e){
            e.preventDefault(); 
            $("form.search-goods input").val("");
        });
        
        $("button.print").click(function(e){
            e.preventDefault();
            $("div.content").addClass("loading"); 
            $("form.search-goods input.print").val("print");
            $("form.search-goods").submit(); 
            $("div.content").removeClass("loading"); 
            $("form.search-goods input").val("");
            
        });
    });
</script>