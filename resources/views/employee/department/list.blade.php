 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Department <div style="text-align: right">{!!getActions('department','create')?getActions('department','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check data-table">
                                <thead>
                                    <tr class="header"> 
                                        <th width="50px" nowrap="nowrap">@if($departments->count() > 0)<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($departments[0])}}" id="delete_all" data-model="Supplier"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th> 
                                        <th>Nama</th> 
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($departments as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th> 
                                        <th>{{$c->name}}</th> 
                                        <th nowrap="nowrap">{!!getActions('department','edit', $c->id)?getActions('department','edit', $c->id):NULL!!}&nbsp;{!!getActions('department','destroy', $c->id)?getActions('department','destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$departments->links()}}</span> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>  
