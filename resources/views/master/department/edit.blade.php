@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Data Department Laskar</strong></div>
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
                        <form action="{{ route('departments.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="department">Department Laskar</label>
                                <input type="text" class="form-control form-control-sm @error('department') is-invalid @enderror" name="department" id="department" value="{{$item->department}}" placeholder="Masukan Data Department Laskar">
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="no_telpon">Apakah Department untuk DPP?</label><br>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="radio" name="is_dpp" id="inlineRadio1" value="Ya" {{$item->is_dpp == 'Ya' ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="radio" name="is_dpp" id="inlineRadio2" value="Tidak" {{$item->is_dpp == 'Tidak' ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                            <br>
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