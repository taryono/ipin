<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">List Grup Menu <div style="text-align: right">{!!getActions('group_menu','create')?getActions('group_menu','create'):NULL!!}</div></div>

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
                                        <th width="10px">Status</th>
                                        <th width="10px">Aksi</th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($group_menus as $key => $c)
                                    <tr class="ordering">
                                        <th width="10px">{{++$key}}</th>
                                        <th width="10px">{{$c->name}}</th>    
                                        <th width="10px">{{($c->is_published == 1)?'Aktif':'Tidak Aktif'}}</th>
                                        <th width="10px">{!!getActions('group_menu','edit', $c->id)?getActions("group_menu",'edit', $c->id):NULL!!}&nbsp;{!!getActions('group_menu','destroy', $c->id)?getActions("group_menu",'destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$group_menus->links()}}</span> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
