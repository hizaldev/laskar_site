@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class=""> Dashboard Laskar PLN</h3>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 col-6 mb-3">
                <div class="card text-bg-primary bg-opacity-25 border-0 mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-muted">Total Anggota</h5>
                            <i class="fa-solid fa-users text-primary fs-1"></i>

                        </div>
                      <h1 class="card-text text-dark">{{$sebaran_anggota}} Anggota</h1>
                      <p class="text-primary">Jumlah Anggota LASKAR PLN</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6 mb-3">
                <div class="card text-bg-danger bg-opacity-25 border-0 mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-muted">Anggota Pensiun</h5>
                            <i class="fa-solid fa-user-xmark text-danger fs-1 bg-opacity-50"></i>

                        </div>
                      <h1 class="card-text text-dark">{{$anggota_pensiun}} Anggota</h1>
                      <p class="text-danger">Anggota LASKAR yang Pensiun</p>

                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-bg-warning bg-opacity-25 border-0 mb-3 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-muted">Pensiun Tahun Ini</h5>
                            <i class="fa-solid fa-user-check fs-1 bg-opacity-50"></i>

                        </div>
                      <h1 class="card-text text-dark">{{$sebaranUmur[0]->lima_puluh_enam}}</h1>
                      <p>Anggota yang pensiun tahun ini</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div id="map" style="height: 75vh"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Sebaran Umur Anggota</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container text-center" style=" margin:auto; height:45vh; width:80vw;">
                                    <canvas id="myChartBar" ></canvas>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Sebaran DPC Anggota</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container text-center" style=" margin:auto; height:45vh; width:80vw;">
                                    <canvas id="myChartBarDpc" ></canvas>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header"><strong>Sebaran Unit Anggota</strong></div>
                    <div class="card-body">
                        <canvas id="myChartBarUnit"  style="display: block; height: 263px; width: 790px;"  ></canvas>
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
    {{-- css leaflet --}}
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}">
        <link rel="stylesheet" href="{{ asset('leaflet/leaflet-search.css') }}">
        <style>
            /*Legend specific*/
            .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
            }
            .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
            }

            .legend span {
            position: relative;
            bottom: 3px;
            }

            .legend i {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
            }

            .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
            }

        </style>
    {{-- end css leaflet --}}
    <!-- End plugin css for this page -->
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const bar = document.getElementById('myChartBar');
        const bar_dpc = document.getElementById('myChartBarDpc');
        const bar_unit = document.getElementById('myChartBarUnit');

        new Chart(bar, {
            type: 'bar',
            data: {
            labels: [
                    'Umur < 21',
                    'Umur 21 s/d 29',
                    'Umur 30 s/d 40',
                    'Umur 41 s/d 55',
                    'Umur 56',
                    'Umur > 56',
            ],
            datasets: [{
                    data: [
                       
                            {{$sebaranUmur[0]->bawah_dua_satu}},
                            {{$sebaranUmur[0]->dua_satu_to_dua_sembilan}},
                            {{$sebaranUmur[0]->tiga_puluh_to_empat_puluh}},
                            {{$sebaranUmur[0]->empat_satu_to_lima_lima}},
                            {{$sebaranUmur[0]->lima_puluh_enam}},
                            {{$sebaranUmur[0]->atas_lima_puluh_enam}},
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(bar_dpc, {
            type: 'bar',
            data: {
            labels: [
                @foreach ( $sebaran_dpc_anggota as $anggota_dpc )
                    `{!! $anggota_dpc->dpc!!}`,
                @endforeach
            ],
            datasets: [{
                    data: [
                        @foreach ( $sebaran_dpc_anggota as $anggota_dpc )
                            {{$anggota_dpc->total}},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(bar_unit, {
            type: 'bar',
            data: {
            labels: [
                @foreach ( $sebaran_unit_anggota as $unitAnggota )
                    `{!! $unitAnggota->unit!!}`,
                @endforeach
            ],
            datasets: [{
                    data: [
                        @foreach ( $sebaran_unit_anggota as $unitAnggota )
                            {{$unitAnggota->total}},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
            responsive:true,
            maintainAspectRatio: false
        });

    </script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#vote_id").select2({
            theme: "bootstrap-5",
        });
    </script>
    {{-- start GIS --}}
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('leaflet/leaflet-search.js') }}"></script>
    <script>
        function addMapPicker() {
        
        var layananIcon = L.layerGroup();
        var jalurTopologi = L.layerGroup();
        var maintenanceTm = L.layerGroup();
        var dataArray = [];
        var icon = new L.Icon.Default();
            icon.options.shadowSize = [0,0];



        var data = [
            
        ];

        console.log(data);
        
        // var dataGangguan = getGangguan();

        // console.log(dataGangguan);
        // data Gangguan
       
        // data tolopogi
        L.circle([-6.734647484 , 110.57575448], {radius: 43200}).addTo(layananIcon).bindPopup('Layanan Icon 2');
        L.circle([-6.736449347 , 110.238348474], {radius: 10000}).addTo(layananIcon).bindPopup('Layanan Icon 3');
        L.circle([-6.1832636348 , 110.9374363732], {radius: 10000}).addTo(layananIcon).bindPopup('Layanan Icon 4');
        L.circle([-6.8346373634 , 110.846338], {radius: 10000}).addTo(layananIcon).bindPopup('Layanan Icon 5');
        
        var mapCenter = [-1.8043511,118.2998011];
        var peta  = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            noWrap : true
        });

        var map   = L.map('map', {
            center : mapCenter, 
            zoom : 5,
            // set active layer 
            layers: [
                peta,
                layananIcon,
                maintenanceTm
            ]});

        var baseLayers = {};
        
        var overlays = {

            "GANGGUAN LINK ICON+" : layananIcon,
            "TOPOLOGI LOOP" : jalurTopologi,
            "PEMELIHARAAN TM" : maintenanceTm,
        };
        
        L.control.layers(baseLayers, overlays).addTo(map);
        var markersLayer = new L.LayerGroup();	//layer contain searched elements

        map.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position:'topleft',		
            layer: markersLayer,
            initial: false,
            zoom: 17,
            marker: false,
        }).addTo(map);

        for(i in data) {
            var title = data[i].title,	//value searched
            loc = data[i].loc,
            marker = new L.circle(new L.latLng(loc), {title: title, radius: 1, color: 'transparent', fillColor: 'white',fillOpacity: 0.0,} );//se property searched
            markersLayer.addLayer(marker);
        }

            var legend = L.control({ position: "bottomleft" });

            legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML += "<h4>Legend</h4>";
            div.innerHTML += '<i style="background: #477AC2"></i><span>DPD</span><br>';
            div.innerHTML += '<i style="background: red"></i><span>DPC</span><br>';
            return div;
            };

            legend.addTo(map);


        }
        
        $(document).ready(function() {
        addMapPicker();
        });
    </script>
    {{-- end GIS --}}
@endpush