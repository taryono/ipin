 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Announcements <div style="text-align: right">{!!getActions('announcement','create')?getActions('announcement','create'):NULL!!}</div></div>

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
                                        <th width="50px" nowrap="nowrap">@if($announcements->count() > 0)<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($announcements[0])}}" id="delete_all" data-model="Announcement"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Dari Department</th>
                                        <th>Untuk Department</th>
                                        <th>Status</th> 
                                        <th>Aksi</th> 
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($announcements->count() > 0)
                                        @foreach($announcements as $key => $c)
                                        <tr class="ordering"> 
                                            <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                            <th>{{++$key}}</th>
                                            <th>{{$c->title}}</th>
                                            <th>{{$c->content}}</th>
                                            <th>{{$c->from_department->name}}</th>
                                            <th>{{$c->to_department->name}}</th>
                                            <th>{{($c->is_publis == 1)?"Publis":"Draft"}}</th> 
                                            <th nowrap="nowrap">{!!getActions('announcement','edit', $c->id)?getActions('announcement','edit', $c->id):NULL!!}&nbsp;{!!getActions('announcement','destroy', $c->id)?getActions('announcement','destroy', $c->id):NULL!!}</th> 
                                        </tr>
                                        @endforeach
                                    @else 
                                    <tr class="ordering">
                                        <th colspan="8"><div class="alert alert-info" style="text-align: center"> Data Pengumuman Kosong.. </div></th>
                                    </tr>
                                    @endif
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count"> </span> 
                    </div>


                </div>
            </div>
        </div>
    </div> 
</div>  
