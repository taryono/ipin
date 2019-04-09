<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Kelurahan <div style="text-align: right">{!!getActions('subdistrict', 'create')?getActions('subdistrict', 'create'):NULL!!}</div></div>

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
                                        <th width="50px" nowrap="nowrap">@if($subdistricts->count() > 0)<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($subdistricts[0])}}" id="delete_all"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th> 
                                        <th>Nama</th>   
                                        <th>Kecamatan</th>  
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($subdistricts->count() > 0)
                                    @foreach($subdistricts as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{$no++}}</th>
                                        <th>{{$c->name}}</th> 
                                        <th>{{$c->district?$c->district->name:""}}</th> 
                                        <th>{!!getActions('subdistrict', 'edit', $c->id)?getActions("subdistrict", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('subdistrict', 'destroy', $c->id)?getActions('subdistrict', 'destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="ordering">
                                        <th colspan="4">
                                            <div class="alert alert-info" style="text-align: center"> Data Kelurahan Kosong.. </div>
                                        </th> 
                                    </tr>
                                    @endif
                                </tbody>
                                @if($subdistricts->count() > 10)
                                <thead>
                                    <tr class="header"> 
                                        <th width="50px" nowrap="nowrap"></th>
                                        <th>No</th> 
                                        <th>Nama</th>   
                                        <th>Kecamatan</th>  
                                        <th>Aksi</th>  
                                    </tr>
                                </thead>
                                @endif
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count-ignore">{{$subdistricts->links()}}</span> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>  
