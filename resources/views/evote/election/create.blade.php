@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <form action="{{ route('evotes.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if ($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                            
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header"><strong>Tambah Data E-Vote</strong></div>
                        <div class="card-body">
                            
                       
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Judul Pemilihan</label>
                                <input type="text" class="form-control form-control-sm @error('judul_pemilihan') is-invalid @enderror" name="judul_pemilihan" value="{{ old('judul_pemilihan') }}" id="judul_pemilihan" placeholder="Masukan Judul Pemilihan Laskar">
                                @error('judul_pemilihan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                            
                                <textarea class="form-control form-control-sm" name="deskripsi" id="deskripsi" placeholder="Deskripsi Pemilihan Laskar" rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_vote_mulai">Tanggal Mulai Pemilu</label>
                                <input type="date" class="form-control form-control-sm @error('tgl_vote_mulai') is-invalid @enderror" name="tgl_vote_mulai" value="{{ old('tgl_vote_mulai') }}" id="tgl_vote_mulai" placeholder="dd/mm/yyyy">
                                @error('tgl_vote_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_vote_berakhir">Tanggal Mulai Pemilu</label>
                                <input type="date" class="form-control form-control-sm @error('tgl_vote_berakhir') is-invalid @enderror" name="tgl_vote_berakhir" value="{{ old('tgl_vote_berakhir') }}" id="tgl_vote_berakhir" placeholder="dd/mm/yyyy">
                                @error('tgl_vote_berakhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
                    <div class="card h-100">
                        <div class="card-header"><strong>Peserta E-Vote</strong></div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Tambah Peserta E-Vote Berdasarkan</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="metode_peserta_evote" id="metode_peserta_evote1" onclick="showForm('anggota')" value="anggota">
                                    <label class="form-check-label" for="metode_peserta_evote1">Anggota</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="metode_peserta_evote" id="metode_peserta_evote2" onclick="showForm('dpd')" value="dpd">
                                    <label class="form-check-label" for="metode_peserta_evote2">Kategori DPD</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="metode_peserta_evote" id="metode_peserta_evote3" onclick="showForm('dpc')" value="dpc">
                                    <label class="form-check-label" for="metode_peserta_evote3">Kategori DPC</label>
                                </div>
                            </div>
                            <div id="select_anggota">
                                <div class="form-group mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="all_member" id="allmember">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Semua anggota menjadi peseta E-Vote</label>
                                    </div>
                                </div>
                                <div class="mb-3">atau</div>
                                <div class="form-group mb-3">
                                    <label >Pilih peserta E-Vote</label>
                                    <div class="col-sm-9 mt-3">
                                        <select class="form-select fom-select-sm js-example-basic-single w-full" multiple name="peserta[]" id="select2_member">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="select_dpd">
                                <div class="form-group mb-3">
                                    <label for="dpd_id">DPD Pemilih <span class="text-danger">*</span></label>
                                    <select name="dpd_id" class="form-control @error('dpd_id') is-invalid @enderror" id="dpd_id">
                                        <option value="">-- Pilih DPD --</option>
                                        @foreach ( $dpd as $dpds )
                                            <option value="{{$dpds->id}}" {{old('dpd_id') == $dpds->id ? 'selected' : ''}}>{{$dpds->dpd}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="select_dpc">
                                <div class="form-group mb-3">
                                    <label for="dpc_id">DPC Pemilih <span class="text-danger">*</span></label>
                                    <select name="dpc_id" class="form-control @error('dpc_id') is-invalid @enderror" id="dpc_id">
                                        <option value="">-- Pilih DPC --</option>
                                        @foreach ( $dpc as $dpcs )
                                            <option value="{{$dpcs->id}}" {{old('dpc_id') == $dpcs->id ? 'selected' : ''}}>{{$dpcs->dpc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mr-2 mt-2" onclick="return cekform();">Submit</button>
                            <a href="#" class="btn btn-outline-danger btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary bg-opacity-25"><strong>Bakal Calon 1</strong></div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Nama Lengkap Bakal Calon 1</label>
                                <input type="text" class="form-control form-control-sm" name="nama_lengkap[0]" value="{{old('nama_lengkap.0')}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                            </div>
                            <div class="form-group mb-3">
                                <label for="visi">Visi</label>
                                <textarea class="form-control form-control-sm" name="visi[0]" placeholder="Masukan Visi Calon " rows="3">{{old('visi.0')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Misi">Misi</label>
                                <textarea class="form-control form-control-sm" name="misi[0]" placeholder="Masukan Misi Calon " rows="3">{{old('misi.0')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Foto Bakal Calon 1</label>
                                <input type="file" class="form-control form-control-sm" name="photo[0]" id="photo[0]" value="{{old('photo.0')}}" placeholder="Masukan Nama Calon Yang Akan diPilih" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary bg-opacity-25"><strong>Bakal Calon 2</strong></div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Nama Lengkap Bakal Calon 2</label>
                                <input type="text" class="form-control form-control-sm" name="nama_lengkap[1]" value="{{old('nama_lengkap.1')}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                            </div>
                            <div class="form-group mb-3">
                                <label for="visi">Visi</label>
                                <textarea class="form-control form-control-sm" name="visi[1]" placeholder="Masukan Visi Calon " rows="3">{{old('visi.1')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Misi">Misi</label>
                                <textarea class="form-control form-control-sm" name="misi[1]" placeholder="Masukan Misi Calon " rows="3">{{old('misi.1')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Foto Bakal Calon 2</label>
                                <input type="file" class="form-control form-control-sm" name="photo[1]" id="photo[1]" value="{{old('photo.1')}}" placeholder="Masukan Nama Calon Yang Akan diPilih" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary bg-opacity-25"><strong>Bakal Calon 3</strong></div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Nama Lengkap Bakal Calon 3</label>
                                <input type="text" class="form-control form-control-sm" name="nama_lengkap[2]" value="{{old('nama_lengkap.2')}}" placeholder="Masukan Nama Calon Yang Akan diPilih">
                            </div>
                            <div class="form-group mb-3">
                                <label for="visi">Visi</label>
                                <textarea class="form-control form-control-sm" name="visi[2]" placeholder="Masukan Visi Calon " rows="3">{{old('visi.2')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Misi">Misi</label>
                                <textarea class="form-control form-control-sm" name="misi[2]" placeholder="Masukan Misi Calon " rows="3">{{old('misi.2')}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="judul_pemilihan">Foto Bakal Calon 3</label>
                                <input type="file" class="form-control form-control-sm" name="photo[2]" id="photo[2]" value="{{old('photo.2')}}"  placeholder="Masukan Nama Calon Yang Akan diPilih" required>
                            </div>
                        </div>
                    </div>
                
            </div>
        </form>
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script>
        window.onload = function() {
            document.getElementById('select_anggota').style.display = "none";
            document.getElementById('select_dpd').style.display = "none";
            document.getElementById('select_dpc').style.display = "none";
        };
        var checkbox = document.querySelector("input[name=all_member]");
        checkbox.addEventListener('change', function() {
        if (this.checked) {
            console.log("Checkbox is checked..");
            document.getElementById('select2_member').disabled = true;
        } else {
            console.log("Checkbox is not checked..");
            document.getElementById('select2_member').disabled = false;
        }
        });
        function showForm($id){
            var anggota = document.getElementById("select_anggota");
            var dpd = document.getElementById("select_dpd");
            var dpc = document.getElementById("select_dpc");
            if($id == "anggota"){
                anggota.style.display = "block";
                dpd.style.display = "none";
                dpc.style.display = "none";
            }
            if($id == "dpd"){
                dpd.style.display = "block";
                anggota.style.display = "none";
                dpc.style.display = "none";
            }
            if($id == "dpc"){
                dpc.style.display = "block";
                dpd.style.display = "none";
                anggota.style.display = "none";
            }
        }
    </script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#dpd_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
        $("#dpc_id").select2({
            theme: "bootstrap-5",
            containerCssClass: "select2--small", // For Select2 v4.0
            selectionCssClass: "select2--small", // For Select2 v4.1
            dropdownCssClass: "select2--small",
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.js-example-basic-single').select2({
                theme: "bootstrap-5",
                placeholder: 'Cari Anggota',
                minimumInputLength: 2,
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                  url: "{{ route('members.getMembers') }}",
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nama_lengkap+" - "+item.no_telpon,
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
        function cekform(){
            var $metodePesertaEvote1 = document.getElementById('metode_peserta_evote1');
            var $metodePesertaEvote2 = document.getElementById('metode_peserta_evote2');
            var $metodePesertaEvote3 = document.getElementById('metode_peserta_evote3');

            // if ($metodePesertaEvote1.checked && !$selectMember.value && $checkedAngota.checked) {
            //     alert('Peserta E-vote atau Semua Peserta Tidak Boleh kosong');
            //     return false;
            // }

            if ($metodePesertaEvote2.checked && !$('#dpd_id').val()) {
                alert('Peserta DPD wajib di pilih');
                $('#dpd_id').focus()
                return false;
            }

            if ($metodePesertaEvote3.checked && !$('#dpc_id').val()) {
                alert('Peserta DPC wajib di pilih');
                $('#dpc_id').focus()
                return false;
            }

            if (!$('#judul_pemilihan').val()) {
                alert('Judul Pemilihan tidak boleh kosong');
                $('#judul_pemilihan').focus()
                return false;
            }

            if (!$('#deskripsi').val()) {
                alert('Deskripsi tidak boleh kosong');
                $('#deskripsi').focus()
                return false;
            }

            if (!$('#tgl_vote_mulai').val()) {
                alert('Tanggal mulai pemilu tidak boleh kosong');
                $('#tgl_vote_mulai').focus()
                return false;
            }

            if (!$('#tgl_vote_berakhir').val()) {
                alert('Tanggal berakhir pemilu tidak boleh kosong');
                $('#tgl_vote_berakhir').focus()
                return false;
            }

        }
    </script>
@endpush