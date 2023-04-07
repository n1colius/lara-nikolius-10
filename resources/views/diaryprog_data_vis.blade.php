@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('diaryprog_data_vis') }}">Data Visualization dengan ChartJS dan Google Maps API</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<p>Lewat video ini saya akan coba share bagaimana cara saya memvisualisasikan data sekolah dari yang source nya berbentuk .csv. Data akan ditampilkan dalam bentuk dashlet, pie chart, bar chart dan visual koordinat nya di peta Google Maps.</p>

				<iframe width="1024" height="600" src="https://www.youtube.com/embed/nNvKQf-CLgY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        	</div>

        </div>
    </section>
</div>

@endsection