@extends('layouts.front_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-sm-12">
                <h3>
                    <strong>
                        Digitalisasi Absensi<br> 
                        
                    </strong>
                    
                </h3>
                <div class="card mb-4">
                    {{-- <div class="card-header"><strong>Tambah Master Data Golongan Darah</strong></div> --}}
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @error('captcha')
                            <div class="alert alert-danger mt-1 mb-3">{{ $message }} wrong</div>
                        @enderror
                        <form action="{{ route('attendances.storeCeklok')}}" id="formRegister" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="text-muted">Agenda</div>
                                        <strong>{{$item->agenda}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-muted">Tempat</div>
                                        <strong>{{$item->tempat}}</strong>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="mb-3">
                                        <div class="text-muted">Hari / Tanggal Agenda</div>
                                        <strong>{{$item->tgl_agenda}}</strong>
                                    </div>
                                    <div class="mb-3">
                                        <div class="text-muted">Waktu</div>
                                        <strong>{{$item->jam_mulai}} s/d {{$item->jam_berakhir}}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="attendance_id" value="{{ $item->id }}">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" id="nama" placeholder="Masukan Nama Lengkap">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="unit">Unit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" id="unit" placeholder="Masukan Unit">
                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="Masukan email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_tlp">No Telepon / Wa <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('no_tlp') is-invalid @enderror" name="no_tlp" value="{{ old('no_tlp') }}" id="email" placeholder="Masukan No Tlp">
                                @error('no_tlp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="captcha">Enter Captcha <span class="text-danger">*</span></label>
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
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary mr-2 mt-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')
@endpush

@push('addon-script')
    <script src="{{ asset('js/reload.captcha.js') }}"></script>           
@endpush