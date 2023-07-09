@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class=""> Dashboard E-Vote</h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <form method="GET" action="{{ route('evotes.dashboard_evote')}}" enctype="multipart/form-data" class="row g-3">
                    <div class="col-auto">
                        {{-- <input type="password" class="form-control" id="inputPassword2" placeholder="Password"> --}}
                        @php
                            $checked = $vote == null ? 1 :$vote->id;
                        @endphp
                        <select name="vote_id" class="form-control @error('vote_id') is-invalid @enderror" id="vote_id" required>
                            <option value="">-- Pilih Pemilu Laskar --</option>
                            @foreach ( $list_vote as $lists )
                                <option value="{{$lists->id}}" {{$checked == $lists->id ? 'selected' : ''}}>{{$lists->judul_pemilihan}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card text-bg-light mb-3 h-100">
                    <div class="card-body">
                        {{-- <h5 class="card-title">Light card title</h5> --}}
                        <p >
                            <div class="text-muted">Judul Pemilu</div>
                            <div class="fw-semibold">{{$vote == null ? '-' : $vote->judul_pemilihan}}</div>
    
                            <div class="text-muted">Waktu Pelaksanaan Pemilu</div>
                            <div class="fw-semibold">{{$vote == null ? '-' : $vote->tgl_vote_mulai}} s/d {{$vote == null ? '-' : $vote->tgl_vote_berakhir}}</div>
                        </p>
                        
                        
                        {{-- <table class="table table-sm table-borderless table-hover w-100">
                            <tr>
                                <td>Judul Pemilu</td>
                                <td>:</td>
                                <td>{{$vote->judul_pemilihan}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{$vote->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pelaksanaan Pemilu</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </table> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-bg-primary bg-opacity-25 border-0 mb-3 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title text-muted">Total Peserta Vote</h5>
                                    <i class="fa-solid fa-users text-primary fs-1"></i>

                                </div>
                              <h1 class="card-text text-dark">{{$vote == null ? 0 : count($vote->voter)}}</h1>
                              <p class="text-primary">Peserta yang terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-bg-danger bg-opacity-25 border-0 mb-3 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title text-muted">Belum Memilih</h5>
                                    <i class="fa-solid fa-user-xmark text-danger fs-1 bg-opacity-50"></i>

                                </div>
                              <h1 class="card-text text-dark">{{$vote == null ? 0 : count($vote->voter) - count($vote->vote_counter)}}</h1>
                              <p class="text-danger">Peserta belum melakukan vote</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-bg-success bg-opacity-25 border-0 mb-3 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title text-muted">Telah Memilih</h5>
                                    <i class="fa-solid fa-user-check text-success fs-1 bg-opacity-50"></i>

                                </div>
                              <h1 class="card-text text-dark">{{$vote == null ? 0 : count($vote->vote_counter)}}</h1>
                              <p class="text-success">Peserta sudah melakukan vote</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Quick Count Pemilih vs Total Pemilih</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="chart-container text-center" style=" margin:auto; height:45vh; width:80vw;">
                                    <canvas id="myChart" ></canvas>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="chart-container text-center" style=" margin:auto; height:50vh; width:80vw;">
                            <canvas id="myChart" ></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header"><strong>Quick Count Hasil Pemungutan Suara</strong></div>
                    <div class="card-body">
                        <div class="chart-container text-center w-100 h-100">
                            <canvas id="myChartBar" ></canvas>
                        </div>
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
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const bar = document.getElementById('myChartBar');
      
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Pemilih', 'Belum Memilih', 'Telah Memilih'],
                datasets: [{
                label: '',
                data: [{{$vote == null ? 0 : count($vote->voter)}}, {{$vote == null ? 0 : count($vote->voter) - count($vote->vote_counter)}}, {{$vote == null ? 0 :  count($vote->vote_counter)}}],
                borderWidth: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Realtime Quick Count'
                    }
                },
            },
        });

        new Chart(bar, {
            type: 'bar',
            data: {
            labels: [
                @foreach ( $counter as $counters )
                    `{!! $counters->nama_lengkap!!}`,
                @endforeach
                'Belum Memilih',
            ],
            datasets: [{
                    data: [
                        @foreach ( $counter as $counters )
                            {{$counters->count}},
                        @endforeach
                        {{$vote == null ? 0 : count($vote->voter) - count($vote->vote_counter)}},
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
@endpush