<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
            <section class="min-vh-100 d-flex justify-content-center align-items-center" style="background: rgb(2,0,36);
            background: linear-gradient(211deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);">
                <!-- Jumbotron -->
                <div class="px-4 py-5 px-md-5 text-center text-lg-start">
                    <div class="container">
                        <div class="row gx-lg-5 align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="text-center">
                                    <img src="{{ asset('images/logo_bulat_laskar.png') }}" class="rounded" width="150" height="150">
                                    {{-- <img src="{{ asset('images/logo_bulat_laskar.png') }}" class="rounded float-end" width="100" height="100"> --}}
                                </div>
                           
                                <h1 class="my-5 display-3 fw-bold ls-tight text-white">
                                    <span class="text-danger">Laskar PLN</span><br>
                                    Modern, Mandiri, Berintegritas <br />
                                
                                </h1>
                                {{-- <p style="color: hsl(217, 10%, 50.8%)">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                                quibusdam tempora at cupiditate quis eum maiores libero
                                veritatis? Dicta facilis sint aliquid ipsum atque?
                                </p> --}}
                            </div>
                    
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        @error('captcha')
                                            <div class="alert alert-danger mt-1 mb-3">{{ $message }} wrong</div>
                                        @enderror
                                        <form method="POST" action="{{ route('sign-in') }}">
                                            @csrf
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form3Example3">Email address</label>
                                                <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Masukan Email Address"/>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                               
                                            </div>
                                            <div class="form-outline mb-3">
                                                <label for="password" class="form-label">Enter Captcha</label>
                                                <div class="captcha mb-3">
                                                    <span>{!! captcha_img() !!}</span>
                                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                                    ↻
                                                    </button>
                                                </div>
                                                <input id="captcha" type="number" class="form-control" placeholder="Enter Captcha" name="captcha">
                
                                                @error('captcha')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                            
                                            <!-- Submit button -->
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block mb-4 text-center">
                                                    Login
                                                </button>
                                            </div>
                            
                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <p>Ingin bergabung dengan kami? klik button dibawah ini</p>
                                                <div class="d-grid">
                                                    <a href="{{ route('register_members.index') }}" class="btn btn-warning btn-block mb-4"> Saya Ingin Mendaftar</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Jumbotron -->
            </section>
        <!-- Section: Design Block -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/reload.captcha.js') }}"></script>   
    {{-- </div> --}}
</body>
</html>

