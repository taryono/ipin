@if($shipping_orders->count() > 0)
@foreach($shipping_orders as $key => $c)
<tr class="ordering">
    @if(getActions('shipping_order', 'destroy', $c->id))
    <td>
        <input type="checkbox" class="ids" name="ids[]" value="{{$c->id}}">                                            
    </td>
    @endif
    <td>{{++$key}}</td>
    <td><a href="#" class="collapsing"><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{url('shipping_order/getDetail')}}"></i>
            {{$c->customer?$c->customer->name:NULL}}</a>
    </td>  
    <td>{{$c->work_order?$c->work_order->name:NULL}}</td> 
    <td>{{$c->description}}</td>   
    <td>{{dateFormatIndo($c->request_date)}}</td> 
    <td>{{rupiahFormat($c->total)}}</td>
    <td>{{dateFormatIndo($c->send_date)}}</td>   
    <td nowrap="nowrap">
        {!!getActions('shipping_order', 'show', $c->id)?getActions("shipping_order", 'show', $c->id):NULL!!}
        &nbsp;       
        @if($c->status_id != 5)
        {!!getActions('shipping_order', 'edit', $c->id)?getActions("shipping_order", 'edit', $c->id):NULL!!}
        &nbsp;
        {!!getActions('shipping_order', 'destroy', $c->id)?getActions('shipping_order', 'destroy', $c->id):NULL!!}
        @endif
    </td> 
</tr>
<tr class="hidden row_collapse" id="row_collapse_{{$c->id}}"></tr>
@endforeach
@else
<tr class="ordering">
    @if(getActions('shipping_order', 'destroy', 1))
    <th colspan="13">
        @else 
    <th colspan="12">
        @endif
        <div class="alert alert-info" style="text-align: center"> Data Pengiriman Barang Kosong.. </div>
    </th> 
</tr>
@endif

<script type="text/javascript">
    $(document).ready(function () { 
        $('.plus-collapse').click(function () { 
            var id = $(this).data('rowid');
            var url = $(this).data('url-source'); 
            if ($(this).hasClass('fa-plus-square')) {
                $("div.content").addClass("loading"); 
                $('#row_collapse_' + id).removeClass('hidden');
                $(this).removeClass('fa-plus-square');
                $(this).addClass('fa-minus-square'); 
                $.ajax({
                    url: url,
                    data: {id: id},
                    success: function (e) {
                        $("div.content").removeClass("loading");
                        $('#row_collapse_' + id).html(e);
                    },
                    error: function(e){
                        alert('error '+e);
                    }
                });
            } else {
                $('#row_collapse_' + id).addClass('hidden');
                //$('#row_collapse_' + id).parent().addClass('hide');
                $(this).addClass('fa-plus-square');
                $(this).removeClass('fa-minus-square');
            }
        }); 
        
    });
</script>