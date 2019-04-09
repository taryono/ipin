 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Roles <div style="text-align: right"><a data-toggle="modal" href="#modal_popup" class="create" data-url="{{route('role.create')}}">Tambah</a></div></div>

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
                                        <th width="10px">No</th> 
                                        <th width="10px">Nama</th> 
                                        <th width="10px">Description</th> 
                                        <th width="10px">Aksi</th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($roles as $key => $c)
                                    <tr class="ordering">
                                        <th width="10px">{{++$key}}</th>
                                        <th width="10px">{{$c->name}}</th>  
                                        <th width="10px">{{$c->description}}</th>
                                        <th width="10px">{!!getActions('role','edit', $c->id)?getActions('role','edit', $c->id):NULL!!}&nbsp;{!!getActions('role','destroy', $c->id)?getActions('role','destroy',$c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$roles->links()}}</span> 
                    </div>


                </div>
            </div>
        </div>
    </div> 
</div> 