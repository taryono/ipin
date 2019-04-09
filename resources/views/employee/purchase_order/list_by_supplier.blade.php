<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">List Barang</div>
        <div class="panel-body">
            <input type="text" name="search" class="form-control data-table-search-goods" placeholder="Search.." style="width: 20% !important">
            <br>
            <table class="table table-striped table-check data-table" style="max-height: 500px;overflow-y: auto"> 
                <thead>
                    <tr class="header">  
                        <th scope="col">#</th>  
                        <th>Nama</th>  
                        <th>Stok</th> 
                        <th>Harga</th> 
                        <th nowrap="nowrap">Batas Pembelian</th> 
                        <th>Jumlah Pesan</th>  
                    </tr>
                </thead>
                <tbody> 
                    @if($goods->count() > 0)
                    @foreach($goods as $key => $c)
                    <tr class="ordering-list"> 
                        <th><input class="checked" type="checkbox" name="goods_ids[]" data-good_id="{{$c->id}}" value="{{$c->id}}" data-check="unchecked"></th> 
                        <th>{{$c->name}}</th>  
                        <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                        <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                        <th>{{rupiahFormat($c->price)}}</th> 
                        <th>{{$c->purchase_limit}}</th> 
                        <th>
                            <input type="hidden" name="prices[{{$c->id}}]" value="{{$c->price}}">
                            <input disabled="disabled" class="amount amount{{$c->id}}" type="text" value="" name="request_amounts[{{$c->id}}]" size="2" data-purchase_limit="{{$c->purchase_limit}}">
                        </th>  
                    </tr>
                    @endforeach
                    @else
                    <tr> 
                        <th colspan="9"> 
                            <div class="alert alert-info" style="text-align: center"> Data Barang Dari Supplier {{$supplier->name}} Kosong.. </div>
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


<script type="text/javascript">
    $(function () {
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
            if (parseInt($(this).val()) < 1) {
                alert('Tidak boleh 0 atau kosong:' + $(this).val() + " Batas:" + $purchase_limit);
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