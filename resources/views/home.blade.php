@extends('layouts.default')
@section('content')
   
<div class="container-fluid p-0">
    <!-- About-->
    <section class="resume-section" id="about">
        <div class="resume-section-content">
            <h1 class="mb-0">Nikolius <span class="text-primary">Lau</span></h1>
            <div class="subheading mb-5">
               Gading Serpong, Tangerang Selatan (+62) 856-4394-1909 ·
               <a href="mailto:n1colius.lau@gmail.com">n1colius.lau@gmail.com</a>
            </div>
            <p class="lead mb-5">Web Developer dengan pengalaman lebih dari <strong>10 tahun</strong> dengan pendidikan Sarjana Komputer dari Universitas Kristen Duta Wacana. Fokus dalam pengembangan <strong>Aplikasi Sistem Informasi</strong> berbasis <strong>Web</strong> yang bisa menghasilkan laporan yang berguna untuk pertimbangan dalam pengambilan keputusan dalam suatu bisnis</p>

            <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        <a target="_blank" href="{{ route('cv') }}" class="btn btn-primary btn-mycv"><span>Curriculum Vitae</span></a>
                    </div>
                    <div class="col">
                        <div class="social-icons">
                            <a class="social-icon" href="https://www.linkedin.com/in/nikolius-lau/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="social-icon" href="https://github.com/n1colius" target="_blank"><i class="fab fa-github"></i></a>
                            <a class="social-icon" href="https://twitter.com/n1colius" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="social-icon" href="https://www.facebook.com/nikolius" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <hr class="m-0" />

</div>

@endsection