@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h1>Informasi Dokumen</h1>
                    <div class="row">
                        <div class="col-md-6">
                           
                            <table class="table table-sm table-bordered table-hover w-100 table table-striped">
                                <tr>
                                    <td>No Dokumen</td>
                                    <td>:</td>
                                    <td>{{$item->no_document}}</td>
                                </tr>
                                <tr>
                                    <td>Perihal Dokumen</td>
                                    <td>:</td>
                                    <td>{{$item->perihal}}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Dokumen</td>
                                    <td>:</td>
                                    <td>{{\Carbon\Carbon::parse($item->tgl_document)->isoFormat('dddd')}} , {{\Carbon\Carbon::parse($item->tgl_document)->isoFormat('D MMMM Y')}}</td>
                                </tr>
                                <tr>
                                    <td>Sifat Dokumen</td>
                                    <td>:</td>
                                    <td>
                                        {{$item->properties->sifat_dokumen}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kategori Dokumen</td>
                                    <td>:</td>
                                    <td>
                                        @foreach ( $item->map_kategori as $kat)
                                            <span class="badge text-bg-secondary">{{$kat->kategori->jenis_dokumen}}</span> 
                                        @endforeach
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lokasi Penyimpanan</td>
                                    <td>:</td>
                                    <td>{{$item->location}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{$item->keterangan}}</td>
                                </tr>
                                <tr>
                                    <td>Uploader</td>
                                    <td>:</td>
                                    <td>{{Str::ucfirst($item->created_by)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered table-hover w-100 table table-striped">
                                <tr>
                                    <td>Dokumen</td>
                                    <td></td>
                                    <td>
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>Arsip Dokumen</td>
                                    <td>:</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm text-white mb-1" href="#" id="lihatDokumen" >
                                            <i class="fa-solid fa-file-pdf"></i> Lihat Dokumen
                                        </a>
                                        <a class="btn btn-success btn-sm text-white mb-1" href="#" id="downloadDokumen">
                                            <i class="fa-solid fa-file-pdf"></i> Download Dokumen
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>History Akses Dokumen</td>
                                    <td>:</td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm text-white" href="#" id="showHistory">
                                            <i class="fa-solid fa-file-pdf"></i> Lihat History
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <iframe id="myFrame" src="{{route('documents.showDocument', $item->slug)}}#toolbar=0&navpanes=0" type='application/pdf' width='100%' height='800x' oncontextmenu="return false"></iframe>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="download" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <iframe id="myFrame" src="{{route('documents.showDocument', $item->slug)}}" type='application/pdf' width='100%' height='800x' oncontextmenu="return false"></iframe>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="history" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title fs-5" id="staticBackdropLabel">History Dokumen</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="example" class="table table-sm table-bordered table-hover w-100 table table-striped border datatable">
                    <thead>
                        <tr>
                            <th class="py-2">#</th>
                            <th class="py-2">Time Stamp</th>
                            <th class="py-2">User</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
  
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap5.min.css') }}">
@endpush

@push('addon-script')
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script>
        $('#lihatDokumen').click(function(e) {
            $('#preview').modal('show'); 
            $.ajax({
                url: "{{ route("documents.storeLogPreview", "$item->id") }}",
                type: "GET",
                cache: false,
                success:function(response){
                    console.log(response)
                },
                error:function(error){
                    console.log(error.responseJSON);
                }

            });
        });
        $('#downloadDokumen').click(function(e) {
            $('#download').modal('show'); 
            $.ajax({
                url: "{{ route("documents.storeLogDownload", "$item->id") }}",
                type: "GET",
                cache: false,
                success:function(response){
                    console.log(response)
                },
                error:function(error){
                    console.log(error.responseJSON);
                }

            });
        });
        var datatables = $('#example').DataTable({
            processing : true,
            serverSide  : true,
            ordering : true,
            ajax: {
                url: "{{ route("documents.showHistory", "$item->id") }}"
            },
            columns : [
                { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, width: '5%' },
                {data: 'nama', name: 'nama'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100,  "All"]],
        });

        $('#showHistory').click(function(e) {
            $('#history').modal('show'); 
            datatables.draw();
        });
    </script>

@endpush