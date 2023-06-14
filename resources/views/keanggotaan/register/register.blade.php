@extends('layouts.front_app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-sm-12">
                <h3>
                    <strong>
                        Ayo daftar dan bergabung<br> 
                        dengan serikat yang luar biasa
                    </strong>
                    
                </h3>
                <div class="card mb-4">
                    {{-- <div class="card-header"><strong>Tambah Master Data Golongan Darah</strong></div> --}}
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
                        @error('captcha')
                            <div class="alert alert-danger mt-1 mb-3">{{ $message }} wrong</div>
                        @enderror
                        <form action="{{ route('register_members.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" id="nama_lengkap" placeholder="Masukan Nama Lengkap">
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="nipeg">Nipeg <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nipeg') is-invalid @enderror" name="nipeg" value="{{ old('nipeg') }}" id="nipeg" placeholder="Masukan Nipeg">
                                @error('nipeg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="Masukan Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="email">Tempat & Tgl Lahir <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="form-group mb-3 col-md-6 col-sm-12">
                                    <select name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" required>
                                        <option value="">-- Pilih Tempat Lahir --</option>
                                        @foreach ( $city as $cities )
                                            <option value="{{$cities->kota}}" {{old('tempat_lahir') == $cities->kota ? 'selected' : ''}}>{{$cities->kota}}</option>
                                        @endforeach
                                    </select>
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 col-md-6 sol-sm-12">
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}" id="tgl_lahir" placeholder="">
                                    @error('tgl_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_telpon">No Whatsapp <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('no_telpon') is-invalid @enderror" name="no_telpon" value="{{ old('no_telpon') }}" id="no_telpon" placeholder="081xxxxxxxxxxx">
                                @error('no_telpon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="unit_id">Unit <span class="text-danger">*</span></label>
                                <select name="unit_id" class="form-control @error('unit_id') is-invalid @enderror" id="unit_id" required>
                                    <option value="">-- Pilih Unit --</option>
                                    @foreach ( $unit as $units )
                                        <option value="{{$units->id}}" {{old('unit_id') == $units->id ? 'selected' : ''}}>{{$units->unit}}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="size_id">Ukuran Baju <span class="text-danger">*</span></label>
                                <select name="size_id" class="form-control @error('size_id') is-invalid @enderror" id="size_id" required>
                                    <option value="">-- Pilih Ukuran Baju --</option>
                                    @foreach ( $size as $sizes )
                                        <option value="{{$sizes->id}}" {{old('size_id') == $sizes->id ? 'selected' : ''}}>{{$sizes->ukuran}}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="grade">Grade <span class="text-danger">*</span></label>
                                <select name="grade" class="form-control @error('grade') is-invalid @enderror" id="grade" required>
                                    <option value="">-- Pilih Grade --</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                </select>
                                @error('size_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_telpon">Tanda Tangan Digital <span class="text-danger">*</span></label>
                                <br>
                                {{-- <center>

                                    <div id="sig" ontouchmove="event.preventDefault();" ></div>
                                </center> --}}
                                <div id="signature-pad" class="signature-pad">
                                    <div class="signature-pad--body text-center" style="color:black;">
                                      <canvas style="border:1px solid black"></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                      <div class="signature-pad--actions text-center">
                                        <div>
                                          <button type="button" class="btn btn-danger btn-sm" data-action="clear">Hapus TTD</button>
                                          <button type="button" class="btn btn-success btn-sm" data-action="save-png" >Simpan TTD</button>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <br>
                                {{-- <button id="clear" class="btn btn-danger btn-sm">Clear TTD</button> --}}
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="kode_refferal">Kode Refferal</label>
                                <input type="text" class="form-control @error('kode_refferal') is-invalid @enderror" name="kode_refferal" id="kode_refferal" placeholder="Masukan Kode Refferal">
                                @error('kode_refferal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="captcha">Enter Captcha <span class="text-danger">*</span></label>
                                <div class="captcha mb-3">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    ↻
                                    </button>
                                </div>
                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">

                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary mr-2 mt-2" onclick="return cekform();">Lanjutkan Pendaftaran</button>
                            </div>
                            {{-- start modal terms and condition --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Condition !! Harap di baca terlebih dahulu !!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Terms and Conditions ini menjelaskan bagaimana Laskar PLN secara elektronis mengumpulkan, menggunakan, mengungkapkan, mengirimkan, menyimpan, mengolah dan melindungi informasi pribadi anda selalku pengelola data. Mohon baca terms and Conditions ini dengan seksama untuk memastikan bahwa anda memahami bagaimana proses pengolahan data kami. Kecuali didefinisikan lain, semua istilah dengan huruf kapital yang digunakan dalam Kebijakan Privasi ini memiliki arti yang sama dengan yang tercantum dalam Syarat dan Ketentuan.<br>
                                                Terms and Condition ini mencakup hal-hal sebagai berikut:
                                            </p>
                                            <p>
                                                Sesuai peraturan dan perundang-undangan yang berlalu saat ini:<br>
                                                <ol>
                                                    <li>Pasal 5 ayat (1) UU No. 21 Tahun 2000 tentang Serikat Pekerja (hak menjadi anggota serikat pekerja)</li>
                                                    <li>Pasal 28 Undang-Undang Nomor 21 Tahun 2000 tentang Serikat Pekerja/Serikat Buruh (UU SP/SB) (perlindungan hak berorganisasi; menjadi anggota atau tidak menjadi anggota)</li>
                                                    <li>Sesuai Pasal 104 ayat (1) Undang-Undang Nomor No.13 Tahun 2003 tentang Ketenagakerjaan (hak menjadi anggota serikat pekerja)</li> 
                                                </ol>
                                            </p>
                                            <p>
                                                Maka dengan ini saya menyatakan:<br>
                                                <ol>
                                                    <li>
                                                        <strong>PENGUNDURAN DIRI SEBAGAI KEANGGOTAAN ORGANISASI SERIKAT PEKERJA (JIKA PERNAH MENDAFTAR)</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka pendaftar penuh kesadaran menyatakan mengundurkan diri dari keanggotaan Serikat Pekerja di lingkungan PT PLN (Persero) – (SP PLN/ SP PLN Indonesia/ Serikat Pegawai Perusahaan Listrik Negara dan serikat pekerja lainnya). Sehubungan dengan hal tersebut saya melepaskan segala hak dan kewajiban saya dari keanggotaan.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <strong>PENDAFTARAN ANGGOTA SERIKAT PEKERJA LASKAR PLN</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka saya penuh kesadaran dan tanpa paksaan dari pihak manapun menyatakan Mendaftarkan Diri menjadi Anggota Organisasi Karyawan LASKAR PLN PT PLN (Persero) serta saya tidak terdaftar sebagai Anggota Organisasi sejenis dimanapun. Sehubungan dengan hal tersebut, pendaftar bersedia mentaati seluruh Peraturan Organisasi yang berlaku di dalamnya serta bersedia dipotong Iuran Anggota setiap bulannya.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <strong>SURAT KUASA PEMOTONGAN IURAN ANGGOTA LASKAR PLN</strong>
                                                        <p>
                                                            Dengan menyetujui pengisian formular ini maka saya memberikan Kuasa kepada Dewan Pengurus Pusat (DPP) LASKAR PLN PT PLN (Persero) untuk memotong Iuran Keanggotaan setiap bulan dari Payroll Penghasilan saya sebesar Rp 25.000 (Dua Puluh Lima Ribu Rupiah) atau sesuai Peraturan Organisasi yang berlaku serta tanda tangan digital yang dibubuhkan merupakan tanda tangan yang benar dan valid untuk dapat digunakan.
                                                        </p>
                                                    </li>
                                                </ol>
                                            </p>
                                            <p>
                                                Melalui pernyataan ini saya menyetujui dengan sungguh- sungguh dan tanpa ada paksaan dari pihak manapun agar dapat dipergunakan sebagaimana mestinya.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Saya Tidak Setuju</button>
                                        <button type="submit" class="btn btn-primary">Saya Setuju mendaftar sebagai anggota Laskar PLN</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            {{-- end modal terms and condition --}}
                        </form>
                        {{-- <img src="https://drive.google.com/uc?export=view&id=1Tm7v05stKeWJBXWxnddpYzUujITDNOWT" width="40px" height="40px" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
  
    <style>
        .kbw-signature { width: 300px; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
@endpush

@push('addon-script')
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    

    <script>
        $("#unit_id").select2({
            theme: "bootstrap-5",
        });
        $("#size_id").select2({
            theme: "bootstrap-5",
        });
        $("#grade").select2({
            theme: "bootstrap-5",
        });
        $("#tempat_lahir").select2({
            theme: "bootstrap-5",
        });
    </script>

    {{-- <script type="text/javascript" src="{{ asset('js/jquery.ui.touch-punch.min.js')}}"></script> --}}
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG', color: 'blue', background : 'transparent'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    <script src="{{ asset('js/reload.captcha.js') }}"></script>       
    <script src="{{ asset('js/register.check.js') }}"></script>       
    {{-- ttd js --}}
    <script src="{{ asset('js/signature_pad.js') }}"></script>       
    <script src="{{ asset('js/app.js') }}"></script>       
    

    
@endpush