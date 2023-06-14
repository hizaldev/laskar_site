@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Update Anggota Laskar</strong></div>
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
                        <form action="{{ route('members.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_pendaftaran">Nomor Pendaftaran</label>
                                        <input type="text" class="form-control form-control-sm @error('no_pendaftaran') is-invalid @enderror" value="{{$item->no_pendaftaran}}" name="no_pendaftaran" id="no_pendaftaran" placeholder="Masukan Nomor Pendaftaran" readonly>
                                        @error('no_pendaftaran')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nama_lengkap">Nama Anggota</label>
                                        <input type="text" class="form-control form-control-sm @error('nama_lengkap') is-invalid @enderror" value="{{$item->nama_lengkap}}" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Anggota">
                                        @error('nama_lengkap')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nipeg">Nipeg Anggota</label>
                                        <input type="text" class="form-control form-control-sm @error('nipeg') is-invalid @enderror" value="{{$item->nipeg}}" name="nipeg" id="nipeg" placeholder="Masukan Nipeg Anggota">
                                        @error('nipeg')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Email Anggota</label>
                                        <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{$item->email}}" name="email" id="email" placeholder="Masukan Email Anggota">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tempat_lahir">Tempat & Tgl Lahir Anggota</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror" value="{{$item->tempat_lahir}}" name="tempat_lahir" id="tempat_lahir" placeholder="Masukan Tempat Lahir Anggota">
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control form-control-sm @error('tgl_lahir') is-invalid @enderror" value="{{$item->tgl_lahir}}" name="tgl_lahir" id="tgl_lahir" placeholder="tgl lahir">
                                                @error('tgl_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tempat_lahir">Jenis Kelamin</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="Laki-Laki" {{$item->jenis_kelamin == 'Laki-Laki' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="Perempuan" {{$item->jenis_kelamin == 'Perempuan' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="no_telpon">No HP/WA Anggota</label>
                                        <input type="text" class="form-control form-control-sm @error('no_telpon') is-invalid @enderror" value="{{$item->no_telpon}}" name="no_telpon" id="no_telpon" placeholder="Masukan No Telpon / WA Anggota">
                                        @error('no_telpon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Alamat</label>
                                       
                                        <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" rows="5">{{$item->alamat}}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="unit_id">Unit Anggota <span class="text-danger">*</span></label>
                                        <select name="unit_id" class="form-control form-select-sm @error('unit_id') is-invalid @enderror" id="unit_id" required>
                                            <option value="">-- Pilih Unit --</option>
                                            @foreach ( $unit as $units )
                                                <option value="{{$units->id}}" {{$units->id == $item->unit_id ? 'selected' : ''}}>{{$units->unit}}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="grade">Grade <span class="text-danger">*</span></label>
                                        <select name="grade" class="form-control form-select-sm @error('grade') is-invalid @enderror" id="grade" required>
                                            <option value="">-- Pilih Grade --</option>
                                            <option value="8" {{$item->grade == '8' ? 'selected' : ''}}>8</option>
                                            <option value="9" {{$item->grade == '9' ? 'selected' : ''}}>9</option>
                                            <option value="10" {{$item->grade == '10' ? 'selected' : ''}}>10</option>
                                            <option value="11" {{$item->grade == '11' ? 'selected' : ''}}>11</option>
                                            <option value="12" {{$item->grade == '12' ? 'selected' : ''}}>12</option>
                                            <option value="13" {{$item->grade == '13' ? 'selected' : ''}}>13</option>
                                            <option value="14" {{$item->grade == '14' ? 'selected' : ''}}>14</option>
                                            <option value="15" {{$item->grade == '15' ? 'selected' : ''}}>15</option>
                                            <option value="16" {{$item->grade == '16' ? 'selected' : ''}}>16</option>
                                        </select>
                                        @error('size_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="agama">Agama Anggota <span class="text-danger">*</span></label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama" required>
                                            <option value="">-- Pilih Agama --</option>
                                            @foreach ( $agama as $religions )
                                                <option value="{{$religions->agama}}" {{$religions->agama == $item->agama ? 'selected' : ''}}>{{$religions->agama}}</option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="size_id">Ukuran Baju Anggota <span class="text-danger">*</span></label>
                                        <select name="size_id" class="form-control form-select-sm @error('size_id') is-invalid @enderror" id="size_id" required>
                                            <option value="">-- Pilih Ukuran Baju --</option>
                                            @foreach ( $size as $sizes )
                                                <option value="{{$sizes->id}}" {{$sizes->id == $item->size_id ? 'selected' : ''}}>{{$sizes->ukuran}}</option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="type_blood_id">Golongan Darah Anggota <span class="text-danger">*</span></label>
                                        <select name="golongan_darah" class="form-control form-select-sm @error('golongan_darah') is-invalid @enderror" id="golongan_darah" required>
                                            <option value="">-- Pilih Golongan Darah --</option>
                                            @foreach ( $type_blood as $type_bloods )
                                                <option value="{{$type_bloods->golongan_darah}}" {{$item->golongan_darah == $type_bloods->golongan_darah ? 'selected' : ''}}>{{$type_bloods->golongan_darah}}</option>
                                            @endforeach
                                        </select>
                                        @error('golongan_darah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dpd_id">DPD Anggota <span class="text-danger">*</span></label>
                                        <select name="dpd_id" class="form-control @error('dpd_id') is-invalid @enderror" id="dpd_id" required>
                                            <option value="">-- Pilih DPD --</option>
                                            @foreach ( $dpd as $dpds )
                                                <option value="{{$dpds->id}}" {{$item->dpd_id == $dpds->id ? 'selected' : ''}}>{{$dpds->dpd}}</option>
                                            @endforeach
                                        </select>
                                        @error('dpd_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dpc_id">DPC Anggota <span class="text-danger">*</span></label>
                                        <select name="dpc_id" class="form-control @error('dpc_id') is-invalid @enderror" id="dpc_id">
                                            <option value="">-- Pilih DPC --</option>
                                            @foreach ( $dpc as $dpcs )
                                                <option value="{{$dpcs->id}}" {{$item->dpc_id == $dpcs->id ? 'selected' : ''}}>{{$dpcs->dpc}}</option>
                                            @endforeach
                                        </select>
                                        @error('dpc_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tempat_lahir">Bank & No Rekening Anggota</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="bank_id" class="form-control @error('bank_id') is-invalid @enderror" id="bank_id" required>
                                                    <option value="">-- Pilih Bank --</option>
                                                    @foreach ( $bank as $banks )
                                                        <option value="{{$banks->id}}" {{$item->bank_id == $banks->id ? 'selected' : ''}}>{{$banks->bank}}</option>
                                                    @endforeach
                                                </select>
                                                @error('bank_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control form-control-sm @error('no_rekening') is-invalid @enderror" value="{{$item->no_rekening}}" name="no_rekening" id="no_rekening" placeholder="Masukan No Rekening  ">
                                                @error('no_rekening')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="unit_id">Status Anggota <span class="text-danger">*</span></label>
                                        <select name="status_id" class="form-control form-select-sm @error('status_id') is-invalid @enderror" id="status_id" required>
                                            <option value="">-- Pilih Unit --</option>
                                            @foreach ( $status as $stat )
                                                <option value="{{$stat->id}}" {{$stat->id == $item->status_id ? 'selected' : ''}}>{{$stat->status}}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mr-2 mt-2">Submit</button>
                            <a href="#" class="btn btn-outline-danger btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
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
        $("#agama").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#size_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#dpd_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#dpc_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#bank_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
@endpush