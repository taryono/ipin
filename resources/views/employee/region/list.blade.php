 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Provinsi <div style="text-align: right">{!!getActions('region', 'create')?getActions('region', 'create'):NULL!!}</div></div>

                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check data-table" width="50%">
                                <thead>
                                    <tr class="header"> 
                                        <th width="10px">@if($regions[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($regions[0])}}" id="delete_all"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th width="2px">No</th> 
                                        <th width="10px">Nama</th>   
                                        <th width="10px">Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($regions->count() > 0)
                                    @foreach($regions as $key => $c)
                                    <tr class="ordering">
                                        <th width="10px"><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th width="2px">{{++$key}}</th>
                                        <th>{{$c->name}}</th>   
                                        <th width="10px">{!!getActions('region', 'edit', $c->id)?getActions("region", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('region', 'destroy', $c->id)?getActions('region', 'destroy', $c->id):NULL!!}</th> 
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
                        <span class="result-count">{{$regions->links()}}</span> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>  