@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('docker_web') }}">Setup Web Development environment with Docker</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Lewat video ini saya coba share setup environment di localhost untuk web development dengan stack Apache, PHP dan MySQL menggunakan Apache Virtual Host di Windows 11. Keuntungan dengan development dengan docker ini adalah anda bisa lebih mensetup aplikasi anda agar mirip dengan config di server dan bisa dengan mudah menshare ke sesama developer lain untuk bisa menggunakan environment development yg sama semua.</p>

        		<iframe width="1024" height="600" src="https://www.youtube.com/embed/F4Ohforpkxw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        	</div>

        </div>
    </section>
</div>