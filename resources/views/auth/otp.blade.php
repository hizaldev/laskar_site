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
                <div class=" text-center text-lg-start">
                    <div class="container">
                        <div class="row align-items-center">
                    
                            <div class="mb-5 mb-lg-0">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('images/BIG.png') }}" class="rounded float-start" width="250" height="100">
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('authenticate') }}">
                                            @csrf
                                            <div class="text-center">
                                                <h4>Hai, {{$member->nama_lengkap}}</h4>
                                                <p>
                                                    Silahkan masukan kode OTP yang sudah kami kirim ke No Handphone anda
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="hidden" id="form3Example3" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $member->email }}" required autocomplete="email"  placeholder="Masukan Email Address"/>
                                                <label class="form-label" for="form3Example3">Kode OTP</label>
                                                <input type="password" id="form3Example3" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required  placeholder="Masukan Kode OTP"/>
                                                @error('password')
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
                                        </form>
                                        <form method="POST" action="{{ route('sign-in') }}">
                                            @csrf
                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <p>Tidak dapat kode OTP?</p>
                                                <input type="hidden" id="form3Example3" class="form-control" name="email" value="{{ $member->email }}" required autocomplete="email"  placeholder="Masukan Email Address"/>
                                                <input type="hidden" id="form3Example3" class="form-control" name="type" value="resend"/>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-warning btn-block mb-4">
                                                        Kirim ulang kode OTP
                                                    </button>
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
    {{-- </div> --}}
</body>
</html>

kjk

himeisyah karimah briatna

