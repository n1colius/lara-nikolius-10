@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_switch_to_aws') }}">Pengalaman switch hosting dari Digital Ocean ke AWS</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Saya berencana untuk membuat video series #DiaryProgrammer yang akan berisi sharing dari saya pribadi saat saya lagi belajar suatu hal-hal yang baru. Format video akan berupa saya menjelaskan step2 yg saya lakukan untuk pembelajaran saya, sambil saya share screen untuk kasih gambaran. Jadi mungkin saya tidak akan share sampai secara sangat mendetail ya. Video ini juga berfungsi sebagai dokumentasi pribadi saya sebagai catatan, jadi bisa saya kunjungi ulang jika ada yang lupa or saya butuhkan di kedepannya. Karena ini masih proses belajar, jadi sangat besar kemungkinan atas apa yg saya share ini mungkin akan kurang optimal or ada yang salah malahan, jadi jangan sungkan2 untuk kasih feedback or komentar. Dengan dibuat video series ini juga secara tidak langsung mendorong saya secara pribadi untuk bisa terus belajar or mendalami sesuatu pengetahuan yang baru.</p>

				<p>Untuk Video Pertama ini saya akan coba share step by step yang saya lakukan ketika saya mau pindah hosting untuk web pribadi saya yang sebelumnya di hosting di Digital Ocean ke AWS. Alasan saya pindah ke AWS karena pengen belajar banyak services-services nya AWS dan juga ternyata untuk biaya nya sendiri lebih murah dibandingkan Digital Ocean.</p>

				<iframe width="1024" height="600" src="https://www.youtube.com/embed/v4w60bL3iqc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection