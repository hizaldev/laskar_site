@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Absensiku</button>
                      <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Kehadiranku</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Pencarian Absensi</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                        <div class="card mb-4 mt-3">
                            <div class="card-header"><strong>Data Absensiku</strong></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th> 
                                                    <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search agenda absensi" data-column="1">
                                                </th>
                                                <th> 
                                                    <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Tgl agenda" data-column="2">
                                                </th>
                                                <th> 
                                                    <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Tempat" data-column="3">
                                                </th>
                                                <th> 
                                                    <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Publikasi Absensi" data-column="4">
                                                </th>
                                                @can('aplikasi_absensi-show')
                                                    <th class="py-2"></th>
                                                @endcan
                                                @can('aplikasi_absensi-edit')
                                                    <th class="py-2"></th>
                                                @endcan
                                                @can('aplikasi_absensi-delete')
                                                    <th class="py-2"></th>
                                                @endcan
                                            </tr>
                                            <tr>
                                                <th class="py-2">#</th>
                                                <th class="py-2">Agenda</th>
                                                <th class="py-2">Tgl Agenda</th>
                                                <th class="py-2">tempat</th>
                                                <th class="py-2">Absensi Public</th>
                                                @can('aplikasi_absensi-show')
                                                <th class="py-2"></th>
                                            @endcan
                                                @can('aplikasi_absensi-edit')
                                                    <th class="py-2"></th>
                                                @endcan
                                                @can('aplikasi_absensi-delete')
                                                    <th class="py-2"></th>
                                                @endcan
                                            </tr>
                                            
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                        {{-- kehdadiran --}}
                        <div class="card mb-4 mt-3">
                            <div class="card-header"><strong>Data Kehadiranku</strong></div>
                            <div class="card-body">
                                <table id="tablesKehadiran" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-kehadiranku form-control-sm" placeholder="Search agenda absensi" data-column="1">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-kehadiranku form-control-sm" placeholder="Search Tgl agenda" data-column="2">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-kehadiranku form-control-sm" placeholder="Search Tempat" data-column="3">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-kehadiranku form-control-sm" placeholder="Search Publikasi Absensi" data-column="4">
                                            </th>
                                                <th class="py-2"></th>
                                        </tr>
                                        <tr>
                                            <th class="py-2">#</th>
                                            <th class="py-2">Agenda</th>
                                            <th class="py-2">Tgl Agenda</th>
                                            <th class="py-2">tempat</th>
                                            <th class="py-2">Waktu Kehadiran</th>
                                            <th class="py-2"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                        {{-- data pencarian --}}
                        <div class="card mb-4 mt-3">
                            <div class="card-header"><strong>Cari Absensi</strong></div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" id="search-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="agenda">Agenda</label>
                                                <input type="text" class="form-control form-control-sm" name="agenda" id="agenda" placeholder="Masukan Agenda Rapat / Acara">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="agenda">Tempat</label>
                                                <input type="text" class="form-control form-control-sm" name="tempat" id="tempat" placeholder="Masukan Tempat Acara">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="agenda">Tanggal Awal</label>
                                                <input type="date" class="form-control form-control-sm" name="start_date" id="start_date" placeholder="Masukan Tgl Awal">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="agenda">Tanggal Akhir</label>
                                                <input type="date" class="form-control form-control-sm" name="end_date" id="end_date" placeholder="Masukan Tgl Akhir">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mr-2 mt-2 mb-3">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm mr-2 mt-2 mb-3" onclick="resetForm()">Reset Value</button>
                                </form>
                                <table id="tableSearch" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-cari-absensi form-control-sm" placeholder="Search agenda absensi" data-column="1">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-cari-absensi form-control-sm" placeholder="Search Tgl agenda" data-column="2">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-cari-absensi form-control-sm" placeholder="Search Tempat" data-column="3">
                                            </th>
                                            <th> 
                                                <input type="text" class="form-control filter-input-cari-absensi form-control-sm" placeholder="Search Publikasi Absensi" data-column="4">
                                            </th>
                                                <th class="py-2"></th>
                                        </tr>
                                        <tr>
                                            <th class="py-2">#</th>
                                            <th class="py-2">Agenda</th>
                                            <th class="py-2">Tgl Agenda</th>
                                            <th class="py-2">tempat</th>
                                            <th class="py-2">Absensi Public</th>
                                            <th class="py-2"></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
                {data: 'agenda', name: 'agenda'},
                {data: 'tgl_agenda', name: 'tgl_agenda'},
                {data: 'tempat', name: 'tempat'},
                {data: 'is_public', name: 'is_public'},
                @can('aplikasi_absensi-show')
                    {
                        data: 'show', 
                        name: 'show',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
                @can('aplikasi_absensi-edit')
                    {
                        data: 'edit', 
                        name: 'edit',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
                @can('aplikasi_absensi-delete')
                    {
                        data: 'delete', 
                        name: 'delete',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
               
   
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
            buttons : [ 
                @can('aplikasi_absensi-create')
                    {
                        text: "<i class='fa-solid fa-plus'></i>",
                        className: 'btn btn-primary mb-4 mr-2 text-white',
                        action: function ( e, dt, button, config ) {
                            window.location = '{{ route('attendances.create') }}';
                        }        
                    },
                @endcan
                {
                    extend : 'excelHtml5',
                    text : "<i class='fa-regular fa-file-excel'></i>",
                    className: 'btn btn-success mb-4',
                } 
            ]
        });

        $('.filter-input-absensiku').keyup(function(){
            datatables.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });

        var datatablesKehadiran = $('#tablesKehadiran').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            sDom: 'Blrtip',
            ajax: {
                url: "{!!route('attendances.getDataKehadiran')!!}"
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'kehadiran[, ].agenda', name: 'agenda'},
                {data: 'kehadiran[, ].tgl_agenda', name: 'tgl_agenda'},
                {data: 'kehadiran[, ].tempat', name: 'tempat'},
                {data: 'created_at', name: 'created_at'},
                    {
                        data: 'show', 
                        name: 'show',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
            buttons : [ 
                {
                    extend : 'excelHtml5',
                    text : "<i class='fa-regular fa-file-excel'></i>",
                    className: 'btn btn-success mb-4',
                } 
            ]
        });

        $('.filter-input-kehadiranku').keyup(function(){
            datatablesKehadiran.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });
       
        var dataTableSearch = $('#tableSearch').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            sDom: 'Blrtip',
            ajax: {
                url: '{{route('searchAbsensi')}}',
                data: function (d) {
                    d.agenda = $('input[name=agenda]').val();
                    d.tempat = $('input[name=tempat]').val();
                    d.start_date = $('input[name=start_date]').val();
                    d.end_date = $('input[name=end_date]').val();
                }
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'agenda', name: 'agenda'},
                {data: 'tgl_agenda', name: 'tgl_agenda'},
                {data: 'tempat', name: 'tempat'},
                {data: 'is_public', name: 'is_public'},
                    {
                        data: 'show', 
                        name: 'show',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
            buttons : [ 
                {
                    extend : 'excelHtml5',
                    text : "<i class='fa-regular fa-file-excel'></i>",
                    className: 'btn btn-success mb-4',
                } 
            ]
        });

        $('.filter-input-cari-absensi').keyup(function(){
            dataTableSearch.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });

        $('#search-form').on('submit', function(e) {
            dataTableSearch.draw();
            e.preventDefault();
        });

        function resetForm(){
            var agenda= document.getElementById("agenda");
            var tempat= document.getElementById("tempat");
            var start_date= document.getElementById("start_date");
            var end_date= document.getElementById("end_date");

            agenda.value = "";
            tempat.value = "";
            start_date.value = "";
            end_date.value = "";

        }

    </script>
@endpush