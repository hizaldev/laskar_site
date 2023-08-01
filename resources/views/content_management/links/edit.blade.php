@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Data Management Link</strong></div>
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
                        <form action="{{ route('links.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_link">Nama Link</label>
                                <input type="text" class="form-control form-control-sm @error('nama_link') is-invalid @enderror" name="nama_link" value="{{$item->nama_link}}" id="bank" placeholder="Masukan Nama Link">
                                @error('nama_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="icons">Icon</label>
                                <input type="text" class="form-control form-control-sm @error('icons') is-invalid @enderror" name="icons" value="{{$item->icons}}" id="link" placeholder="Masukan Icon">
                                @error('icons')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="link">Link</label>
                                <input type="text" class="form-control form-control-sm @error('link') is-invalid @enderror" name="link" value="{{$item->link}}" id="link" placeholder="Masukan Link">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="initial">Urutan</label>
                                <input type="number" class="form-control form-control-sm w-50 @error('initial') is-invalid @enderror" name="initial" value="{{$item->initial}}" id="initial" placeholder="Masukan Urutan Link">
                                @error('initial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="is_aktif" id="allmember" {{$item->is_aktif == 'Ya' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Link Aktif?</label>
                                </div>
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