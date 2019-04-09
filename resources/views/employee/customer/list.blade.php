 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Customers <div style="text-align: right">{!!getActions('customer','create')?getActions('customer','create'):NULL!!}</div></div>

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
                                        <th width="50px" nowrap="nowrap">@if($customers->count() > 0)<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($customers[0])}}" id="delete_all" data-model="Pelanggan"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Handphone</th>
                                        <th>Telepon</th>
                                        <th>Kelurahan</th>
                                        <th>Kecamatan</th>
                                        <th>Kabupaten</th>
                                        <th>Provinsi</th>
                                        <th>Negara</th>
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @foreach($customers as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th>
                                        <th>{{$c->name}}</th>
                                        <th>{{$c->address}}</th>
                                        <th>{{$c->cellphone}}</th>
                                        <th>{{$c->phone}}</th>
                                        <th>{{$c->subdistrict?$c->subdistrict->name:""}}</th>
                                        <th>{{($c->district)?$c->district->name:""}}</th>
                                        <th>{{$c->city?$c->city->name:""}}</th>
                                        <th>{{$c->region?$c->region->name:""}}</th>
                                        <th>{{$c->country?$c->country->name:""}}</th>
                                        <th nowrap="nowrap">{!!getActions('customer','edit', $c->id)?getActions('customer','edit', $c->id):NULL!!}&nbsp;{!!getActions('customer','destroy', $c->id)?getActions('customer','destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$customers->links()}}</span> 
                    </div>


                </div>
            </div>
        </div>
    </div> 
</div>  