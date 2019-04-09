<form class="form-horizontal" method="POST" action="{{ route('request_order.store') }}">
    {{ csrf_field() }} 
    <div class="form-group">
        <label for="department_id" class="col-md-3 control-label">Dari Department :</label> 
        <div class="col-md-6">
            <select id="department_id" name="department_id" class="form-control example-getting-started">  
                <option value="">-- Pilih Department --</option> 
                @foreach($departments as $c)
                <option value="{{$c->id}}">{{ucfirst($c->name)}}</option> 
                @endforeach
            </select>
            @if ($errors->has('department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('department_id') }}</strong>
            </span>
            @endif
        </div> 
    </div> 
    <div class="form-group">
        <label for="to_department_id" class="col-md-3 control-label">Untuk Department :</label> 
        <div class="col-md-6">
            <select id="to_department_id" name="to_department_id" class="form-control example-getting-started">  
                <option value="">-- Pilih Department --</option> 
                @foreach($departments as $c)
                <option value="{{$c->id}}">{{ucfirst($c->name)}}</option> 
                @endforeach
            </select>
            @if ($errors->has('to_department_id'))
            <span class="help-block">
                <strong>{{ $errors->first('to_department_id') }}</strong>
            </span>
            @endif
        </div> 
    </div> 
    <div class="form-group">
        <label for="request_by" class="col-md-3 control-label">a/n :</label> 
        <div class="col-md-6"> 
            <input id="request_by" type="text" class="form-control" name="request_by" value="" required autofocus placeholder="a/n">
             
        </div> 
    </div>
    @if(Auth::user()->hasRole('kepala_produksi'))
    <div class="form-group">
        <label for="approved_by" class="col-md-3 control-label">Disetujui oleh :</label> 
        <div class="col-md-6"> 
            <input id="approved_by" type="text" class="form-control" name="approved_by" value="" required autofocus placeholder="Disetujui oleh">
             
        </div> 
    </div>
    <div class="form-group">
        <label for="approval_date" class="col-md-3 control-label">Tgl Disetujui :</label> 
        <div class="col-md-6"> 
            <input id="approval_date" type="date" class="form-control" name="approval_date" value="" required autofocus placeholder="Tanggal Disetujui">
             
        </div> 
    </div>
    @endif
    <div class="form-group">
        <label for="request_date" class="col-md-3 control-label">Tanggal Permintaan :</label> 
        <div class="col-md-6"> 
            <input id="request_date" type="date" class="form-control" name="request_date" value="{{ old('request_date') }}" required autofocus placeholder="Tanggal permintaan">
            @if ($errors->has('request_date'))
            <span class="help-block">
                <strong>{{ $errors->first('request_date') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="form-group">
        <label for="send_date" class="col-md-3 control-label">Tanggal Kirim :</label> 
        <div class="col-md-6"> 
            <input id="send_date" type="date" class="form-control" date-format="dd/mm/yyyy" name="send_date" value="{{ old('send_date') }}" required autofocus placeholder="Tanggal Permintaan">
            @if ($errors->has('send_date'))
            <span class="help-block">
                <strong>{{ $errors->first('send_date') }}</strong>
            </span>
            @endif
        </div> 
    </div> 
    <div class="form-group">
        <label for="description" class="col-md-3 control-label">Keterangan :</label> 
        <div class="col-md-6"> 
            <textarea id="description"  class="form-control ckeditor" name="description" required></textarea>
            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div> 
    </div>
    <div class="row">
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
                                <th nowrap="nowrap">Batas Pesan</th> 
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
                                <th>{{$c->request_limit}}</th> 
                                <th>
                                    <input type="hidden" name="prices[{{$c->id}}]" value="{{$c->price}}">
                                    <input disabled="disabled" class="amount amount{{$c->id}}" type="text" value="" name="request_amounts[{{$c->id}}]" size="2" data-request_limit="{{$c->request_limit}}">
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
</form>
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
            
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
            $request_limit = $(this).attr('data-request_limit'); 
            if (parseInt($(this).val()) > parseInt($request_limit)) {
                alert('Tidak boleh melebihi batas pesan. Pesan:' + $(this).val() + " Batas:" + $request_limit);
                $(this).val($request_limit)
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

