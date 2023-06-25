@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Tambah User Aplikasi</strong></div>
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
                    <form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="user_id">User <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id" required>
                                <option value="">-- Pilih dari Anggota --</option>
                                @foreach ( $member as $members )
                                    <option value="{{$members->id}}" {{old('user_id') == $members->id ? 'selected' : ''}}>{{$members->nama_lengkap}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="role_id">Role <span class="text-danger">*</span></label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" id="role_id" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ( $role as $roles )
                                    <option value="{{$roles->id}}" {{old('role_id') == $roles->id ? 'selected' : ''}}>{{$roles->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukan Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Ketik Ulang Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password_confirmation" id="repassword" placeholder="Masukan Ulang Password">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $("#user_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#role_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
@endpush