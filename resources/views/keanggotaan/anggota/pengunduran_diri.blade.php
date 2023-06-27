<html>
<head>
    <title>Formulir Pengunduran Diri {{$users->nama_lengkap}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style type="text/css">
    body { margin: 0px; }
    @page { margin-left: 100px; margin-right: 100px; }
    .ttd{
        position: absolute;
        right: 0;
        width: 200px;
        /* border: 3px solid blue; */
        text-align: center;
    }
  </style>
<body>
    <p class="text-center" style="font-size: 14px">FORMULIR PENGGUNDURAN DIRI<br>ORGANISASI SERIKAT PEKERJA</p>
    <p style="font-size: 12px">Yang bertanda tangan di bawah ini :</p>
  
    <table class="ml-4" style="font-size: 12px">
        <tr>
            <td>Nama</td>
            <td style="width: 10px;"></td>
            <td>:</td>
            <td style="width: 10px;"></td>
            <td>{{$users->nama_lengkap}}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td style="width: 10px;"></td>
            <td>:</td>
            <td style="width: 10px;"></td>
            <td>{{$users->nipeg}}</td>
        </tr>
        <tr>
            <td>No Anggota</td>
            <td style="width: 10px;"></td>
            <td>:</td>
            <td style="width: 10px;"></td>
            <td>{{$users->no_anggota}}</td>
        </tr>
        <tr>
            <td>Unit</td>
            <td style="width: 10px;"></td>
            <td>:</td>
            <td style="width: 10px;"></td>
            <td>{{$users->unit->unit}}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td style="width: 10px;"></td>
            <td>:</td>
            <td style="width: 10px;"></td>
            <td>{{$users->tgl_pendaftaran}}</td>
        </tr>
    </table>
    <br>
    <p style="font-size: 12px">Dengan penuh kesadaran menyatakan mengundurkan diri dari keanggotaan Serikat Pekerja di lingkungan PT PLN (Persero) – (SP PLN / SPP PLN / Serikat Pegawai Perusahaan Listrik Negara). Sehubungan dengan hal tersebut saya melepaskan segala hak dan kewajiban saya dari keanggotaan.</p>
    <p style="font-size: 12px">Demikian surat pernyataan ini saya buat dengan sungguh- sungguh agar dapat dipergunakan sebagaimana mestinya.</p>
    <br>
    <table class="ttd">
        <tr>
            <td style="width: 50%">
                <p style="font-size: 12px">Hormat Saya,</p>
                @if ($users->sign != null || strlen($users->sign) > 0 || substr($users->sign, -4) == '.png')
                    <img src="{{ storage_path('app/public/assets/digsign/'.$users->sign) }}" style="height: 80px;width:150px;">
                @else
                    <br><br><br>
                @endif
                <p style="font-size: 12px">{{$users->nama_lengkap}}</p>
            </td>
        </tr>
    </table>
</body>
</html>