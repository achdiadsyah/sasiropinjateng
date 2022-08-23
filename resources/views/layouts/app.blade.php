<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    @stack('head-script')
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <img src="{{asset('assets/img/logo.png')}}" alt="" width="60px" class="m-3">
                    <h6 class="mt-1">IKATAN PROFESI OPTOMETRIS <br>JAWA TENGAH</h6>

                </nav>

                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>

            <footer class="sticky-footer bg-costum mt-3">
               
            </footer>

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    @stack('foot-script')

    @if (session('kode_unik'))
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#modalPembayaran').modal('show');
        });
    </script>
    @endif
    
</body>
</html>
