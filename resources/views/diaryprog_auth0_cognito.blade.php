@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_auth0_cognito') }}">Auth0 dan AWS Cognito</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Video kali ini saya akan coba sharing untuk pembelajaran saya terkait auth0 dan AWS Cognito dan juga untuk Federated Identity di Cogito menggunakan auth0. Semoga video ini bisa berguna menambah wawasan.</p>

				<iframe width="1024" height="600" src="https://www.youtube.com/embed/5muaBqQ4E1E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection