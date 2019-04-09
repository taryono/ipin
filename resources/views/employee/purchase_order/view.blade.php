
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
            <tr> 
                <td colspan="3"> 
                    <b>Detail Pembelian Barang</b>
                </td> 
            </tr>
            <tr> 
                <td>Kode PO </td> 
                <td>:</td> 
                <td>{{$purchase_order->code}}</td> 
            </tr>
            <tr> 
                <td>Supplier</td> 
                <td>:</td> 
                <td>{{$purchase_order->supplier->name}}</td> 
            </tr>
            <tr> 
                <td>Tanggal Pembelian</td> 
                <td>:</td> 
                <td>{{dateFormatIndo($purchase_order->purchase_date)}}</td> 
            </tr>
            <tr> 
                <td>Status</td> 
                <td>:</td> 
                <td>{{$purchase_order->status?$purchase_order->status->name:""}}</td> 
            </tr>
            <tr> 
                <td>Tanggal Diterima</td> 
                <td>:</td> 
                <td>{{$purchase_order->receive_date}}</td> 
            </tr>

            <tr> 
                <td>Keterangan</td> 
                <td>:</td> 
                <td>{{$purchase_order->description}}</td> 
            </tr> 
        </table>  
    </div>
</div>
<div class="row list-goods"> 
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">List Barang</div>
            <div class="panel-body">
                <input type="text" name="search" class="form-control data-table-search-goods" placeholder="Search.." style="width: 20% !important">
                <br>
                <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
                    <thead>
                        <tr class="header">   
                            <th>Nama</th>   
                            <th>Harga</th>  
                            <th>Jumlah Pembelian</th>  
                            <th>Jumlah Diterima</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if($purchase_order->purchase_order_detail->count() > 0)
                        @foreach($purchase_order->purchase_order_detail as $key => $s)
                        @php $c = $s->goods;@endphp
                        <tr class="ordering-list">  
                            <th>{{$c->name}}</th>   
                            <th>{{rupiahFormat($c->price)}}</th>  
                            <th> 
                                {{$s->amount}}
                            </th>  
                            <th> 
                                {{$s->received_amount}}
                            </th>
                        </tr>
                        @endforeach
                        @else
                        <tr> 
                            <th colspan="9"> 
                                <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
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
<script type="text/javascript">
    $(function () {
        pagination(".data-table tbody tr.ordering-list", '.result-count');
        pagination(".data-table tbody tr.ordering-list", '.result-count');
        $(".checked").click(function (e) {
            $id = $(this).attr('data-good_id');
            if ($(this).prop('checked')) {
                $("input.amount" + $id).removeAttr('disabled', 'disabled');
                $(this).parent().parent().removeClass('ordering-list');
            } else {
                $("input.amount" + $id).attr('disabled', 'disabled');
                $("input.amount" + $id).val("");
                $(this).parent().parent().addClass('ordering-list');
            }
        });

        $(".amount").keyup(function (e) {
            $purchase_limit = $(this).attr('data-purchase_limit');
            if (parseInt($(this).val()) > parseInt($purchase_limit)) {
                alert('Tidak boleh melebihi batas pesan. Pesan:' + $(this).val() + " Batas:" + $purchase_limit);
                $(this).val($purchase_limit)
            }
        });
        $("input.data-table-search-goods").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".data-table tr.ordering-list").filter(function (e) {
                var checkbox = $(this).find('input.checked_ids');
                if (checkbox.prop('checked', false)) {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                }

            });
        });

        $(".amount").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }

                    if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).val(0);
                    }
                });
    });
</script>