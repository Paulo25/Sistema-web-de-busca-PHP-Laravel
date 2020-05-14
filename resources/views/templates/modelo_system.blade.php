<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>System search</title>
    <link rel="icon" href="{{asset('icon-rel.png')}}">
{{--<script src="{{asset('js/scripts.js')}}"></script>--}}

<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    {{--BIBLIOTECA--}}
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}"/>

    <!-- STYLES CUSTOM-->
    <link rel="stylesheet" href="{{asset('css/style_system.css')}}">

    <!-- SCRIPTS CUSTOM -->
    <script src="{{ mix('js/scripts.js') }}"></script>

    {{--swiper--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.js"></script>

    {{--highcharts--}}
    <script src="{{asset('js/highcharts.js')}}"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
{{--spinner--}}
<div class="loader" id="ajaxLoader" style="display:none">
    <div id="floatingCirclesG">
        <div class="f_circleG" id="frotateG_01"></div>
        <div class="f_circleG" id="frotateG_02"></div>
        <div class="f_circleG" id="frotateG_03"></div>
        <div class="f_circleG" id="frotateG_04"></div>
        <div class="f_circleG" id="frotateG_05"></div>
        <div class="f_circleG" id="frotateG_06"></div>
        <div class="f_circleG" id="frotateG_07"></div>
        <div class="f_circleG" id="frotateG_08"></div>
    </div>
</div>
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('system.adminController.index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>PV</b>V</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SYSTEM - ADMIN</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegação</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <small class="bg-red">Online</small>
                            @php
                                $nome =  explode(' ', Auth::user()->nome);
                                $nome = $nome[0] . (count($nome) > 1 ? ' '. end($nome) : '');
                            @endphp
                            <span class="hidden-xs">{{$nome}}</span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <p>
                                    www.paulovitor.com.br - Desenvolvimento de Sistemas
                                    <small>www.youtube.com/tutoriais01</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Fechar</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Controle</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('system.adminController.index')}}"><i class="fa fa-circle-o"></i>
                                Linguagens</a></li>
                        <li><a href="{{route('system.adminController.create')}}"><i class="fa fa-circle-o"></i>Criar</a>
                        </li>
                        <li><a href="{{route('system.adminController.imagem')}}"><i
                                    class="fa fa-circle-o"></i>Imagens</a>
                        </li>
                        <li>
                            <a href="{{route('system.dashboardController.index')}}"><i class="fa fa-circle-o"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('system.notificacaoController.index')}}"><i class="fa fa-circle-o"></i>Notificação</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Login</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('system.usuarioController.index')}}"><i class="fa fa-circle-o"></i>
                                Usuarios</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-plus-square"></i> <span>Ajuda</span>
                        <small class="label pull-right bg-red">PDF</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-info-circle"></i> <span>Sobre...</span>
                        <small class="label pull-right bg-yellow">IT</small>
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fa fa-sign-out-alt"></i> <span>SAIR</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Painel de Controle</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>

                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!--Conteudo-->
                                @yield('conteudo')
                                <!--Fim Conteudo-->
                                </div>
                            </div>

                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versão</b> 5.3.0
    </div>
    <strong>Copyright &copy; 2018-2030 <a href="https://github.com/Paulo25" target="_blank">S-ystem</a>.</strong> Todos
    os direitos reservados.
</footer>


<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<!-- jQuery-UI -->
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<!-- jQuery-datepicker -->
<script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>


<!-- ==================MODAL DEFAULT ==================-->
<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-keyboard="false"
     data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Content -->
        </div>
    </div>
</div>
<!-- ==================FIM MODAL DEFAULT ==================-->

</body>
</html>
