 
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">List Paket / Satuan Barang <div style="text-align: right">{!!getActions('package', 'create')?getActions('package', 'create'):NULL!!}</div></div>
                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 30% !important">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check data-table">

                                <thead>
                                    <tr class="header"> 
                                        <th width="50px">@if($packages[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($packages[0])}}" id="delete_all" data-model="Satuan"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th> 
                                        <th>Nama</th>   
                                        <th>Satuan</th> 
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($packages->count() > 0)
                                    @foreach($packages as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th>
                                        <th>{{$c->name}}</th>  
                                        <th>{{$c->symbol}}</th>  
                                        <th>{!!getActions('package', 'edit', $c->id)?getActions("package", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('package', 'destroy', $c->id)?getActions('package', 'destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="ordering">
                                        <th colspan="4">
                                            <div class="alert alert-info" style="text-align: center"> Data Kategori Kosong.. </div>
                                        </th> 
                                    </tr>
                                    @endif
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$packages->links()}}</span> 
                    </div>


                </div>
            </div>
        </div>
    </div> 
</div>  