@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        @if ($errors->any())
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <form action="{{ route('news.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Tambah Berita Laskar</strong></div>
                        <div class="card-body">
                            
                    
                            <div class="form-group mb-3">
                                <label for="judul">Judul Berita</label>
                                <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror" name="judul" value="{{old('judul')}}" id="kategori_berita" placeholder="Masukan Judul Berita">
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_show" name="is_show" id="allmember" checked>
                                            <label class="form-check-label" for="is_show">Tampilkan Berita</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public" id="allmember" checked>
                                            <label class="form-check-label" for="is_public">Berita Publik</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_schedule" name="is_schedule" id="allmember">
                                            <label class="form-check-label" for="is_schedule">Dijadwalkan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="penulis" name="penulis" id="allmember">
                                            <label class="form-check-label" for="penulis">Penulis Laskar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3 col-md-6 col-sm-12">
                                        <label for="judul">Tanggal Tayang mulai</label>
                                        <input type="date" class="form-control @error('tgl_tayang_mulai') is-invalid @enderror" name="tgl_tayang_mulai" value="{{ old('tgl_tayang_mulai') }}" id="tgl_tayang_mulai" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3 col-md-6 col-sm-12">
                                        <label for="judul">Tanggal Tayang berakhir</label>
                                        <input type="date" class="form-control @error('tgl_tayang_berakhir') is-invalid @enderror" name="tgl_tayang_berakhir" value="{{ old('tgl_tayang_berakhir') }}" id="tgl_tayang_berakhir" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary btn-sm mr-2 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Kategori Berita</button>
                            <div class="form-group mb-3">
                                <label >Kategori Berita</label>
                                <div class="col-sm-12 mb-3">
                                    <select class="form-select fom-select-sm js-example-basic-single w-full" multiple name="kategori_berita_id[]" id="select2_member" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control form-control-sm" name="berita" id="myeditorinstance" placeholder="Isi Berita" rows="3"></textarea>
                            </div>
                            
                            
                            
                            <button type="submit" class="btn btn-success btn-sm mr-2 mt-2">Submit</button>
                            <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                    
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Lampiran dan Notifikasi Berita Laskar</strong></div>
                        <div class="card-body">
                            
                            <div class="row ">
                                <div class="col-12 d-none d-sm-none d-md-block">
                                    <div class="alert alert-warning">
                                        Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar optimal gunakan ukuran minimum 700 x 700 px).<br>
                                        Pilih foto Berita dan letakkan dimasing-masing inputan hingga 4 foto di sini. Upload min. Foto utama akan digunakan sebagai tampilan awal foto atau <strong>broadcast whatsapp group</strong> apabila dipilih
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label >Foto Utama</label>
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="file0" aria-label="Upload">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label >Foto 2</label>
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="file1" aria-label="Upload">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label >Foto 3</label>
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="file2" aria-label="Upload">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label >Foto 4</label>
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="file3" aria-label="Upload">
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label >File Lampiran<span class="text-danger"> format file harus .pdf</span></label>
                                        <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="file" aria-label="Upload">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="form-group mb-3">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" id="sendWa" name="sendWa" id="sendWa">
                                        <label class="form-check-label mx-3" for="sendWa">Broadcast Group</label>
                                        
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <select class="form-select form-select-sm w-full" name="group_id" id="select2_wa">
                                        <option value="">-- Pilih Group --</option>
                                        @foreach ( $group as $groups )
                                            <option value="{{$groups->id}}">{{$groups->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                               
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline mx-4">
                                        <input class="form-check-input" type="radio" name="format_send" id="inlineRadio1" value="body" checked>
                                        <label class="form-check-label" for="inlineRadio1">Judul + body</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="format_send" id="inlineRadio2" value="header">
                                        <label class="form-check-label" for="inlineRadio2">Judul</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="format_send" id="inlineRadio3" value="body_only">
                                        <label class="form-check-label" for="inlineRadio3">Body</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lampiran_wa" id="lampiran2" value="image" checked>
                                        <label class="form-check-label" for="lampiran2">Image</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline mx-4">
                                        <input class="form-check-input" type="radio" name="lampiran_wa" id="lampiran1" value="file">
                                        <label class="form-check-label" for="lampiran1">File</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline mx-4">
                                        <input class="form-check-input" type="radio" name="lampiran_wa" id="lampiran3" value="tanpa_lampiran">
                                        <label class="form-check-label" for="lampiran3">Tanpa Lampiran</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Berita</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="kategori_berita">Nama Kategori Berita</label>
                    <input type="text" class="form-control form-control-sm w-100" name="kategori_berita" id="kategoriBerita" placeholder="Masukan Nama Kategori Berita">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-sm btn-primary" id="store">Simpan</button>
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
        $(document).ready(function(){
            $('.js-example-basic-single').select2({
                // theme: "bootstrap-5",
                placeholder: 'Cari Kategori',
                minimumInputLength: 2,
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                  url: "{{ route('news_category.getCategories') }}",
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.kategori_berita,
                                id: item.kategori_berita
                            }
                        })
                    };
                  },
                  cache: true
                }
            });
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/g98z73jkc1wixst6j7zxujkbms7cn8btz0c42unv4e3gj0x2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
       tinymce.init({
         selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
         plugins: 'table lists emoticons wordcount',
         toolbar: 'undo redo | blocks| emoticons | bold italic | bullist numlist checklist | code | table'
       });
    </script>
    <script>
        window.onload = function() {
            
            document.getElementById('tgl_tayang_mulai').disabled = true;
            document.getElementById('tgl_tayang_berakhir').disabled = true;
            document.getElementById('select2_wa').disabled = true;
            document.getElementById('inlineRadio1').disabled = true;
            document.getElementById('inlineRadio2').disabled = true;
            document.getElementById('inlineRadio3').disabled = true;
            document.getElementById('lampiran1').disabled = true;
            document.getElementById('lampiran2').disabled = true;
            document.getElementById('lampiran3').disabled = true;
            
        };
        var checkbox = document.querySelector("input[name=is_schedule]");
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                console.log("Checkbox is checked..");
                document.getElementById('tgl_tayang_mulai').disabled = false;
                document.getElementById('tgl_tayang_berakhir').disabled = false;
            } else {
                console.log("Checkbox is not checked..");
                document.getElementById('tgl_tayang_mulai').disabled = true;
                document.getElementById('tgl_tayang_berakhir').disabled = true;

            }
        });
        var checkboxWa = document.querySelector("input[name=sendWa]");
        checkboxWa.addEventListener('change', function() {
            if (this.checked) {
                console.log("Checkbox is checked..");
                document.getElementById('select2_wa').disabled = false;
                document.getElementById('inlineRadio1').disabled = false;
                document.getElementById('inlineRadio2').disabled = false;
                document.getElementById('inlineRadio3').disabled = false;
                document.getElementById('lampiran1').disabled = false;
                document.getElementById('lampiran2').disabled = false;
                document.getElementById('lampiran3').disabled = false;
            } else {
                console.log("Checkbox is not checked..");
                document.getElementById('select2_wa').disabled = true;
                document.getElementById('inlineRadio1').disabled = true;
                document.getElementById('inlineRadio2').disabled = true;
                document.getElementById('inlineRadio3').disabled = true;
                document.getElementById('lampiran1').disabled = true;
                document.getElementById('lampiran2').disabled = true;
                document.getElementById('lampiran3').disabled = true;
            }
        });
        $('#store').click(function(e) {
            e.preventDefault();

            //define variable
            let kategori_berita   = $('#kategoriBerita').val();
            console.log(kategori_berita);
            let token   = $("meta[name='csrf-token']").attr("content");
            //ajax
            $.ajax({

                url: '{{ route('news_category.storeCategory') }}',
                type: "POST",
                cache: false,
                data: {
                    "kategori_berita": kategori_berita,
                    "_token": token
                },
                success:function(response){

                    alert('Data berhasil di tambahkan');
                    $('#kategoriBerita').val('');
                    $('#exampleModal').modal('hide');
                },
                error:function(error){

                    console.log(error.responseJSON.kategori_berita[0]);
                    alert(error.responseJSON.kategori_berita[0]);
                    $('#kategoriBerita').val('');
                    $('#exampleModal').modal('hide');

                }

            });

        });
    </script>
@endpush