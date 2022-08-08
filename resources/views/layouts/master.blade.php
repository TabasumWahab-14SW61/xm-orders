<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('page_title') | {{ config('constants.APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
</head>

<body>

    <div class="container-body">
        <!-- SHOW ALERTS START -->
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> {{ Session::get('error') }}
            </div>
        @endif
        <!-- SHOW ALERTS END -->

        @yield('content')
    </div>
    <script src="{{ mix('js/all.js') }}"></script>
    @yield('javascript')

</body>

</html>
