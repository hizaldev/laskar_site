<html>
<head>
    <title>Surat Kuasa Pemotongan Iuran Anggota {{$users->nama_lengkap}}</title>
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
        <img src="{{ public_path('images/header.png') }}" style="height: 150px; width:100%; object-fit: cover;">
    </header>

    <footer>
        <img src="{{ public_path('images/footer.png') }}" style="height: 545px; width:100%; object-fit: cover;">
    </footer>
    <main>
        <p class="text-center" style="font-size: 16px; font-weight:bold">SURAT KUASA PEMOTONGAN IURAN ANGGOTA<br>LASKAR PLN
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
                <td>Nomor Induk Pegawai</td>
                <td style="width: 10px;"></td>
                <td>:</td>
                <td style="width: 10px;"></td>
                <td>{{$users->unit->unit}}</td>
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
        </table>
        <br>
        <p style="font-size: 12px; text-align: justify;">Dengan ini memberikan Kuasa kepada Dewan Pengurus Pusat (DPP) LASKAR PLN PT PLN (Persero) untuk memotong Iuran Keanggotaan setiap bulan dari Payroll Penghasilan saya sebesar <span style="font-weight: bold;"> Rp 25.000,- (Dua Puluh Lima Ribu Rupiah)</span> atau sesuai Peraturan Organisasi yang berlaku.</p>
        <p style="font-size: 12px; text-align: justify;">Demikian Surat Kuasa ini saya buat dengan sungguh - sungguh dan tanpa ada paksaan dari pihak manapun agar dapat dipergunakan sebagaimana mestinya.</p>
        <br>
        <table id="ttd">
            <tr>
                <td style="width: 50%">
                    <p style="font-size: 12px">......................, {{$users->tgl_pendaftaran}}</p>
                    <p style="font-size: 12px">Hormat saya,</p>
                    <img src="{{ storage_path('app/public/assets/digsign/'.$users->sign) }}" style="height: 80px;width:150px;">
                    <p style="font-size: 12px">{{$users->nama_lengkap}}</p>
                </td>
            </tr>
        </table>
    </main>
    
</body>
</html>