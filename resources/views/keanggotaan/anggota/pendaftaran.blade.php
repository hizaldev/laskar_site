<html>
<head>
    <title>Formulir Pengunduran Diri {{$users->nama_lengkap}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style type="text/css">
    @page { margin-left: 0px; margin-right: 0px;}
    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 100px !important;
        font-size: 20px !important;
        /* background-image: {{ public_path('images/header.png') }} */
        color: white;
        text-align: center;
        line-height: 35px;
    }

    footer {
        position: fixed; 
        bottom: 0px; 
        left: 0px; 
        right: 0px;
        height: 500px !important; 
        font-size: 20px !important;
        /* background-color: #000; */
        color: white;
        text-align: center;
        line-height: 35px;
    }
    main {
        position: absolute;
        margin-left: 100px;
        margin-right: 100px;
        margin-top: 100px;
    }
    #ttd{
        margin-left: 100px;
        margin-right: 100px;
        position: absolute;
        right: 0;
        width: 200px;
        /* border: 3px solid blue; */
        text-align: center;
    }
  </style>
<body>
    <header>
        {{-- production --}}
        <img src="{{ asset('images/header.png') }}" style="height: 150px; width:100%; object-fit: cover;">
        {{-- development --}}
        {{-- <img src="{{ public_path('images/header.png') }}" style="height: 150px; width:100%; object-fit: cover;"> --}}
    </header>

    <footer>
        {{-- production --}}
        <img src="{{ asset('images/footer.png') }}" style="height: 545px; width:100%; object-fit: cover;">
        {{-- development  --}}
        {{-- <img src="{{ public_Path('images/footer.png') }}" style="height: 545px; width:100%; object-fit: cover;"> --}}
    </footer>
    <main>
        <p class="text-center" style="font-size: 16px; font-weight:bold">FORMULIR PENDAFTARAN ANGGOTA<br>LASKAR PLN
        </p>
        <p style="font-size: 12px">Yang bertanda tangan di bawah ini :</p>
    
        <table style="font-size: 12px">
            <tr>
                <td>Nama</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->nama_lengkap}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin*</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->jenis_kelamin}}</td>
            </tr>
            <tr>
                <td>Golongan Darah</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->golongan_darah}}</td>
            </tr>
            <tr>
                <td>Nomor Induk Pegawai</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->nipeg}}</td>
            </tr>
            <tr>
                <td>Tempat / Tanggal</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->tempat_lahir}} / {{$users->tgl_lahir}}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->agama}}</td>
            </tr>
            <tr>
                <td>Grade</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->grade}}</td>
            </tr>
            <tr>
                <td>Bidang / Unit / Induk</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->unit->unit}}</td>
            </tr>
            <tr>
                <td>Nomor Hanphone</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->no_telpon}}</td>
            </tr>
            <tr>
                <td>E-Mail</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->email}}</td>
            </tr>
            <tr>
                <td>Ukuran Baju</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->size->ukuran}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->alamat}}</td>
            </tr>
        </table>
        <br>
        <p style="font-size: 12px; text-align: justify;">Dengan penuh kesadaran dan tanpa paksaan dari pihak manapun menyatakan Mendaftarkan Diri menjadi Anggota Organisasi Karyawan LASKAR PLN PT PLN (Persero) serta saya tidak terdaftar sebagai Anggota Organisasi sejenis dimanapun. Sehubungan dengan hal tersebut, saya bersedia mentaati seluruh Peraturan Organisasi yang berlaku di dalamnya serta bersedia dipotong Iuran Anggota setiap bulannya.</p>
        <p style="font-size: 12px; text-align: justify;">Demikian Surat ini saya buat dengan sungguh - sungguh agar dapat dipergunakan sebagaimana mestinya.</p>
        <br>
        <table id="ttd">
            <tr>
                <td style="width: 50%">
                    <p style="font-size: 12px">......................, {{$users->tgl_pendaftaran}}</p>
                    <p style="font-size: 12px">Hormat saya,</p>
                    @if ($users->sign != null || strlen($users->sign) > 0 || substr($users->sign, -4) == '.png')
                        <img src="{{ storage_path('app/public/assets/digsign/'.$users->sign) }}" style="height: 80px;width:150px;">
                    @else
                        <br><br><br>
                    @endif
                    <p style="font-size: 12px">{{$users->nama_lengkap}}</p>
                </td>
            </tr>
        </table>
    </main>
    
</body>
</html>