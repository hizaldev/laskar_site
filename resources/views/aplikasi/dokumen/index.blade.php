@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mt-3">
                    <div class="card-header"><strong>Data Arsip Dokumen</strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Dokumen" data-column="1">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Tgl Dokumen" data-column="2">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Publikasi" data-column="3">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Tipe Dokumen" data-column="4">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Sifat Dokumen" data-column="5">
                                        </th>
                                        <th> 
                                            <input type="text" class="form-control filter-input-absensiku form-control-sm" placeholder="Search Kategori Dokumen" data-column="6">
                                        </th>
                                        @can('aplikasi_dokumen-show')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('aplikasi_dokumen-edit')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('aplikasi_dokumen-delete')
                                            <th class="py-2"></th>
                                        @endcan
                                    </tr>
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Dokumen</th>
                                        <th class="py-2">Tgl Dokumen</th>
                                        <th class="py-2">Dokumen Publik</th>
                                        <th class="py-2">Tipe Dokumen</th>
                                        <th class="py-2">Sifat Dokumen</th>
                                        <th class="py-2">Kategori Dokumen</th>
                                        @can('aplikasi_dokumen-show')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('aplikasi_dokumen-edit')
                                            <th class="py-2"></th>
                                        @endcan
                                        @can('aplikasi_dokumen-delete')
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
                {data: 'header', name: 'header'},
                {data: 'tgl_document', name: 'tgl_document'},
                {data: 'is_public', name: 'is_public'},
                {data: 'tipe_document', name: 'tipe_document'},
                {data: 'properties.sifat_dokumen', name: 'properties.sifat_dokumen'},
                {data: 'kategori', name: 'kategori'},
                @can('aplikasi_dokumen-show')
                    {
                        data: 'show', 
                        name: 'show',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
                @can('aplikasi_dokumen-edit')
                    {
                        data: 'edit', 
                        name: 'edit',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                @endcan
                @can('aplikasi_dokumen-delete')
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
                @can('aplikasi_dokumen-create')
                    {
                        text: "<i class='fa-solid fa-plus'></i>",
                        className: 'btn btn-primary mb-4 mr-2 text-white',
                        action: function ( e, dt, button, config ) {
                        window.location = '{{ route('documents.create') }}';
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

        

    </script>
    {{-- <script>
        $(document).ready(function() {

            //SweetAlert2 Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000
            });

        });

    </script> --}}
@endpush