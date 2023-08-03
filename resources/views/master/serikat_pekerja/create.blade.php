@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Tambah Data Serikat Pekerja</strong></div>
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
                    <form action="{{ route('unions.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="dpd">Serikat Pekerja</label>
                            <input type="text" class="form-control form-control-sm @error('serikat_pekerja') is-invalid @enderror" name="serikat_pekerja" id="serikat_pekerja" placeholder="masukan Nama Serikat Pekerja">
                            @error('serikat_pekerja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat">Alamat</label>
                           
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" placeholder="masukan alamat" rows="5"></textarea>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control form-control-sm @error('latitude') is-invalid @enderror" name="latitude" id="latitude" placeholder="Masukan Koordinat Latitude">
                            @error('latitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control form-control-sm @error('longitude') is-invalid @enderror" name="longitude" id="longitude" placeholder="Masukan Koordinat Longitude">
                            @error('longitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-sm mr-2 mt-2">Submit</button>
                        <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
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
    
@endpush