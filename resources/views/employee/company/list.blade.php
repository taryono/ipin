 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Users <div style="text-align: right">{!!getActions('category', 'create')?getActions('category', 'create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check data-table">
                        <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                        <thead>
                            <tr class="header"> 
                                <th width="10px">@if($categories[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($categories[0])}}" id="delete_all"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th>   
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @if($categories->count() > 0)
                            @foreach($categories as $key => $c)
                            <tr class="ordering">
                                <th width="10px"><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th>   
                                <th width="10px">{!!getActions('category', 'edit', $c->id)?getActions("category", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('category', 'destroy', $c->id)?getActions('category', 'destroy', $c->id):NULL!!}</th> 
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
                    <div class="table-list-footer">
                        <span class="result-count">{{$categories->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>  