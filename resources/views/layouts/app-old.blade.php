<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>

        <!-- Styles -->
        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"-->
        <!-- Optional theme -->
        <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"-->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-multiselect.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/sticky-footer-navbar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-comments.css') }}">
        <!--link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"-->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
        <style type="text/css">
            tr.header {
                background-color: black;
                color: white;
                font-weight: bold;
            }
        </style>
        <style type="text/css">
            .wrapper1, .wrapper2 { 
                overflow-x: scroll; 
            }

            .wrapper1 {height: 20px; }
            .wrapper2 {max-height: 600px; }

            .div1 {
                min-width:1000px;
                height: 20px;
            }

            .div2 {
                min-width:1000px;
                max-height: 600px;  
            }
            .data-table-search{
                margin-bottom: 5px;
            }
        </style>
        @yield('style') 
    </head>
    <body style="background-color: #383131"> 
        <nav class="navbar navbar-default" style="position: fixed;width: 100%;z-index: 10000;">
            <div class="container-fluid" style="margin-right: 0px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('welcome')}}">{{ config('app.name', 'Admin') }}</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    @if(Auth::guest() || (Auth::check() && Auth::user()->hasRole("customer")))
                    <!--ul class="nav navbar-nav">
                        <li><a href="{{route('welcome')}}">Home</a></li> 
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Semua Kategori <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach(\App\Models\Category::all() as $c)
                                <li><a href=""></a></li> 
                                @endforeach
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul-->
                    @endif 
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::guest()) 
                        <!--li><a href="{{ route('register') }}">Daftar</a></li>
                        <li><a href="{{ route('login') }}">Masuk</a></li-->
                        @else  
                        @include('layouts.right-menu')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ ucfirst(Auth::user()->user_detail->first_name) }} {{ ucfirst(Auth::user()->user_detail->last_name) }}<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('profile.show',['id'=> Auth::user()->id]) }}">
                                        Profle
                                    </a>
                                </li>  
                                <li>
                                    <a href="{{ route('profile.view_password',['id'=> Auth::user()->id]) }}">
                                        Update Password
                                    </a>
                                </li>  

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav> 

        @yield('content')
        <footer class="footer">
            <div class="container">
                <span class="text-muted"><sup>&copy;</sup> Created By Arifin </span> 
                <span style="float:right;margin-right: 0px; font-weight: bold;color: #01549b">
                    @if(Auth::check()) 
                    {{ucfirst(substr(Auth::user()->listRoles(),0,-1))}}
                    @endif
                </span>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ asset('js/jquery.min.js') }}"></script> 
        <script src="{{ asset('js/apps.js') }}"></script>
        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script-->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>   
        @yield('script')
        <script type="text/javascript">
            $(document).ready(function () {
                $('.example-getting-started').multiselect({
                    enableFiltering: true,
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(".data-table-search").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    /*
                     $.get("{{route('home.search')}}",{key:$(this).val(),object:$(this).data('class')}, function(res){
                     console.log(res);
                     });
                     */
                    $(".data-table tr.ordering").filter(function (e) {
                        var tr = $("tr.ordering").children();
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        <script type="text/javascript">
            function checkDelete(url, element) {
                if (confirm('Are you sure to delete?')) {
                    console.log($(element).parent().parent().remove());

                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (result) {
                            if (result.success == true) {
                                $(element).parent().parent().remove()
                            }
                        }
                    });
                }
            }

            $(function () {
                $("body").on("click", "a.delete", function (e) {
                    e.preventDefault();
                    checkDelete($(this).attr("href"), this);
                }).on("click", "button.search", function (e) {
                    e.preventDefault();
                    var val = $("input#search").val();
                    $.post($('form.form-search').attr('action'), {search: val}, function (res) {
                        $("div.search-content").html(res);
                    })
                }).on("click", "input.checked_ids", function () {
                    if ($(this).is(':checked')) {
                        $("input.ids").prop("checked", true);
                    } else {
                        $("input.ids").prop("checked", false);
                    }

                }).on("click", "a#delete_all", function (e) {
                    e.preventDefault();
                    $ids = [];
                    $.each($("input.ids"), function (i, v) {
                        if ($(v).is(':checked')) {
                            $ids.push($(v).val());
                        }

                    });
                    if (confirm('Anda yakin data ini akan dihapus')) {
                        $.post("{{route('home.delete_all')}}", {ids: $ids, object: $(this).data('class')}, function (res) {
                            //window.location.href = res.redirect;
                            $.each($("input.ids"), function (i, v) {
                                if ($(v).is(':checked')) {
                                    $(v).parent().parent().remove();
                                }
                            });
                        });
                    }

                });
            });
        </script> 
        <script type="text/javascript">
            $(document).ready(function () {

                $('.plus-collapse').click(function () {
                    var id = $(this).data('rowid');
                    var url = $(this).data('url-source');

                    if ($(this).hasClass('fa-plus-square')) {
                        $('#row_collapse_' + id).parent().removeClass('hide');
                        $('#row_collapse_' + id).removeClass('hidden');
                        $(this).removeClass('fa-plus-square');
                        $(this).addClass('fa-minus-square');

                        $.ajax({
                            url: url,
                            data: {id: id},
                            success: function (e) {
                                $('#row_collapse_' + id).html(e);
                            }
                        });
                    } else {
                        $('#row_collapse_' + id).addClass('hidden');
                        $('#row_collapse_' + id).parent().addClass('hide');
                        $(this).addClass('fa-plus-square');
                        $(this).removeClass('fa-minus-square');
                    }
                });
            });
        </script>
        <script src="{{ asset('js/editor.js') }}"></script>
        <script src="{{ asset('js/apps.js') }}"></script> 
        <script type="text/javascript">
            $(function () {
                $(".wrapper1").scroll(function () {
                    $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
                });
                $(".wrapper2").scroll(function () {
                    $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
                });
            });
        </script>
        <svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text></svg>
    </body>
</html> 
