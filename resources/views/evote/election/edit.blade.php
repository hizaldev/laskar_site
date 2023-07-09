@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        
            <div class="row">
                {{-- @if ($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header"><strong>Tambah Data E-Vote</strong></div>
                        <div class="card-body">
                            
                            <form action="{{ route('evotes.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="judul_pemilihan">Judul Pemilihan</label>
                                    <input type="text" class="form-control form-control-sm @error('judul_pemilihan') is-invalid @enderror" name="judul_pemilihan" value="{{ $item->judul_pemilihan }}" id="judul_pemilihan" placeholder="Masukan Judul Pemilihan Laskar">
                                    @error('judul_pemilihan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                
                                    <textarea class="form-control form-control-sm" name="deskripsi" id="deskripsi" placeholder="Deskripsi Pemilihan Laskar" rows="3">{{ $item->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_vote_mulai">Tanggal Mulai Pemilu</label>
                                    <input type="date" class="form-control form-control-sm @error('tgl_vote_mulai') is-invalid @enderror" name="tgl_vote_mulai" value="{{ $item->tgl_vote_mulai }}" id="tgl_vote_mulai" placeholder="dd/mm/yyyy">
                                    @error('tgl_vote_mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_vote_berakhir">Tanggal Mulai Pemilu</label>
                                    <input type="date" class="form-control form-control-sm @error('tgl_vote_berakhir') is-invalid @enderror" name="tgl_vote_berakhir" value="{{ $item->tgl_vote_berakhir }}" id="tgl_vote_berakhir" placeholder="dd/mm/yyyy">
                                    @error('tgl_vote_berakhir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mr-2 mt-2">Update</button>
                                <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
                    <div class="card h-100">
                        <div class="card-header"><strong>Peserta E-Vote</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th> 
                                                <input type="text" class="form-control filter-input form-control-sm" placeholder="Search No Anggota" data-column="1">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Nama Lengkap" data-column="2">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input form-control-sm" placeholder="Search No Telp / Wa" data-column="3">
                                            </th>
                                            <th> 
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="py-2">#</th>
                                            <th class="py-2">No Anggota</th>
                                            <th class="py-2">Nama Lengkap</th>
                                            <th class="py-2">No Telp / Wa</th>
                                            <th class="py-2">Status Hak Pilih</th>
                                            <th class="py-2"></th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ( $candidate as $candidates )
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bg-primary bg-opacity-25"><strong>Bakal Calon {{$loop->iteration}}</strong></div>
                            <div class="card-body">
                                <form action="{{ route('evotes.update_candidate', $candidates->id)}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                        <div class="form-group mb-3">
                                            <label for="judul_pemilihan">Nama Lengkap Bakal Calon {{$loop->iteration}}</label>
                                            <input type="text" class="form-control form-control-sm" name="nama_lengkap" value="{{$candidates->nama_lengkap}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="visi">Visi</label>
                                            <textarea class="form-control form-control-sm" name="visi" placeholder="Masukan Visi Calon " rows="3">{{$candidates->visi}}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="Misi">Misi</label>
                                            <textarea class="form-control form-control-sm" name="misi" placeholder="Masukan Misi Calon " rows="3">{{$candidates->misi}}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="judul_pemilihan">Foto Bakal Calon 1</label>
                                            <input type="file" class="form-control form-control-sm" name="photo" id="photo_update" value="{{$candidates->photo}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm mr-2 mt-2">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary bg-opacity-25"><strong>Tambah Bakal Calon</strong></div>
                        <div class="card-body">
                            <form action="{{ route('evotes.store_candidate')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group mb-3">
                                        <label for="judul_pemilihan">Nama Lengkap Bakal Calon </label>
                                        <input type="hidden" class="form-control form-control-sm" name="vote_id" value="{{$item->id}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                                        <input type="text" class="form-control form-control-sm" name="nama_lengkap" value="{{old('nama_lengkap')}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="visi">Visi</label>
                                        <textarea class="form-control form-control-sm" name="visi" placeholder="Masukan Visi Calon " rows="3">{{old('visi')}}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="Misi">Misi</label>
                                        <textarea class="form-control form-control-sm" name="misi" placeholder="Masukan Misi Calon " rows="3">{{old('misi')}}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="judul_pemilihan">Foto Bakal Calon </label>
                                        <input type="file" class="form-control form-control-sm" name="photo" id="photo[0]" value="{{old('photo')}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mr-2 mt-2">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap5.min.css') }}">
@endpush

@push('addon-script')
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    
    <!-- Page specific script -->
    <script>
        var datatables = $('#example').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            sDom: 'lrtip',
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'no_anggota', name: 'no_anggota'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'no_telp', name: 'no_telp'},
                {data: 'status_pilih', name: 'status_pilih'},
                {
                        data: 'sendWhatsapp', 
                        name: 'sendWhatsapp',
                        orderable: false,
                        searchable: false,
                       
                },
                
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
        });

        $('.filter-input').keyup(function(){
            datatables.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });
    </script>
@endpush