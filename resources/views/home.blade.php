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
                            <a class="social-icon" href="https://www.linkedin.com/in/niko-lius-3138475b" target="_blank"><i class="fab fa-linkedin-in"></i></a>
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



    <!--
    <section class="resume-section" id="experience">
        <div class="resume-section-content">
            <h2 class="mb-5">Experience</h2>
           
            <div class="row row-cols-md-3 row-cols-md-3 row-cols-md-3 g-4 py-5">
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">CV Jogjashop - Web Developer (Yogyakarta)</h4>
                        <h6 class="fw-bold mb-0">Nov 2008 - Nov 2009</h6>
                        <p class="mt-2" style="font-size:13px;">Bekerja sebagai Web Programmer di CV Jogjashop yang kebanyakan menerima klien pembuatan website profile, toko online, dan website MLM. Teknologi yang digunakan masih menggunakan native PHP dan MySql</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">PT Gamatechno - Academic System Web Developer (Yogyakarta)</h4>
                        <h6 class="fw-bold mb-0">Nov 2009 - Juli 2012</h6>
                        <p class="mt-2" style="font-size:13px;">Bekerja sebagai Developer aplikasi akademis yang berhubungan dari Penerimaan Mahasiswa Baru, Proses Registrasi, Manajemen Mahasiswa, sampai dengan pengolahan Data Alumni. Teknologi yang digunakan PHP dan MySQL dengan Framework GTFW (Gamatechno Framework)</p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">Toko Hawaii Sports - Manajer Toko (Denpasar)</h4>
                        <h6 class="fw-bold mb-0">Juli 2012 - Okt 2013</h6>
                        <p class="mt-2" style="font-size:13px;">
                            Bekerja sebagai manager toko baju olahraga "Hawaii Sport" di Denpasar, Bali. Deskripsi pekerjaannya
                            <ul>
                                <li style="font-size:13px;">Manage Stock</li>
                                <li style="font-size:13px;">Melakukan Order Barang</li>
                                <li style="font-size:13px;">Melakukan Penjualan</li>
                                <li style="font-size:13px;">Order Baju Custom</li>
                                <li style="font-size:13px;">Control Pemasukan dan Pengeluaran Toko</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">PT Gamatechno - Academic System Web Developer (Yogyakarta)</h4>
                        <h6 class="fw-bold mb-0">Okt 2013 - Feb 2016</h6>
                        <p class="mt-2" style="font-size:13px;">
                            Kembali bekerja di PT Gamatechno secara full time sampai September 2014 dan sebagai outsource dari September 2014 - February 2016
                        </p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">Toko Bahan Kue dan Plastik Megasari - Owner (Yogyakarta)</h4>
                        <h6 class="fw-bold mb-0">Sep 2014 - Jan 2015</h6>
                        <p class="mt-2" style="font-size:13px;">
                            Membuka Toko Bahan Kue dan Plastik Megasari. Job Deskripsi sebagai berikut :
                            <ul>
                                <li style="font-size:13px;">Manage Stock</li>
                                <li style="font-size:13px;">Melakukan Order Barang</li>
                                <li style="font-size:13px;">Melakukan Penjualan</li>
                                <li style="font-size:13px;">Control Pemasukan dan Pengeluaran Toko</li>
                            </ul>
                        </p>
                    </div>
                </div>
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">CV Reliance - Freelance Web Developer (Yogyakarta)</h4>
                        <h6 class="fw-bold mb-0">Sep 2014 - Feb 2016</h6>
                        <p class="mt-2" style="font-size:13px;">Bekerja sebagai freelance developer di CV Reliance yang mempunyai Produk Point of Sales untuk beberapa Toko Besi dan Bahan bangungan yang ada di Yogyakarta.</p>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-12 g-4 py-5">
                <div class="col d-flex align-items-start">
                    <i class="bi-pin-angle" style="font-size: 2rem; color: cornflowerblue;"></i>&nbsp;&nbsp;&nbsp;
                    <div>
                        <h4 class="fw-bold mb-0">PT Koltiva - Team Leader dan Senior Web Developer (Jakarta)</h4>
                        <h6 class="fw-bold mb-0">Mar 2016 - Sampai saat ini</h6>
                        <p class="mt-2" style="font-size:13px;">Bekerja sebagai seorang Team Leader dan Senior Web Developer pada Team Web Development (Divisi: General). Bertanggung jawab dalam development dan memimpin team untuk proyek aplikasi Commodity based Management Platforms (Cocoa, Palmoil, Coffee, Rubber, etc)</p>
                    </div>
                </div>
            </div>

       </div>
    </section>
    <hr class="m-0" />

    <section class="resume-section" id="education">
        <div class="resume-section-content">
           <h2 class="mb-5">Education & Skills</h2>
           <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
               <div class="flex-grow-1">
                   <h3 class="mb-0">Universitas Kristen Duta Wacana</h3>
                   <div class="subheading mb-3">S1 - Sarjana Komputer</div>
                   <div>Fakultas Teknik - Teknik Informatika</div>
                   <p>GPA: 3.07</p>
               </div>
               <div class="flex-shrink-0"><span class="text-primary">August 2002 - November 2008</span></div>
           </div>

            <br>

            <h2 class="mb-3">Industry Knowledge</h2>
            <div class="container" style="margin-top:-5px;">
                <span class="badge-besar bg-primary">Web Development</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">E-Commerce</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">Object-Oriented Programming (OOP</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">System Analyst</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">Database Design</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">RDBMS</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">Inventory System</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-primary">Data Reporting</span>
            </div>


            <h2 class="mb-3 mt-5">Skills</h2>
            <div class="container" style="margin-top:-5px;">
                <span class="badge-besar bg-success">PHP</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">MySQL</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">JavaScript</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">CSS</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">CSS Bootstrap</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Bulma</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">HTML</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">CodeIgniter</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Laravel</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Linux</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Apache Web Server / Nginx</span>
            </div>
            <div class="container mt-3">
                <span class="badge-besar bg-success">GIT / SVN</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">API RESTful Webservices</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Node.js</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Express.js</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Nuxt.js</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">ExtJs</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">Vue.js</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">jQuery</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">AWS S3</span>&nbsp;&nbsp;&nbsp;<span class="badge-besar bg-success">AWS Cognito</span>
            </div>            
           

        </div>
    </section>
    <hr class="m-0" />
    -->

</div>

@endsection