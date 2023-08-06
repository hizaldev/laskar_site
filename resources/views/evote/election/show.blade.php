@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Informasi Data Pemilu</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-sm table-bordered table-hover w-100 table table-striped border">
                                    <tr>
                                        <td>Judul Pemilu</td>
                                        <td>:</td>
                                        <td>{{$vote->judul_pemilihan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{{$vote->deskripsi}}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pelaksanaan Pemilu</td>
                                        <td>:</td>
                                        <td>{{$vote->tgl_vote_mulai}} s/d {{$vote->tgl_vote_berakhir}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    @foreach ( $candidate as $candidates )
                                        <div class="col-md-3">
                                            <div class="card h-100">
                                                @if ($candidates->photo != null)
                                                    <img src="{{$candidates->photo}}" width="400px" height="400px" class="card-img-top" alt="...">
                                                @else
                                                    <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" class="card-img-top" alt="...">
                                                @endif
                                                <div class="card-body">
                                                    <p class="text-muted">
                                                        <h4 style="overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2; /* number of lines to show */
                                                                line-clamp: 2;
                                                        -webkit-box-orient: vertical;">{{$candidates->nama_lengkap}}</h4>
                                                        <div class="card-text fw-semibold">Visi</div>
                                                        {{$candidates->visi}}
                                                        <div class="card-text fw-semibold">Misi</div>
                                                        {{$candidates->misi}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="card-group">
                                    @foreach ( $candidate as $candidates )
                                        <div class="card">
                                            <img src="https://www.getillustrations.com/packs/3d-avatar-illustrations/male/_1x/Avatar,%203D%20_%20man,%20male,%20people,%20person,%20spiky,%20jacket,%20turtleneck_md.png" width="100" height="200" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">{{$candidates->nama_lengkap}}</h5>
                                                <p class="card-text">
                                                    <div>
                                                        <strong>Visi</strong>
                                                    </div>
                                                    {{$candidates->visi}}
                                                </p>
                                                <p class="card-text">
                                                    <div>
                                                        <strong>Misi</strong>
                                                    </div>
                                                    {{$candidates->misi}}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                  </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Peserta E-vote</strong></div>
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
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Status" data-column="4">
                                        </th>
                                        <th> 
                                        </th>
                                        <th> 
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">No Anggota</th>
                                        <th class="py-2">Nama Lengkap</th>
                                        <th class="py-2">No Telp / Wa</th>
                                        <th class="py-2">Status Notifikasi</th>
                                        <th class="py-2">Waktu Kirim</th>
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
            sDom: 'Blrtip',
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'no_anggota', name: 'no_anggota'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'no_telp', name: 'no_telp'},
                {data: 'status_undangan', name: 'status_undangan'},
                {data: 'waktu_kirim', name: 'waktu_kirim'},
                {data: 'status_pilih', name: 'status_pilih'},
                {
                        data: 'sendWhatsapp', 
                        name: 'sendWhatsapp',
                        orderable: false,
                        searchable: false,
                       
                },
                
            ],
            createdRow : 
                function (row, data, index) {
                    if ( data['status_undangan'] == 'Belum Terkirim' ) {
                        $('td', row).eq(4).addClass('bg-danger text-white');
                    } else if(data['status_undangan'] == 'Terkirim') {
                        $('td', row).eq(4).addClass('bg-success text-white');
                    }else{
                        $('td', row).eq(4).addClass('bg-primary text-white');
                    }
                },
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
            buttons : [ 
                {
                    extend : 'excelHtml5',
                    text : "<i class='fa-regular fa-file-excel'></i>",
                    className: 'btn btn-success mb-4',
                } 
            ]
        });

        $('.filter-input').keyup(function(){
            datatables.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });
    </script>
@endpush