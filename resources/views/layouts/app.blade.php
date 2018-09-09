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
</head>
<body>

@yield('content')

<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>{{ env('APP_NAME') }}</strong> by <a href="{{ env('APP_AUTHOR_URL') }}" target="_blank">{{ env('APP_AUTHOR') }}<span class="icon"><i class="fas fa-code-branch"></i></span></a>.
        </p>
    </div>
</footer>

<!-- javascript -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Custom page scripts -->
@stack('scripts')

</body>
</html>