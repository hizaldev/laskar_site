@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Data Kategori Berita</strong></div>
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
                        <form action="{{ route('news_category.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="kategori_berita">Nama Kategori Berita</label>
                                <input type="text" class="form-control form-control-sm @error('kategori_berita') is-invalid @enderror" name="kategori_berita" value="{{$item->kategori_berita}}" id="kategori_berita" placeholder="Masukan Nama Kategori Berita">
                                @error('kategori_berita')
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