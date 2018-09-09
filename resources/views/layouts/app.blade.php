<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <meta name="author" content="{{ env('APP_AUTHOR') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- View defined styles -->
    @stack('styles')
    <!-- Ziggy routes -->
    @routes
</head>
<body>

<div id="app">
    @include('layouts._nav')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </main>
</div>

@include('layouts.modals._delete')

<!-- Javascript -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Hide the not import flash messages after 3 seconds -->
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<!-- Custom page scripts -->
@stack('scripts')

</body>
</html>