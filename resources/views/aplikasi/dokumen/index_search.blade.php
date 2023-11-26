@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-5">
        <div class="row">
            <h3>Pencarian Dokumen </h3>
            <div class="col-md-12">
                <form method="GET" enctype="multipart/form-data" id="search-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_document">Kata Kunci No Dokumen</label>
                                <input type="input" class="form-control form-control-sm" name="no_document" id="keyword" placeholder="Masukan Kata Nomor Dokumen">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_document">Kata Kunci Perihal</label>
                                <input type="input" class="form-control form-control-sm" name="perihal" id="keyword" placeholder="Masukan Kata Kunci Perihal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="properties">Sifat Dokumen</label>
                                <select name="properties_document_id" class="form-control" id="properties">
                                    <option value="">-- Pilih Sifat Dokumen --</option>
                                    @foreach ( $properties as $property )
                                        <option value="{{$property->id}}" >{{$property->sifat_dokumen}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="properties">Tipe Dokumen</label>
                                <select name="tipe_document" class="form-control" id="tipe">
                                    <option value="">-- Pilih Pilihan Dokumen --</option>
                                    <option value="file">File</option>
                                    <option value="link">Link</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="properties">Kategori Dokumen</label>
                                <select name="jenis_dokumen" class="form-control" id="jenis_dokumen">
                                    <option value="">-- Pilih Kategori Dokumen --</option>
                                    @foreach ( $jenis as $kat )
                                        <option value="{{$kat->id}}" >{{$kat->jenis_dokumen}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>

                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mt-3">
                    <div class="card-header"><strong>Pencarian Data Arsip Dokumen</strong></div>
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
                                        <th class="py-2"></th>
                                    </tr>
                                    <tr>
                                        <th class="py-2">#</th>
                                        <th class="py-2">Dokumen</th>
                                        <th class="py-2">Tgl Dokumen</th>
                                        <th class="py-2">Dokumen Publik</th>
                                        <th class="py-2">Tipe Dokumen</th>
                                        <th class="py-2">Sifat Dokumen</th>
                                        <th class="py-2">Kategori Dokumen</th>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#properties").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#tipe").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#jenis_dokumen").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
    
    <!-- Page specific script -->
    <script>
         
        var datatables = $('#example').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            sDom: 'Blrtip',
            ajax: {
                url: '{!! url()->current() !!}',
                data: function (d) {
                    d.properties_document_id = $('select[name=properties_document_id]').val();
                    d.tipe_document = $('select[name=tipe_document]').val();
                    d.jenis_dokumen = $('select[name=jenis_dokumen]').val();
                    d.no_document = $('input[name=no_document]').val();
                    d.perihal = $('input[name=perihal]').val();
                }
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'header', name: 'header'},
                {data: 'tgl_document', name: 'tgl_document'},
                {data: 'is_public', name: 'is_public'},
                {data: 'tipe_document', name: 'tipe_document'},
                {data: 'properties.sifat_dokumen', name: 'properties.sifat_dokumen'},
                {data: 'kategori', name: 'kategori'},
                    {
                        data: 'show', 
                        name: 'show',
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
   
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
        });

        $('#search-form').on('submit', function(e) {
            datatables.draw();
            e.preventDefault();
            console.log(e.preventDefault());
        });
    </script>
@endpush