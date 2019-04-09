 
@if($goodies->count() > 0)
@foreach($goodies as $key => $c)
<tr class="ordering">
    @if(getActions('goods', 'destroy', 1))
    <th><input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}"></th>
    @endif
    <th>{{++$key}}</th>  
    <th>{{$c->name}}</th> 
    <th>{{$c->description}}</th>  
    <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
    <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
    <th>{{rupiahFormat($c->price)}}</th> 
    <th>{{$c->request_limit}}</th> 
    <th>{{$c->category?$c->category->name:""}}</th> 
    <th>{{$c->supplier?$c->supplier->name:""}}</th>  
    <th nowrap="nowrap"> 
        {!!getActions('goods', 'show', $c->id)!!} 
        {!!getActions('goods', 'edit', $c->id)!!} 
        {!!getActions('goods', 'destroy', $c->id)!!} 
    </th> 
</tr>
@endforeach 
@else
<tr class="ordering">
    @if(getActions('goods', 'destroy', 1))
    <th colspan="11">
        @else 
    <th colspan="10">
        @endif 
        <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
    </th> 
</tr>
@endif 
