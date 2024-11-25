<!DOCTYPE html>
<html>

    <head>
        @include('admin.partial.head')
        <title>@yield('title')</title>
        <style>
            @yield('style')
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            @include('admin.partial.navbar')

            @include('admin.partial.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
                @yield('scripts')
            </div>
            <!-- /.content-wrapper -->
            @include('admin.partial.footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        @include('admin.partial.footer-script')
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>

    </body>

</html>
