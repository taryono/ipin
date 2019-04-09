<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">List Menu Detail </div>

                <div class="panel-body">
                    <table class="table table-striped table-check data-table">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th> 
                                <th width="10px">Url</th> 
                                <th width="10px">Path</th>
                                <th width="10px">Aksi</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($menus as $key => $c)
                            <tr class="ordering">
                                <td width="10px">{{++$key}}</td>
                                <td width="10px">{{$c->name}}</td>  
                                <td width="10px">{{$c->route}}</td>
                                <td width="10px">{{$c->controller->name.$c->action}}</td> 
                                <td width="10px">

                                    {!!getActions('menu','edit', $c->id)?getActions("menu","edit", $c->id):NULL!!}&nbsp; 
                                    {!!getActions('menu','destroy', $c->id)?getActions("menu","destroy", $c->id):NULL!!}</td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count"></span> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>  