 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <title>System Persediaan Barang CV. SARANA TEKSTIL</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />        
        <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> 
        <link href="{{ asset('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css"> 
        <link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/plugins.min.css') }}" rel="stylesheet" type="text/css">  
        <link href="{{ asset('layout/css/themes/darkblue.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('layout/css/custom.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('layout/css/custom.css') }}" rel="stylesheet" type="text/css"> 
        <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('layout/css/layout.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />  
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

            wrapper1 {height: 20px; }
            .wrapper2 {*max-height: 600px; }

            .div1 {
                *min-width:1000px;
                height: 20px;
            }

            .div2 {
                *min-width:1000px;
                *max-height: 600px;  
            }
            .data-table-search{
                margin-bottom: 5px;
            }
            @media (min-width: 768px){
                .modal-dialog {
                    width: 800px;
                    margin: 30px auto;
                }
            }
            
            .page-header.navbar .top-menu .navbar-nav>li.dropdown-user .dropdown-menu {
                width: 200px;
            }

        </style> 
        <style>

            /* Start by setting display:none to make this hidden.
           Then we position it in relation to the viewport window
           with position:fixed. Width, height, top and left speak
           for themselves. Background we set to 80% white with
           our animation centered, and no-repeating */
            .modal-loader {
                display:    none;
                position:   fixed;
                z-index:    10000;
                top:        0;
                left:       0;
                height:     90%;
                width:      100%;
                background: rgba( 255, 255, 255, .2 ) 
                    url('<?=asset("layout/img/loading-spinner-blue.gif") ?>')
                    50% 50% 
                    no-repeat;
            }

            /* When the body has the loading class, we turn
               the scrollbar off with overflow:hidden */
            div.loading {  
                overflow: hidden; 
            }

            /* Anytime the body has the loading class, our
               modal element will be visible */
            div.loading .modal-loader {
                display: block;
            }
            
            .show {
                display: inline;
            }
             
        </style>
        @yield('style')
    </head>
    </head>
    <!-- END HEAD -->
     
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-menu-closed">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">  
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                             
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="{{ asset('images/user.png') }}"/>
                                    <span class="username username-hide-on-mobile">{{Auth::user()->user_detail->first_name}} {{Auth::user()->user_detail->last_name}}</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href=""> 
                                            <a href="" data-url="{{ route('profile.show',['id'=> Auth::user()->id]) }}" class="sub"> <i class="icon-user"></i> Profle
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" data-url="{{ route('profile.view_password',['id'=> Auth::user()->id]) }}" class="sub">
                                            <i class="icon-lock"></i> Update Password
                                        </a> 
                                    </li>
                                    <li>
                                        <a href="" class="login_as"> <i class="icon-eye"></i>Login As : <br>
                                             <div style="    padding-left: 20px; width: 100%; display: block; font-weight: bold; text-transform: capitalize;">
                                                 <?php echo str_replace(',', '|', Auth::user()->listRoles()) ?> 
                                             </div>
                                        </a> 
                                    </li>
                                    <li class="divider"> </li>
                                    <li> 
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-logout"></i>Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form> 
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!--
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                        -->
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu page-sidebar-menu-light page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            
                            <li>
                                <a href="">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard </span> 
                                    <span class="selected"></span> 
                                </a>
                            </li> 
                            @include('layouts.right-menu')
                            
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Dashboard</span>
                                </li> 
                            </ul>
                            <div class="page-toolbar hide">
                                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </div>  
                        <br> 
                        
                        <div class="content">
                            <div class="content-wrapper"><center><h1>Welcome to  <?php echo str_replace(',', ' ', ucfirst(Auth::user()->listRoles())) ?>  Dashboard</h1></center></div>
                            <div class="modal-loader"><!-- Place at bottom of page --></div> 
                        </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
                <!-- END QUICK SIDEBAR -->
            </div> 
            
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner"> 2018 - CV Sarana Tekstil 
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!--a class="btn default" id="popup" data-toggle="modal" href="#modal_popup"></a-->
        <div class="modal fade" id="modal_popup" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn btn-primary" id="submit-button">Simpan</button>
                        <button type="button" class="btn btn btn-primary close-modal" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
       
        
        <!--[if lt IE 9]>
        <script src="{{ asset('js/ie/respond.min.js') }}"></script>
        <script src="{{ asset('js/ie/excanvas.min.js') }}"></script>
        <script src="{{ asset('js/ie/ie8.fix.min.js') }}"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/apps.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script> 
        <!-- END CORE PLUGINS -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script>  
        <script src="{{ asset('js/scripts/dashboard.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/ui-blockui.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/ui-toastr.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/ui-notific8.min.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/scripts/layout.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('layout/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('layout/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
        <script src="{{ asset('js/pesan.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/pagination.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/page.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        
        <script type="text/javascript">
            function checkDelete(url, element) {
                if (confirm('Are you sure to delete?')) { 
                    $(element).parent().parent().remove()
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (res) {
                            message(res.status,res.msg, res.redirect); 
                        }
                    });
                }
            }

            $(function () {
                $("body").on("click", "a.destroy", function (e) {
                    e.preventDefault();
                    checkDelete($(this).attr("data-url"), this);
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
                        $.post("{{route('home.delete_all')}}", {ids: $ids, object: $(this).data('class'),model:$(this).attr('data-model')}, function (res) {                            
                            $.each($("input.ids"), function (i, v) {
                                if ($(v).is(':checked')) {
                                    $(v).parent().parent().remove();
                                } 
                            });
                            message(res.status,res.msg, res.redirect);
                        });
                    }

                });
            });
        </script> 
        
        <script src="{{ asset('js/editor.js') }}"></script>
        <script src="{{ asset('js/apps.js') }}"></script>  
        
        <!-- END PAGE LEVEL PLUGINS -->
        <script type="text/javascript"> 
        /* Init Metronic's core jquery plugins and layout scripts */
        $(document).ready(function() {   
            App.init(); // Run metronic theme
            App.setAssetsPath("{{ asset('public') }}"); // Set the assets folder path     
            $(".wrapper1").scroll(function () {
                $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
            });
            $(".wrapper2").scroll(function () {
                $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
            });

            $("body").on('click','a.sub', function(e){
                e.preventDefault(); 
                $(this).parent().parent().children().removeClass('active open')
                $("div.content").addClass("loading");  
                $(this).parent().addClass("active open");
                $(this).append('<span class="selected"></span>');
                $.get($(this).attr('data-url'), function(res){
                    $("div.content").removeClass("loading");
                    $("div.content-wrapper").html(res); 
                    pagination(".data-table tbody tr.ordering",'.result-count');
                }).fail(function(res) {
                    $("div.content").removeClass("loading");  
                    if(JSON.stringify(res.responseJSON.error) == '"Unauthenticated."'){
                        alert("Session timeout");
                        window.location.reload();
                    }else{
                         alert(JSON.stringify(res.responseJSON.error));
                    }
                });
            }).on('click','a.edit,a.create,a.show', function(e){
                e.preventDefault();      
                $("div.content").addClass("loading"); 
                if($(this).is('a.show')){
                     $("div.modal").find("button#submit-button").hide();
                }else{
                    $("div.modal").find("button#submit-button").show();
                }
                $.get($(this).attr('data-url'), function(res){  
                    $("div.content").removeClass("loading");
                    $("div.modal").find(".modal-body").html(res);
                }).fail(function(res){
                    $("div.content").removeClass("loading");
                    if(JSON.stringify(res.responseJSON.error) == '"Unauthenticated."'){
                        alert("Session timeout");
                        window.location.reload();
                    }else{
                         alert(JSON.stringify(res.responseJSON.error));
                    }
                });
            }).on('click','a.acl-edit', function(e){
                e.preventDefault();      
                $("div.content").addClass("loading"); 
                $.get($(this).attr('href'), function(res){
                    $("div.content").removeClass("loading");
                    $("div.content-wrapper").html(res);
                }).fail(function(res){
                    $("div.content").removeClass("loading");
                    if(JSON.stringify(res.responseJSON.error) == '"Unauthenticated."'){
                        alert("Session timeout");
                        window.location.reload();
                    }else{
                         alert(JSON.stringify(res.responseJSON.error));
                    }
                });
            }).on('click','button#submit-button', function(e){
                e.preventDefault();   
                var form = $('form.form-horizontal');  
                
                var formData = new FormData($('form.form-horizontal')[0]);
                $.ajax({ 
                    type: 'POST',
                    url: $('form.form-horizontal').attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {   
                        $('button.close-modal').click();
                        message(res.status,res.msg, res.redirect);
                    },
                    error: function (res) {  
                        $('button.close-modal').click();
                        message('error',res);
                    }
                });  
            }).on('click','ul.pagination li a', function(e){
                e.preventDefault();   
                if(!$(this).parent().is('.disabled')){
                    $("div.content").addClass("loading"); 
                    $.get($(this).attr('href'), function(res){
                        $("div.content").removeClass("loading");
                        $("div.content-wrapper").html(res);
                    }).fail(function(res){
                        $("div.content").removeClass("loading");
                        if(JSON.stringify(res.responseJSON.error) == '"Unauthenticated."'){
                            alert("Session timeout");
                            window.location.reload();
                        }else{
                             alert(JSON.stringify(res.responseJSON.error));
                        }
                    });
                } 
            }).on('click','a.login_as', function(e){
                e.preventDefault();    
            });
            $('#clickmewow').click(function ()
            {
                $('#radio1003').attr('checked', 'checked');
            });
            var options = { 
                complete: function(res) 
                {
                    $('button.close-modal').click();
                    message(res.status,res.msg, res.redirect);
                }
              };
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
    @yield('script')
    </body> 
</html>