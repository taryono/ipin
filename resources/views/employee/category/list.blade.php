 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Kategori <div style="text-align: right">{!!getActions('category', 'create')?getActions('category', 'create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check data-table">
                        <input type="text" name="search" class="form-control data-table-search" placeholder="Search.." style="width: 20% !important" @if($categories[0]) data-class="{{get_class($categories[0])}}" @endif>
                        <thead>
                            <tr class="header"> 
                                <th width="50px">@if($categories[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($categories[0])}}" id="delete_all" data-model="Kategori"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                <th>No</th> 
                                <th>Kode</th>
                                <th>Nama</th>   
                                <th>Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @if($categories->count() > 0)
                            @foreach($categories as $key => $c)
                            <tr class="ordering">
                                <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                <th>{{++$key}}</th>
                                <th>{{$c->code}}</th>
                                <th>{{$c->name}}</th>   
                                <th>{!!getActions('category', 'edit', $c->id)?getActions("category", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('category', 'destroy', $c->id)?getActions('category', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                            @else
                            <tr class="ordering">
                                <th colspan="4">
                                    <div class="alert alert-info" style="text-align: center"> Data Kategori Kosong.. </div>
                                </th> 
                            </tr>
                            @endif
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