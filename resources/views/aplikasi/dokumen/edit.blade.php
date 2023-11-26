@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header"><strong>Edit Data Arsip Laskar PLN</strong></div>
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
                        <form id="fileUploadForm" action="{{ route('documents.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="no_document">Nomor Dokumen</label>
                                <input type="text" class="form-control form-control-sm @error('no_document') is-invalid @enderror" name="no_document" value="{{ $item->no_document }}" id="no_document" placeholder="Masukan No Dokumen">
                                @error('no_document')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="perihal">Perihal</label>
                                <input type="text" class="form-control form-control-sm @error('perihal') is-invalid @enderror" name="perihal" value="{{ $item->perihal }}" id="perihal" placeholder="Masukan Perihal Dokumen">
                                @error('perihal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_document">Tanggal Dokumen</label>
                                <input type="date" class="form-control form-control-sm @error('tgl_document') is-invalid @enderror" name="tgl_document" value="{{ $item->tgl_document }}" id="tgl_document" placeholder="dd/mm/yyyy">
                                @error('tgl_document')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                    <label for="tgl_document">Dokumen Publik?</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_public" id="Ya" value="Ya" {{$item->is_public == 'Ya' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="Ya">Ya</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_public" id="Tidak" value="Tidak" {{$item->is_public == 'Tidak' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="Tidak">Tidak</label>
                                      </div>
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-sm-12">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group mb-3">
                                        <label for="tgl_document">Tipe Dokumen</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tipe_document" id="file" value="file" {{$item->tipe_document == 'file' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="file">File</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tipe_document" id="link" value="link" {{$item->tipe_document == 'link' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="link">Link</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group mb-3">
                                <label for="properties">Sifat Dokumen</label>
                                <select name="properties_document_id" class="form-control @error('properties_document_id') is-invalid @enderror" id="properties" required>
                                    <option value="">-- Pilih Sifat Dokumen --</option>
                                    @foreach ( $properties as $property )
                                        <option value="{{$property->id}}" {{$item->document_properties_id == $property->id ? 'selected' : ''}} >{{$property->sifat_dokumen}}</option>
                                    @endforeach
                                </select>
                                @error('properties_document_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary btn-sm mr-2 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Kategori Dokumen</button>
                            <div class="form-group mb-3">
                                <label >Kategori Dokumen</label>
                                <div class="col-sm-12 mb-3">
                                    <select class="form-select fom-select-sm js-example-basic-single w-full" multiple name="jenis_document_id[]" id="select2_member" required>
                                        @foreach ( $maps as $map )
                                            <option value="{{$map->jenis_document_id}}" selected>{{$map->kategori != null ? $map->kategori->jenis_dokumen : ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="location">Lokasi Penyimpanan Arsip</label>
                               
                                <textarea class="form-control form-control-sm" name="location" id="location" placeholder="Lokasi Penyimpanan Arsip" rows="3">{{ $item->location }}</textarea>
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                               
                                <textarea class="form-control form-control-sm" name="keterangan" id="keterangan" placeholder="Keterangan" rows="3">{{ $item->keterangan }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 desc" id="tip_dokfile">
                                <label >File Dokumen<span class="text-danger"> format file harus .pdf</span></label>
                                <input type="file" class="form-control form-control-sm desc" id="document" aria-describedby="inputGroupFileAddon03" name="document" aria-label="Upload">
                                @if ($item->document != null)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#preview">
                                        <span class="">
                                            Lihat File Lampiran
                                        </span>
                                    </a>
                                @endif
                                @error('document')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3 desc" style="display: none;" id="tip_doklink">
                                <label for="links" class="">Link</label>
                                <input type="text" class="form-control form-control-sm @error('links') is-invalid @enderror desc" name="links" value="{{ $item->links }}" id="links" placeholder="Masukan Link Referensi Arsip">
                                @error('links')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mr-2 mt-2">Submit</button>
                            <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Dokumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="kategori_berita">Kategori Dokumen</label>
                        <input type="text" class="form-control form-control-sm w-100" id="kategori_dokumen" placeholder="Masukan Nama Kategori Dokumen">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary" id="store">Simpan</button>
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
                <iframe id="myFrame" src="{{$item->document}}#toolbar=0&navpanes=0" type='application/pdf' width='100%' height='800x' oncontextmenu="return false"></iframe>
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
        $(function () {
            $(document).ready(function () {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {

                        var percentage = percentComplete;
                        var button = document.getElementById("button").disabled = true;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log(xhr.status);
                        if(xhr.status == 200){
                            alert('Data dan Dokumen Berhasil disimpan !!')
                            window.location.href = "{{ route('documents.index')}}";
                        }else{
                            alert('Data dan Dokumen Gagal disimpan !!')
                            window.location.href = "{{ route('documents.index')}}";
         
                        }

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2({
                // theme: "bootstrap-5",
                placeholder: 'Cari Kategori',
                minimumInputLength: 2,
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                  url: "{{ route('jenis_documents.getCategories') }}",
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.jenis_dokumen,
                                id: item.id
                            }
                        })
                    };
                  },
                  cache: true
                }
            });
        });
    </script>
    <script>
        $("#properties").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $('#store').click(function(e) {
            e.preventDefault();

            //define variable
            let jenis_dokumen   = $('#kategori_dokumen').val();
            console.log(jenis_dokumen);
            let token   = $("meta[name='csrf-token']").attr("content");
            //ajax
            $.ajax({

                url: '{{ route('jenis_documents.storeCategoryDokumen') }}',
                type: "POST",
                cache: false,
                data: {
                    "jenis_dokumen": jenis_dokumen,
                    "_token": token
                },
                success:function(response){

                    alert('Data berhasil di tambahkan');
                    $('#kategori_dokumen').val('');
                    $('#exampleModal').modal('hide');
                },
                error:function(error){

                    console.log(error.responseJSON.jenis_dokumen[0]);
                    alert(error.responseJSON.jenis_dokumen[0]);
                    $('#kategori_dokumen').val('');
                    $('#exampleModal').modal('hide');

                }

            });

        });
    </script>   
    <script>
        $(document).ready(function() {
            $("input[name$='tipe_document']").click(function() {
                var test = $(this).val();
                

                $("div.desc").hide();
                $("#tip_dok" + test).show();
            });
        });
    </script>
    
@endpush