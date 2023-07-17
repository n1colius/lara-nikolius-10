@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_php_sess_dynamodb') }}">PHP Session with AWS DynamoDB</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Video sharing untuk menyimpan PHP Session diluar dari server tempat script php berjalan, tetapi di simpan di luar, dalam video ini memakai AWS DynamoDB (Database NoSQL)</p>

				<iframe width="1024" height="600" src="https://www.youtube.com/embed/jaXsX7dexr8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection