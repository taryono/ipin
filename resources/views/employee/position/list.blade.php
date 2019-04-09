 
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">List Jabatan <div style="text-align: right">{!!getActions('position','create')?getActions('position','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important; margin-bottom: 5px;">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div>
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check data-table">
                                <thead>
                                    <tr class="header"> 
                                        <th width="50px" nowrap="nowrap">@if($positions[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($positions[0])}}" id="delete_all" data-model="Jabatan"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th> 
                                        <th>Kode</th>  
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($positions as $key => $c)
                                    <tr class="ordering">
                                        <th width="50px"><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th>
                                        <th>{{$c->code}}</th>  
                                        <th>{{$c->name}}</th>
                                        <th>{{$c->position_category?$c->position_category->name:NULL}}</th>
                                        <th>{!!getActions('position','edit', $c->id)?getActions('position','edit', $c->id):NULL!!}&nbsp;{!!getActions('position','destroy', $c->id)?getActions('position','destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$positions->links()}}</span> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>  