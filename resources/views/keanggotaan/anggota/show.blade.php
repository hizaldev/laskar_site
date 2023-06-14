@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <div class="row">
            <h5>Informasi Data Anggota</h5>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" class="img-thumbnail" width="100" height="100" alt="...">
                            </div>
                            <div class="p-4 d-flex flex-column mb-3">
                                <strong>{{$item->nama_lengkap}}</strong>
                                <span class="text-muted">{{$item->nipeg}}</span>
                                <span class="text-muted">{{$item->email}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Informasi Personal</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Nama Lengkap</div>
                                    <strong>{{$item->nama_lengkap}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Nipeg</div>
                                    <strong>{{$item->nipeg}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Email</div>
                                    <strong>{{$item->email}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tempat & Tanggal Lahir</div>
                                    <strong>{{$item->tempat_lahir}}, {{$item->tgl_lahir}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">No Telpon / Wa</div>
                                    <strong>{{$item->no_telpon}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Agama</div>
                                    <strong>{{$item->agama}}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Unit</div>
                                    <strong>{{$item->unit->unit}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Grade</div>
                                    <strong>{{$item->grade}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Golongan Darah</div>
                                    <strong>{{$item->golongan_darah}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Jenis Kelamin</div>
                                    <strong>{{$item->jenis_kelamin}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Informasi Bank</div>
                                    <strong>{{$item->bank->bank}} No Rek. {{$item->no_rekening}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">alamat</div>
                                    <strong>{{$item->alamat}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6>Informasi Keanggotaan</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">Nomor Anggota Laskar</div>
                                    <strong>{{$item->no_anggota}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tanggal Masuk Laskar</div>
                                    <strong>{{$item->created_at}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Nomor Pendaftaran Anggota Laskar</div>
                                    <strong>{{$item->no_pendaftaran}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Tanggal Pendaftaran Laskar</div>
                                    <strong>{{$item->tgl_pendaftaran}}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted">DPD</div>
                                    <strong>{{$item->dpd->dpd}}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">DPC</div>
                                    <strong>{{$item->dpc == null ? '-' : $item->dpc->dpc }}</strong>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted">Ukuran Baju</div>
                                    <strong>{{$item->size->ukuran}}</strong>
                                </div>
                            </div>
                        </div>
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