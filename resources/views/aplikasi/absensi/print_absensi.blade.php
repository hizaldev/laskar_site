<html>
<head>
    <title>Formulir Absensi {{$attendance->agenda}} {{$attendance->tgl_agenda}}</title>
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
        margin-left: 50px;
        margin-right: 50px;
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
    .page-break {
        page-break-after: always;
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
    @foreach ($attendance_detail as $key => $kehadiran)

        <main>
            <table style="font-size: 12px">
                <tr>
                    <td><strong>Hari/Tanggal</strong></td>
                    <td style="width: 10px;"></td>
                    <td>:</td>
                    <td style="width: 10px;"></td>
                    <td><strong>{{\Carbon\Carbon::parse($attendance->tgl_agenda)->isoFormat('dddd')}} , {{\Carbon\Carbon::parse($attendance->tgl_agenda)->isoFormat('D MMMM Y')}}</strong></td>
                </tr>
                <tr>
                    <td><strong>Waktu</strong></td>
                    <td style="width: 10px;"></td>
                    <td>:</td>
                    <td style="width: 10px;"></td>
                    <td><strong>{{$attendance->jam_mulai}} s/d {{$attendance->is_selesai == 'Ya' ? 'Selesai' : $attendance->jam_berakhir}}</strong></td>
                </tr>
                <tr>
                    <td><strong>Tempat</strong></td>
                    <td style="width: 10px;"></td>
                    <td>:</td>
                    <td style="width: 10px;"></td>
                    <td><strong>{{$attendance->tempat}}</strong></td>
                </tr>
                <tr>
                    <td><strong>Agenda Rapat</strong></td>
                    <td style="width: 10px;"></td>
                    <td>:</td>
                    <td style="width: 10px;"></td>
                    <td><strong>{{$attendance->agenda}}</strong></td>
                </tr>
                
            </table>
            <table style="font-size: 12px" class="table table-bordered mt-3">
                <thead class="text-center bg-info">
                    <td style="width: 10px;"><strong>NO</strong></td>
                    <td style="width: 150px;"><strong>NAMA</strong></td>
                    <td style="width: 130px;"><strong>NO. HP / EMAIL</strong></td>
                    <td style="width: 150px;"><strong>UNIT / JABATAN</strong></td>
                    <td style="width: 120px;"><strong>TANDA TANGAN</strong></td>
                </thead>
                @for ($x = 0; $x < count($kehadiran); $x++)
                <tr>
                    <td style="height: 25px">{{$x+1}}</td>
                    <td style="height: 25px">{{$kehadiran[$x]['nama'] ?? null}}</td>
                    <td style="height: 25px"><div>{{$kehadiran[$x]['nama'] ?? null}}</div>{{$kehadiran[$x]['email'] ?? null}}</td>
                    <td style="height: 25px">{{$kehadiran[$x]['unit'] ?? null}}</td>
                    <td style="height: 25px"  class="text-center"><img src="data:image/png;base64, {!! base64_encode(QrCode::size(35)->generate($kehadiran[$x]['nama'] ?? null)) !!}"></td>
                   
                </tr>
                @endfor
                
                @php
                    $count = $jumlah_kehadiran > 12 ? 0 : 12 - $jumlah_kehadiran;
                @endphp

                @for ($i=0; $i < $count; $i++)
                    <tr>
                        <td style="height: 35px"></td>
                        <td style="height: 35px"></td>
                        <td style="height: 35px"></td>
                        <td style="height: 35px"></td>
                        <td style="height: 35px"></td>
                    </tr>
                @endfor
                
            </table>
            <p style="font-size: 12px">Printed by {{$printed_by}} {{$date}}</p>
        
        </main>
        <div class="page-break"></div>
    @endforeach

    
</body>
</html>