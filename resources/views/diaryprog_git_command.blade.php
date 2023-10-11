@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_git_command') }}">PERINTAH GIT YANG SERING SAYA PAKAI</a></h2>
        	<br><br><br>

        	<div class="mb-3">
                <p>Di video ini saya akan coba share beberapa perintah git yang sering saya pakai dan juga cara-cara saya menghandle beberapa problem yang muncul sekitar git.</p>

                <iframe width="1024" height="600" src="https://www.youtube.com/embed/RRGwVvn_yow" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection