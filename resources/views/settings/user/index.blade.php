@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Data User Laskar PLN</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Nama Lengkap" data-column="1">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Nipeg" data-column="2">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Email" data-column="3">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Induk" data-column="4">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Unit" data-column="5">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search DPD" data-column="6">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search DPC" data-column="7">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Tipe Akun" data-column="8">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search DPP" data-column="9">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input form-control-sm" placeholder="Search Status" data-column="10">
                                        </th>
                                        @can('keanggotaan_anggota-edit')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('keanggotaan_anggota-delete')
                                            <th class="py-2"></th>
                                        @endcan
                                    </tr>
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Nama Lengkap</th>
                                        <th class="py-2">Nipeg</th>
                                        <th class="py-2">Email</th>
                                        <th class="py-2">Induk</th>
                                        <th class="py-2">Unit</th>
                                        <th class="py-2">DPD</th>
                                        <th class="py-2">DPC</th>
                                        <th class="py-2">Tipe Akun</th>
                                        <th class="py-2">DPP Laskar</th>
                                        <th class="py-2">Status</th>
                                        @can('keanggotaan_anggota-edit')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('keanggotaan_anggota-delete')
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
                {data: 'name', name: 'name'},
                {data: 'nipeg', name: 'nipeg'},
                {data: 'email', name: 'email'},
                {data: 'induk.induk', name: 'induk.induk', defaultContent: ""},
                {data: 'unit.unit', name: 'unit.unit', defaultContent: ""},
                {data: 'dpd.dpd', name: 'dpd.dpd', defaultContent: ""},
                {data: 'dpc.dpc', name: 'dpc.dpc', defaultContent: ""},
                {data: 'tipe_akun', name: 'tipe_akun', defaultContent: ""},
                {data: 'is_dpp', name: 'is_dpp'},
                {data: 'status', name: 'status'},
                @can('keanggotaan_anggota-edit')
                    {
                        data: 'edit', 
                        name: 'edit',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
                @can('keanggotaan_anggota-delete')
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
                @can('keanggotaan_anggota-create')
                    {
                        text: "<i class='fa-solid fa-plus'></i>",
                        className: 'btn btn-primary mb-4 mr-2 text-white',
                        action: function ( e, dt, button, config ) {
                            window.location = '{{ route('users.create') }}';
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

        $('.filter-input').keyup(function(){
            datatables.column($(this).data('column'))
            .search($(this).val())
            .draw();
        });
    </script>
@endpush