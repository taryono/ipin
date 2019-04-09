<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Persediaan Barang CV Sarana Tekstil</title>
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
                    <th colspan="3">Laporang Persediaan Barang </th>   
                </tr>  
                <tr>  
                    <th>Tanggal </th>   
                    <th>: </th>   
                    <th>{{dateFormatIndo(date('Y-m-d'))}} </th>   
                </tr> 
        </table> 
        </header>
        <br><br>
        <table class="table table-striped"> 
            <thead class="thead-dark">
                <tr class="header">  
                    <th scope="col">No</th>  
                     <th>Kode Barang</th> 
                    <th>Nama</th> 
                    <th>Keterangan</th>   
                    <th>Stok</th> 
                    <th>Harga</th> 
                    <th nowrap="nowrap">Batas Pesan</th> 
                    <th>Kategori</th> 
                    <th>Supplier</th>  
                </tr> 
            </thead>
            <tbody> 
                @if($goodies->count() > 0)
                @foreach($goodies as $key => $c)
                <tr class="border_bottom"> 
                    <th>{{++$key}}</th>
                    <th>{{$c->goods_code?$c->goods_code->name:NULL}}</th>   
                    <th>{{$c->name}}</th> 
                    <th>{{$c->description}}</th>  
                    <?php $color = ($c->amount <= $c->min_amount) ? 'red' : "green" ?>
                    <th style="color:{{$color}}; font-weight:bold;">{{$c->amount}} ({{$c->package?$c->package->symbol:""}})</th> 
                    <th>{{rupiahFormat($c->price)}}</th> 
                    <th>{{$c->request_limit}}</th> 
                    <th>{{$c->category?$c->category->name:""}}</th> 
                    <th>{{$c->supplier?$c->supplier->name:""}}</th>  
                </tr>
                @endforeach
                @else
                <tr class="ordering"> 
                    <th colspan="10"> 
                        <div class="alert alert-info" style="text-align: center"> Data Barang Kosong.. </div>
                    </th> 
                </tr>
                @endif
                 <thead class="thead-dark">
                     <tr> <th colspan="10"></th></tr>
                 </thead>
                         
            </tbody>
        </table> 
        <footer>
            &COPY; CV SARANA TEKSTIL 2019
        </footer>

    </body>
</html>

