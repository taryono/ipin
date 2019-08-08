 
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List Pegawai <div style="text-align: right">{!!getActions('employee','create')?getActions('employee','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check data-table">
                        <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important">
                        <thead>
                            <tr class="header"> 
                                <th width="10px">No</th>
                                <th width="10px">Nama</th> 
                                <th width="10px">Email</th> 
                                <th width="10px">Jabatan</th>
                                <th width="10px">Deparmtent</th>
                                <th width="10px">Alamat</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($employees as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th>  
                                <th width="10px">{{$c->email}}</th>
                                <th width="10px">{{$c->position?$c->position->name:NULL}}</th>
                                <th width="10px">{{$c->department?$c->department->name:NULL}}</th>
                                <th width="10px">{{$c->address}}</th>
                                <th width="10px">{!!getActions('employee','edit', $c->id)?getActions('employee','edit', $c->id):NULL!!}&nbsp;{!!getActions('employee','destroy', $c->id)?getActions('employee','destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$employees->links()}}</span> 
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