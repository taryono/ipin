 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Menu <div style="text-align: right">{!!getActions('menu','create')?getActions('menu','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important; margin-bottom: 5px;">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div>
                        <div class="wrapper2">
                            <div class="div2">
                                <table class="table table-striped table-check  data-table">
                                    <thead>
                                        <tr class="header"> 
                                            <th width="10px">No</th> 
                                            <th>Nama</th> 
                                            <th>Route</th> 
                                            <th>URL</th>
                                            <th>Path</th>
                                            <th>Aksi</th>
                                        </tr> 
                                    </thead>
                                    <tbody> 
                                        @foreach($menus as $key => $c)
                                        <tr class="ordering">
                                            <th width="10px">{{++$key}}</th>
                                            <th><a href="#" class="sub" data-url="{{route('menu.show', $c->id)}}">{{$c->name}}</a></th>  
                                            <th>{{$c->route}}</th>
                                            <th>{{$c->concat}}</th>
                                            <th>{{$c->controller->name.$c->action}}</th> 
                                            <th>{!!getActions('menu','edit', $c->id)?getActions('menu','edit', $c->id):NULL!!} &nbsp;{!!getActions('menu','destroy', $c->id)?getActions('menu','destroy', $c->id):NULL!!}</th> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <thead>
                                        <tr class="header"> 
                                            <th width="10px">No</th> 
                                            <th>Nama</th> 
                                            <th>Route</th> 
                                            <th>URL</th>
                                            <th>Path</th>
                                            <th>Aksi</th>
                                        </tr> 
                                    </thead>
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