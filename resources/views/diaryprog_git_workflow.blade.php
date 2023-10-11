@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_git_workflow') }}">SHARING GIT WORKFLOW</a></h2>
        	<br><br><br>

        	<div class="mb-3">
                <p>Pada video kali ini saya mau coba sharing Git Workflow yang pernah saya implementasikan ketik saya dan team melakukan development web application dari terdiri dari sekitar 5 developer.</p>

                <iframe width="1024" height="600" src="https://www.youtube.com/embed/t4yZYHE7Z7w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection