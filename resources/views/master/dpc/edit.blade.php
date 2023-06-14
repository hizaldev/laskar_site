@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit DPD</strong></div>
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
                        <form action="{{ route('dpc.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="dpd">DPD</label>
                                <select name="dpd_id" class="form-control form-control-sm @error('dpd') is-invalid @enderror" id="select2" required>
                                    <option value="">-- Pilih DPD --</option>
                                    @foreach ( $dpd as $d )
                                        <option value="{{$d->id}}" {{$d->id == $item->dpd_id ? 'selected' : ''}}>{{$d->dpd}}</option>
                                    @endforeach
                                </select>
                                @error('dpd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="dpc">DPD</label>
                                <input type="text" class="form-control form-control-sm @error('dpc') is-invalid @enderror" value="{{$item->dpc}}" name="dpc" id="dpc" placeholder="masukan Nama DPC">
                                @error('dpc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                               
                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" placeholder="masukan Nama DPD" rows="5">{{$item->alamat}}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control form-control-sm @error('latitude') is-invalid @enderror" value="{{$item->latitdue}}" name="latitude" id="latitude" placeholder="Masukan Koordinat Latitude">
                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control form-control-sm @error('longitude') is-invalid @enderror" value="{{$item->longitude}}" name="longitude" id="longitude" placeholder="Masukan Koordinat Longitude">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#select2").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
@endpush