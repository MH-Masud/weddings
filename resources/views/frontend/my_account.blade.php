<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>HM Weddings</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('assets/frontend') }}/img/favicon.png" rel="icon">
        <link rel="stylesheet" href="{{ asset('css/all_style.css') }}">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/all_script.js') }}"></script>
    </body>
</html>
