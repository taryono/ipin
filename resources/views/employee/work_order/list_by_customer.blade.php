@if($work_orders->count()>0)
<select id="work_order_id" name="work_order_id" class="form-control example-getting-started">  
    @foreach($work_orders as $w)
    <option value="{{$w->id}}" data-cust="{{$w->customer_id}}">{{ucfirst($w->code)}}</option> 
    @endforeach
</select> 
@else 
<div class="alert alert-danger">Work Order Belum Dibuat</div>
@endif