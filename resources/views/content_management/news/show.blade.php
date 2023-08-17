@extends('layouts.news')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">News</a></li>
                            <li class="breadcrumb-item active">{{$item->judul}}</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        <span class="text-muted">{{\Carbon\Carbon::parse($item->tgl_tayang_mulai)->isoFormat('dddd, D MMMM Y')}}</span>
                        <h2 class="card-title text-primary fw-bold">{{$item->judul}}</h2>
                        <span class="text-muted">Penulis {{$item->penulis}}</span>
                        <p class="card-description"> 
                            @if (count($item->documentation) > 0)
                                <img src="{{$item->documentation[0]->photos}}" class="card-img-top" alt="...">
                            @endif
                            {!!$item->berita!!} 
                            
                        </p>
                        <div class="text-center">
                            {!! $share !!}
                        </div>
                        @foreach ( $kategori_berita as $categories)
                            <span class="badge text-bg-secondary px-4 py-2 text-dark bg-opacity-75 mb-2">{{$categories}}</span>
                        @endforeach
                        <section class="category-news mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title text-danger fw-bold">Baca Juga</h4>
                                </div>
                                @foreach ( $baca_juga as $baca )
                                    <div class="col-md-3 col-6">
                                        <a href="" class="d-block text-decoration-none fw-bold text-dark mb-3">
                                            <div class="card">
                                                <img src="{{count($baca->documentation) > 0 ? $baca->documentation[0]->photos : asset('images/logo_laskar.jpeg')}}" height="150px" class="card-img img-style" alt="...">
                                            </div>
                                            <div class="text-lines" >
                                                {{$baca->judul}}
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                
                                
                            </div>
                        </section>
                      </div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <div class="card h-100">
                      <div class="card-body">
                        <h4 class="card-title text-danger fw-bold">Most Popular ></h4>
                        <table class="table table-striped mb-4">
                            @foreach ( $most_popular as $popular)
                                <tr>
                                    <td>
                                        <span class="fw-bold fs-1 text-warning">{{ $loop->index +1 }} </span> 
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bold text-decoration-none" href="{{ url('read_news', $popular->slug) }}">
                                            {{$popular->judul}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </table>
                        <h4 class="card-title text-danger fw-bold">Laskar Event ></h4>
                        <table class="table table-striped">

                            @forelse ( $event as $event)
                                <tr>
                                    <td style="width:100px;">
                                         <img src="{{count($event->documentation) > 0 ? $event->documentation[0]->photos : asset('images/logo_laskar.jpeg')}}" class="card-img img-style" height="100px" style="max-width: 100px;" alt="..."> 
                                    </td>
                                    <td>
                                        <a class="text-decoration-none" href="{{ url('read_news', $event->slug) }}">
                                            <span class="text-dark fw-bold">{{$event->judul}}</span><br>
                                            <span class="text-muted" style="font-size:12px;">{{\Carbon\Carbon::parse($event->tgl_tayang_mulai)->isoFormat('dddd, D MMMM Y')}}</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center"> Belum ada data tersedia</td>
                            </tr>
                            @endforelse
                            
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.content -->
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 400px;
        }
        div#social-links ul li {
            display: inline-block;
        }          
        div#social-links ul li a {
            padding: 10px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 15px;
            color: #0A4D9B;
            background-color: #ccc;
        }
        .text-lines {
            overflow:hidden;
            max-height: 8rem;
            -webkit-box-orient: vertical;
            display: block;
            display: -webkit-box;
            overflow: hidden !important;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
        }

    </style>
@endpush

@push('addon-script')
    
@endpush