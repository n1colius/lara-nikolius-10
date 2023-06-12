@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_aws_serverless') }}">Web Push Notification dengan AWS Serverless (S3, API Gateway, Lambda dan DynamoDB) </a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Di video #DiaryProgrammer kali ini, saya akan coba share hasil belajar or RnD saya setelah mengambil course tentang AWS Serverless. Jadi karena ini adalah project untuk belajar or RnD (Research and Development), tentunya yang saya share ini mungkin bukan merupakan solusi yang optimal atau efektif untuk environement Production. Tujuan nya adalah hanya untuk semua edukasi saja dan juga sebagai dokumentasi saya pribadi.</p>

                <p>Project RnD kali ini saya mencoba membuat sebuah service simpel untuk melayani fitur berupa Web Push Notifications (Notification di level browser or OS). Saya yakin kita semua sudah banyak bersentuhan or mendapatkan Notification ini ketika kita browsing2 di internet.</p>

                <p>Untuk AWS Service yang akan saya gunakan di video ini adalah AWS S3 untuk hosting web statis nya, AWS API Gateway sebagai jembatan untuk menghubungkan ke fungsi AWS Lambda, dan untuk datanya saya mencoba memakai database AWS DynamoDB (DB NoSQL). Semoga video ini berguna atau bisa menambah knowledge</p>

				<iframe width="1024" height="600" src="https://www.youtube.com/embed/F6gkzkZytAY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection