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
            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                
                        
                        <form action="{{ route('evotes.store_vote')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                @foreach ( $candidate as $candidates )
                                    @if (count($candidate) > 1)
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" width="100" height="100" alt="..." class="img-thumbnail">
                                                <h4 class="fw-semibold mt-3">{{$candidates->nama_lengkap}}</h4>
                                                <h5>Visi</h5>
                                                <p class="text-wrap">{{$candidates->visi}}</p>
                                                <h5>Misi</h5>
                                                <p class="text-wrap">{{$candidates->misi}}</p>
                                                <input type="radio" class="btn-check" name="candidate_id" id="option1" autocomplete="off" value="{{$candidates->id}}">
                                                <label class="btn btn-secondary" for="option1">Pilih Saya</label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 w-full">
                                            <div class="text-center">
                                                <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" width="100" height="100" alt="..." class="img-thumbnail">
                                                <h4 class="fw-semibold mt-3">{{$candidates->nama_lengkap}}</h4>
                                                <h5>Visi</h5>
                                                <p class="text-wrap">{{$candidates->visi}}</p>
                                                <h5>Misi</h5>
                                                <p class="text-wrap">{{$candidates->misi}}</p>
                                                <input type="radio" class="btn-check" name="candidate_id" id="option1" autocomplete="off" value="{{$candidates->id}}">
                                                <label class="btn btn-outline-primary" for="option1">Pilih Saya</label>
                                            </div>
                                        </div>
                                    @endif
                                    
                                @endforeach
                                {{-- <div class="col-md-3">
                                    <div class="text-center">
                                        <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" width="100" height="100" alt="..." class="img-thumbnail">
                                        <h4 class="fw-semibold mt-3"> Calon 1</h4>
                                        <h5>Visi</h5>
                                        <p class="text-wrap">ini merupakan visinya skdfskafh kshdfkshf sfkshfk skfjskfhj sfkhskf sfkshf skhdwkahf skhdkshd akdhska kasdhks </p>
                                        <h5>Misi</h5>
                                        <p class="text-truncate">ini merupakan misinya</p>
                                        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="option2">Pilih Saya</label>
                                    </div>
                                    
                                </div> --}}
                            </div> 
                            <div class="row justify-content-center text-center">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="exampleInputPassword1">Masukan Sekuriti Kode</label>
                                        <input type="hidden" class="form-control" name="voter_id" value="{{$voter->id}}" placeholder="Sekuriti Kode">
                                        <input type="hidden" class="form-control" name="vote_id" value="{{$vote->id}}" placeholder="Sekuriti Kode">
                                        <input type="text" class="form-control" name="security_code" placeholder="Sekuriti Kode">
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                
            </div>
        <!-- Section: Design Block -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <script src="{{ asset('js/reload.captcha.js') }}"></script>   
    {{-- </div> --}}
</body>
</html>

