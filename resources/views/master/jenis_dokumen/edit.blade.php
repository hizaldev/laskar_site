@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Data Kategori Dokumen</strong></div>
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
                        <form action="{{ route('jenis_documents.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="jenis_dokumen">Kategori Dokumen</label>
                                <input type="text" class="form-control form-control-sm @error('jenis_dokumen') is-invalid @enderror" name="jenis_dokumen" id="jenis_dokumen" value="{{$item->jenis_dokumen}}" placeholder="Masukan Data Kategori Dokumen">
                                @error('jenis_dokumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                               
                                <textarea class="form-control form-control-sm" name="keterangan" id="keterangan" placeholder="Keterangan" rows="3">{{$item->keterangan}}</textarea>
                                @error('keterangan')
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