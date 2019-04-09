<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Pembelian Barang CV Sarana Tekstil</title>
        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px; 
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/ 
                text-align: center;
                line-height: 35px;
            }

            thead.thead-dark {
                background-color: black;
                color: white;
            }

            tr.border_bottom td {
                border-bottom:2pt solid black;
            }
        </style>
    </head>
    <body>
        <header>
            <table class="table table-striped">  
                <tr>  
                    <th colspan="3">Laporang Pemmbelian Barang </th>   
                </tr>  
                <tr>  
                    <th>Tanggal </th>   
                    <th>: </th>   
                    <th>{{dateFormatIndo(date('Y-m-d'))}} </th>   
                </tr> 
        </table> 
        </header>
        <br><br>
        <table class="table"> 
            <thead class="thead-dark">
                <tr class="header">  
                    <th>No</th>  
                    <th>Kode PO</th> 
                    <th>a/n</th>   
                    <th>Tanggal Permintaan</th> 
                    <th>Tanggal Kirim</th> 
                    <th>Keterangan</th> 
                    <th>Supplier</th>
                    <th>Tanggal Disetujui</th> 
                    <th>Status</th> 
                    <th>Total</th>  
                </tr> 
            </thead>
            <tbody> 
                @if($purchase_orders->count() > 0)
                @foreach($purchase_orders as $key => $c)
                <tr class="border_bottom"> 
                    <th>{{++$key}}</th> 
                    <th>{{$c->code?$c->code:""}}</th> 
                    <th>{{$c->request_by}}</th>  
                    <th>{{dateFormatIndo($c->request_date)}}</th> 
                    <th>{{dateFormatIndo($c->send_date)}}</th> 
                    <th>{{$c->description}}</th> 
                     <th>{{$c->supplier?$c->supplier->name:NULL}}</th> 
                    <th>{{dateFormatIndo($c->approval_date)}}</th>
                    <th>{{$c->status?$c->status->name:""}}</th> 
                    <th>{{$c->total?$c->total:""}}</th> 
                </tr>
                <tr>
                    <td></td>
                    <td colspan="9">
                        <h3>Detail Pembelian</h3>
                        <table class="table table-responsive table-striped"> 
                            <tr>  
                                <th>No</th>  
                                <th>Nama Barang</th>
                                <th>Jumlah</th>     
                                <th>Harga</th>
                                <th>Subtotal</th> 
                            </tr>
                            <?php $purchase_details = $c->purchase_order_detail;?>
                            @if($purchase_details->count() > 0)
                            @foreach($purchase_details as $key => $c)
                            <tr class="ordering"> 
                                <td>{{++$key}}</td> 
                                <td>{{$c->goods?$c->goods->name:NULL}}</td>
                                <td>{{$c->amount}}</td>   
                                <td>{{rupiahFormat($c->price)}}</td> 
                                <td>{{rupiahFormat($c->subtotal)}}</td> 
                            </tr> 
                            @endforeach
                            @endif 
                        </table> 
                    </td>
                </tr>
                @endforeach
                @else 
                <tr><th colspan="8">
                        <div class="alert alert-info" style="text-align: center"> Data Pembelian Barang Kosong.. </div>
                    </th> 
                </tr>
                @endif
            </tbody>

        </table> 
        <footer>
            &COPY; CV SARANA TEKSTIL 2019
        </footer>

    </body>
</html>

