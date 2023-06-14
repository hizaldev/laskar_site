@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Master Data Unit</strong></div>
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
                        <form action="{{ route('units.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control form-control-sm @error('unit') is-invalid @enderror" name="unit" value="{{$item->unit}}" id="unit" placeholder="Masukan Data Nama Unit">
                                @error('unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="latitude">Level</label>
                                <select class="form-select form-select-sm" name="level" aria-label="Default select example">
                                    <option value="">-- Pilih Level --</option>
                                    <option value="0" {{$item->level == 0 ? 'selected' : ''}}>0</option>
                                    <option value="1" {{$item->level == 1 ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$item->level == 2 ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$item->level == 3 ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$item->level == 4 ? 'selected' : ''}}>4</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control form-control-sm @error('latitude') is-invalid @enderror" name="latitude" value="{{$item->latitude}}" id="latitude" placeholder="Masukan Koordinat Latitude">
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control form-control-sm @error('longitude') is-invalid @enderror" name="longitude" value="{{$item->longitude}}" id="longitude" placeholder="Masukan Koordinat Longitude">
                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                               
                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" placeholder="alamat" rows="3">{{$item->alamat}}</textarea>
                                @error('alamat')
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