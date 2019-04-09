<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">List Controllers <div style="text-align: right">{!!getActions('controller','create')?getActions('controller','create'):NULL!!}</div></div>

                <div class="panel-body"> 
                    <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div> 
                    <div class="wrapper2">
                        <div class="div2">
                            <table class="table table-striped table-check  data-table">
                                <thead>
                                    <tr class="header"> 
                                        <th width="50px" nowrap="nowrap"><input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($controllers[0])}}" id="delete_all"><i class="fa fa-trash" aria-hidden="true"></i></a><div></th>
                                        <th>No</th> 
                                        <th>Path</th> 
                                        <th>Title</th> 
                                        <th>Group Menu</th> 
                                        <th>Aksi</th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($controllers->count()>0)
                                        @foreach($controllers as $key => $c)
                                            @if(isset($c->group_menu))
                                            <tr class="ordering">
                                                <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                                <th>{{++$key}}</th>
                                                <th>{{$c->name}}</th> 
                                                <th>{{$c->text}}</th> 
                                                <th>{{$c->group_menu->name}}</th> 
                                                <th>{!!getActions('controller','edit', $c->id)?getActions('controller','edit', $c->id):NULL!!} &nbsp;{!!getActions('controller','destroy', $c->id)?getActions('controller','destroy', $c->id):NULL!!}</th> 
                                            </tr>
                                            @else
                                            <tr class="ordering">
                                                <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                                <th>{{++$key}}</th>
                                                <th>{{$c->name}}</th> 
                                                <th>{{$c->text}}</th> 
                                                <th>{{$c->group_menu_id}}</th> 
                                                <th>{!!getActions('controller','edit', $c->id)?getActions('controller','edit', $c->id):NULL!!} &nbsp;{!!getActions('controller','destroy', $c->id)?getActions('controller','destroy', $c->id):NULL!!}</th> 
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                                 @if($controllers->count() > 10)
                                <thead>
                                    <tr class="header"> 
                                        <th></th>
                                        <th>No</th> 
                                        <th>Path</th> 
                                        <th>Title</th> 
                                        <th>Group Menu</th> 
                                        <th>Aksi</th>
                                    </tr> 
                                </thead>
                                @endif
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