 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Pegawai <div style="text-align: right">{!!getActions('employee','create')?getActions('employee','create'):NULL!!}</div></div>

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
                                        <th width="50px" nowrap="nowrap">@if($users[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($users[0])}}" id="delete_all"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th>
                                        <th>Nama</th> 
                                        <th>Email</th> 
                                        <th>Alamat</th>  
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($users as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th>
                                        <th>{{$c->user_detail?$c->user_detail->first_name:NULL}} &nbsp; {{$c->user_detail?$c->user_detail->last_name:NULL}}</th>  
                                        <th>{{$c->email}}</th>
                                        <th>{{$c->user_detail?$c->user_detail->address:NULL}}</th>
                                        <th>{!!getActions('employee','edit', $c->id)?getActions('employee','edit', $c->id):NULL!!}&nbsp;{!!getActions('employee','destroy', $c->id)?getActions('employee','destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$users->links()}}</span> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>  
<script>
    $(document).ready(function () {
        $(".data-table-search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            console.log(value);
            /*
             $.get("{{route('home.search')}}",{key:$(this).val(),object:$(this).data('class')}, function(res){
             console.log(res);
             });
             */
            $(".data-table tr.ordering").filter(function (e) {
                var tr = $("tr.ordering").children();
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>