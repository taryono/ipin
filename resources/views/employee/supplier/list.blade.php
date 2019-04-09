 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Suppliers <div style="text-align: right">{!!getActions('supplier','create')?getActions('supplier','create'):NULL!!}</div></div>

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
                                        <th width="50px" nowrap="nowrap">@if($suppliers[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($suppliers[0])}}" id="delete_all" data-model="Supplier"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        <th>No</th>
                                        <th>Kode</th>
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
                                    @foreach($suppliers as $key => $c)
                                    <tr class="ordering">
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        <th>{{++$key}}</th>
                                        <th>{{$c->code}}</th>
                                        <th>{{$c->name}}</th>
                                        <th>{{$c->address}}</th>
                                        <th>{{$c->cellphone}}</th>
                                        <th>{{$c->phone}}</th>
                                        <th>{{$c->subdistrict?$c->subdistrict->name:""}}</th>
                                        <th>{{($c->district)?$c->district->name:""}}</th>
                                        <th>{{$c->city?$c->city->name:""}}</th>
                                        <th>{{$c->region?$c->region->name:""}}</th>
                                        <th>{{$c->country?$c->country->name:""}}</th>
                                        <th nowrap="nowrap">{!!getActions('supplier','edit', $c->id)?getActions('supplier','edit', $c->id):NULL!!}&nbsp;{!!getActions('supplier','destroy', $c->id)?getActions('supplier','destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="table-list-footer">
                        <span class="result-count">{{$suppliers->links()}}</span> 
                    </div>


                </div>
            </div>
        </div>
    </div> 
</div>  
