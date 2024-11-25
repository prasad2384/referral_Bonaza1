<!DOCTYPE html>
<html lang="en">

    <head>
        @include('frontend.partial.head')
        <title>@yield('title')</title>
       <style>
            @yield('style')
        </style>
    </head>

    <body>
        @include('frontend.partial.navbar',['data' => $data ?? null])
        @yield('content')
        @include('frontend.partial.footer')
        @include('frontend.partial.footer-script')
        @yield('scripts')
    </body>

</html>
