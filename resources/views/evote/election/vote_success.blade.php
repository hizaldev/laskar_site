<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} ini get vote page</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpeg') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('addon-style')
</head>
<body>
    @include('sweetalert::alert')
    {{-- <div id="app"> --}}
        <!-- Section: Design Block -->
            <div class="container">
                <div class="row min-vh-100 d-flex justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="text-center">
                            <img src="{{ asset('images/election-success.png') }}" class="img-fluid" width="661" height="377"><br>
                            <h1 class="mt-4 mb-3 fw-semibold">Suara Anda Telah Kami Catat</h1>
                            <p class="text-muted mb-4">
                                Terima kasih telah melakukan pemungutan suara, suara anda merupakan sangat berharga untuk kemajuan organisasi kita, semoga menjadi awal menuju perubahan yang lebih baik lagi. Sukses selalu
                            </p>
                            <a href="http://laskar_site.test" class="btn btn-primary"> Kembali Ke Landing Page</a>
                        </div>
                    </div>
                </div>  
            </div>
        <!-- Section: Design Block -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/reload.captcha.js') }}"></script>   
    {{-- </div> --}}
</body>
</html>

