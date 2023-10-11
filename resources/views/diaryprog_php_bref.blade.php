@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_php_bref') }}">PHP pada AWS Lambda - PHP Bref</a></h2>
        	<br><br><br>

        	<div class="mb-3">
                <p>Video ini saya mau share tentang penggunaan script PHP di AWS Lambda dengan PHP Bref.</p>

                <iframe width="1024" height="600" src="https://www.youtube.com/embed/a2k9Z9488wQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection