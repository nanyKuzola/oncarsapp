<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components/header')
    </head>
    <body class="font-sans antialiased">
        <div class="container p-5">
            <div class="row text-center">
                @if(session('status'))
                    <div class="alert alert-success" role="alert"> {{session('status')}}</div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-dander" role="alert">{{session('error')}}</div>
                @endif
            </div>
            @yield('content')
        </div>
        @yield('javascript')
    </body>
        @include('components/footer')
</html>
