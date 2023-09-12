<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Think BIG, Action BIG, Grow BIG</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content=" Think BIG, Action BIG, Grow BIG">
    <meta name="description" content="LASKAR PLN sebagai salah satu Serikat Pekerja di PLN yang Modern, Mandiri dan Berintegritas mengajak segenap pegawai PLN untuk bergabung bersama kami dalam keluarga besar Serikat Pekerja LASKAR PLN.">

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ asset('images/favicon.jpeg') }}"
      type="image/svg"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/ud-styles.css') }}" />
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="index.html">
                <img src="{{ asset('landing/images/logo_laskar_title.png') }}" alt="Logo" />
              </a>
              <button class="navbar-toggler">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>

              <div class="navbar-collapse">
                <ul id="nav" class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#home">Beranda</a>
                  </li>

                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#about">Visi Misi</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#news">Berita</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#faq">FAQ</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#testimonials">Testimoni</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#team">Pengurus</a>
                  </li>
                </ul>
              </div>

              {{-- <div class="navbar-btn d-none d-sm-inline-block"> --}}
              <div class="navbar-btn d-sm-inline-block">
                @guest
                    <a class="ud-main-btn ud-white-btn" href="{{ url('signin') }}">
                        Log In
                    </a>
                @else
                    <a class="ud-main-btn ud-white-btn" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ====== Header End ====== -->

    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
      <div class="container vh-100">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
              <h1 class="ud-hero-title">
                Think BIG, Action BIG, Grow BIG
              </h1>
              <p class="ud-hero-desc">
                LASKAR PLN sebagai salah satu Serikat Pekerja di PLN yang Modern, Mandiri dan Berintegritas
                mengajak segenap pegawai PLN untuk bergabung bersama kami dalam keluarga besar Serikat Pekerja LASKAR PLN.
              </p>
              <ul class="ud-hero-buttons">
                <li>
                  <a href="{{url('register_members')}}" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-white-btn">
                    Mari Bergabung dengan Kami
                  </a>
                </li>
                
              </ul>
            </div>
            <!-- <div
              class="ud-hero-brands-wrapper wow fadeInUp"
              data-wow-delay=".3s"
            >
              <img src="assets/images/hero/brand.svg" alt="brand" />
            </div> -->
            <div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
              <!-- <img src="assets/images/hero/hero-image.svg" alt="hero-image" /> -->
              <img
                src="{{ asset('landing/images/hero/dotted-shape.svg') }}"
                alt="shape"
                class="shape shape-1"
              />
              <img
                src="{{ asset('landing/images/hero/dotted-shape.svg') }}"
                alt="shape"
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">Visi & Misi</span>
              <h2>Visi Laskar PLN</h2>
              <p>
                Menjadi Role model organisasi karyawan yang profesional,
                mandiri, dan berintegitas untuk menjaga keutuhan pengelolaan
                sistem ketenagalistrikan sebagai aset bangsa demi persatuan
                Negara Kesatuan Republik Indonesi dan kemakmuran rakyat 
                Indonesia dengan mengedepankan keseimbangan peningkatan
                kinerja perushaan dan kesejahteraan anggotanya
              </p>
              <!-- <a href="javascript:void(0)" class="ud-main-btn">Learn More</a> -->
            </div>
          </div>
          <div class="ud-about-image">
            <img src="{{ ('landing/images/about/about-image.svg') }}" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Features Start ====== -->
    <section id="features" class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>Visi & Misi</span>
              <h2>Misi Laskar PLN</h2>
              <!-- <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-feature-icon">
                <i class="lni lni-users"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Membangun organisasi yang professional</h3>
                <p class="ud-feature-desc">
                  dengan pengurus yang berintegritas
                </p>
                
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-feature-icon">
                <i class="lni lni-graph"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Memiliki program kerja yang SMART</h3>
                <p class="ud-feature-desc">
                  (Specific, Measurable, Achievable, Realistic, Timebound).
                </p>
                
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-feature-icon">
                <i class="lni lni-world"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Mengoptimalkan Teknologi Informasi</h3>
                <p class="ud-feature-desc">
                  dalam proses pengelolaan organisasi.
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-feature-icon">
                <i class="lni lni-magnifier"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Berperan aktif dalam mengawal, mengawasi, dan mengevaluasi kebijakan</h3>
                <p class="ud-feature-desc">
                  proses produksi perusahaan.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-feature-icon">
                <i class="lni lni-cloud-network"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Membangun jaringan kerjasama</h3>
                <p class="ud-feature-desc">
                  antar lembaga baik dari pemerintah, LSM, organisasi pekerja dan lembaga internasional.
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-feature-icon">
                <i class="lni lni-layout"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Menciptakan hubungan industrial</h3>
                <p class="ud-feature-desc">
                  yang harmonis dan produktif.
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-feature-icon">
                <i class="lni lni-customer"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Meningkatkan kesejahteraan</h3>
                <p class="ud-feature-desc">
                  anggota dan keluarganya.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== Blog Start ====== -->
      <section class="ud-blog-grids" id="news">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-section-title mx-auto text-center">
                <h2>Berita Laskar</h2>
                <p>
                    Banyak agenda dan perjuangan yang telah Laskar PLN lakukan demi kebutuhan kesejahrteraan dan improvement Anggota.
                </p>
              </div>
            </div>
          </div>
          <div class="row">
                @forelse ( $news as $berita)
                    <div class="col-lg-4 col-md-6">
                        <div class="ud-single-blog">
                            <div class="ud-blog-image">
                                <a href="{{ url('read_news', $berita->slug) }}">
                                <img src="{{count($berita->documentation) > 0 ? $berita->documentation[0]->photos : asset('images/logo_laskar.jpeg')}}" height="200px" alt="blog" />
                                </a>
                            </div>
                            <div class="ud-blog-content">
                                <span class="ud-blog-date">{{\Carbon\Carbon::parse($berita->tgl_tayang_mulai)->isoFormat('D MMMM Y')}}</span>
                                <h3 class="ud-blog-title">
                                    <a href="{{ url('read_news', $berita->slug) }}">
                                    {{ $berita->judul}}
                                    </a>
                                </h3>
                                <p class="ud-blog-desc">
                                    {!! Str::limit($berita->berita, 200, ' ...') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            
            
          </div>
        </div>
      </section>
    <!-- ====== Blog End ====== -->

    <!-- ====== FAQ Start ====== -->
    <section id="faq" class="ud-faq">
      <div class="shape">
        <img src="{{ ('landing/images/faq/shape.svg') }}" alt="shape" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <span>FAQ</span>
              <h2>Punya Pertanyaan kepada Laskar PLN? Kami Menjawab</h2>
              <p>
                Banyak sekali pertanyaan pegawai terhadap Laskar PLN, kami sudah merangkum semua pertanyaan-pertanyaan yang sering ditanyakan kepada kami.
              
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Bagaimana cara mendaftar sebagai anggota Laskar PLN?</span>
                </button>
                <div id="collapseOne" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Apa saja Pencapaian Laskar PLN hingga saat ini?</span>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Dimana Alamat Terdaftar Laskar PLN?</span>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFour"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Bagaimana Laskar Melakukan Pemilihan ketua?</span>
                </button>
                <div id="collapseFour" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFive"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Bagaimana Laskar PLN melakukan transparasi tata kelola Organisasi?</span>
                </button>
                <div id="collapseFive" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseSix"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Apakah Laskar PLN Rutin melakukan LKS Bipartit?</span>
                </button>
                <div id="collapseSix" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== FAQ End ====== -->

    <!-- ====== Testimonials Start ====== -->
    <section id="testimonials" class="ud-testimonials">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Testimonials</span>
              <h2>Apa Kata Mereka?</h2>
              <p>
                Sudah banyak dari pegawai yang bergabung dengan Laskar PLN dan menerima banyak manfaat serta keseruannya.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".1s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="{{ ('landing/images/testimonials/author-01.png') }}"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>Fullan </h4>
                  <p>Officer</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="{{ ('landing/images/testimonials/author-01.png') }}"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>Fullan </h4>
                  <p>Officer</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div
              class="ud-single-testimonial wow fadeInUp"
              data-wow-delay=".2s"
            >
              <div class="ud-testimonial-ratings">
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
                <i class="lni lni-star-filled"></i>
              </div>
              <div class="ud-testimonial-content">
                <p>
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                </p>
              </div>
              <div class="ud-testimonial-info">
                <div class="ud-testimonial-image">
                  <img
                    src="{{ ('landing/images/testimonials/author-01.png') }}"
                    alt="author"
                  />
                </div>
                <div class="ud-testimonial-meta">
                  <h4>Fullan</h4>
                  <p>Officer</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Testimonials End ====== -->

    <!-- ====== Team Start ====== -->
    <section id="team" class="ud-team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Pengurus</span>
              <h2>Pengurus Utama Laskar PLN</h2>
              <p>
                  Sesuai dengan Misi Laskar PLN, Pengurus Laskar PLN Memiliki dedikasi yang tinggi dalam berjalannya oraganisasi Serikat Pekerja yang beringtegritas.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ ('landing/images/team/team-01.png') }}" alt="team" />
                </div>

                <img
                  src="{{ ('landing/images/team/dotted-shape.svg') }}"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ ('landing/images/team/shape-2.svg') }}"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Tony Ferdinanto</h5>
                <h6>Ketua Umum Laskar PLN</h6>
              </div>
              
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                    <img src="{{ ('landing/images/team/team-02.png') }}" alt="team" />
                  </div>
  
                  <img
                    src="{{ ('landing/images/team/dotted-shape.svg') }}"
                    alt="shape"
                    class="shape shape-1"
                  />
                  <img
                    src="{{ ('landing/images/team/shape-2.svg') }}"
                    alt="shape"
                    class="shape shape-2"
                  />
              </div>
              <div class="ud-team-info">
                <h5>Arwan Sanni</h5>
                <h6>Wakil Ketua Umum Laskar PLN</h6>
              </div>
              
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                    <img src="{{ ('landing/images/team/team-03.png') }}" alt="team" />
                  </div>
  
                  <img
                    src="{{ ('landing/images/team/dotted-shape.svg') }}"
                    alt="shape"
                    class="shape shape-1"
                  />
                  <img
                    src="{{ ('landing/images/team/shape-2.svg') }}"
                    alt="shape"
                    class="shape shape-2"
                  />
              </div>
              <div class="ud-team-info">
                <h5>Rachmawaty</h5>
                <h6>Sekertaris Jendral Laskar PLN</h6>
              </div>
              
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                    <img src="{{ ('landing/images/team/team-04.png') }}" alt="team" />
                  </div>
  
                  <img
                    src="{{ ('landing/images/team/dotted-shape.svg') }}"
                    alt="shape"
                    class="shape shape-1"
                  />
                  <img
                    src="{{ ('landing/images/team/shape-2.svg') }}"
                    alt="shape"
                    class="shape shape-2"
                  />
              <div class="ud-team-info">
                <h5>Alex Triyanto</h5>
                <h6>Ketua Depatment Kesejahteraan</h6>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Team End ====== -->

    <!-- ====== Footer Start ====== -->
    <footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
      <div class="shape shape-1">
        <img src="{{ ('landing/images/footer/shape-1.svg')}}" alt="shape" />
      </div>
      <div class="shape shape-2">
        <img src="{{ ('landing/images/footer/shape-2.svg')}}" alt="shape" />
      </div>
      <div class="shape shape-3">
        <img src="{{ ('landing/images/footer/shape-3.svg')}}" alt="shape" />
      </div>
      <div class="ud-footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="ud-widget">
                <a href="index.html" class="ud-footer-logo">
                  <img src="{{ ('landing/images/logo_laskar_title.png') }}" alt="logo" />
                </a>
                <p class="ud-widget-desc">
                  LASKAR PLN sebagai salah satu Serikat Pekerja di PLN yang Modern, Mandiri dan Berintegritas
                </p>
                <ul class="ud-widget-socials">
                  <li>
                    <a href="https://www.facebook.com/LaskarPLN/?locale=id_ID">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/LASKAR_PLN">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/laskar.pln/">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.youtube.com/@laskarpln2880">
                        <i class="lni lni-youtube"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">About Us</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="#home">Home</a>
                  </li>
                  <li>
                    <a href="#about">Visi & Misi</a>
                  </li>
                  <li>
                    <a href="#faq">FAQ</a>
                  </li>
                  <li>
                    <a href="#testimonials">Testimonial</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Features</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">How it works</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Privacy policy</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Terms of service</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Refund policy</a>
                  </li>
                </ul>
              </div>
            </div> -->
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Laskar Products</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a
                      href="#"
                      rel="nofollow noopner"
                      target="_blank"
                      >Laskar Shop
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://laskarpln.id/register_members"
                      rel="nofollow noopner"
                      target="_blank"
                      >Registrasti Anggota</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      rel="nofollow noopner"
                      target="_blank"
                      >Laskar Attendance</a
                    >
                  </li>
                  <li>
                    <a
                      href="#"
                      rel="nofollow noopner"
                      target="_blank"
                      >Laskar E-Vote</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </footer>
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/js/wow.min.js') }}"></script>
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <script>
      // ==== for menu scroll
      const pageLink = document.querySelectorAll(".ud-menu-scroll");

      pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
          e.preventDefault();
          document.querySelector(elem.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            offsetTop: 1 - 60,
          });
        });
      });

      // section menu active
      function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
          window.pageYOffset ||
          document.documentElement.scrollTop ||
          document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
          const currLink = sections[i];
          const val = currLink.getAttribute("href");
          const refElement = document.querySelector(val);
          const scrollTopMinus = scrollPos + 73;
          if (
            refElement.offsetTop <= scrollTopMinus &&
            refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
          ) {
            document
              .querySelector(".ud-menu-scroll")
              .classList.remove("active");
            currLink.classList.add("active");
          } else {
            currLink.classList.remove("active");
          }
        }
      }

      window.document.addEventListener("scroll", onScroll);
    </script>
  </body>
</html>
