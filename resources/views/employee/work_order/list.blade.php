
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Work Order <div style="text-align: right">{!!getActions('work_order', 'create')?getActions('work_order', 'create'):NULL!!}</div></div>

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
                                        @if(getActions('work_order', 'destroy'))
                                        <th nowrap="nowrap">@if($work_orders[0])<input type="checkbox" class="checked_ids"> &nbsp;<a href="" data-class="{{get_class($work_orders[0])}}" id="delete_all" data-model="Work Order"><i class="fa fa-trash" aria-hidden="true"></i></a><div>@endif</th>
                                        @endif
                                        <th>No</th> 
                                        <th>Kode</th>   
                                        <th>Customer</th> 
                                        <th>Keterangan</th> 
                                        <th>Tanggal Pembuatan</th> 
                                        <th>Diajukan Oleh</th> 
                                        <th>Target Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>  
                                    </tr> 
                                </thead>
                                <tbody> 
                                    @if($work_orders->count() > 0)
                                    @foreach($work_orders as $key => $c)
                                    <tr class="ordering">
                                        @if(getActions('work_order', 'destroy'))
                                        <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
                                        @endif
                                        <th>{{++$key}}</th>
                                        <th>{{$c->code}}</th>   
                                        <th>{{$c->customer_id?$c->customer->name:NULL}}</th>   
                                        <th>{{$c->description}}</th> 
                                        <th>{{$c->date}}</th> 
                                        <th>{{$c->request_by}}</th>
                                        <th>{{$c->target_date}}</th>
                                        <th>{{($c->status==1)?'Aktif':'Tidak Aktif'}}</th>
                                        <th>{!!getActions('work_order', 'edit', $c->id)?getActions("work_order", 'edit', $c->id):NULL!!}&nbsp;{!!getActions('work_order', 'destroy', $c->id)?getActions('work_order', 'destroy', $c->id):NULL!!}</th> 
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="ordering">
                                        @if(getActions('work_order', 'destroy'))
                                        <th colspan="10">
                                        @else 
                                        <th colspan="11">
                                        @endif
                                            <div class="alert alert-info" style="text-align: center"> Data Work Order Kosong.. </div>
                                        </th> 
                                    </tr>
                                    @endif
                                </tbody>
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