@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h3>Fun Projects</h3>
        	<br><br><br>

        	<div class="container">
        		<div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">

        			<div class="col">
        				<div class="card" style="border:none;">
        					<img src="{{url('/')}}/assets/img/logodota.jpg" class="card-img-top" style="width:150px;height:125px;">
        					<div class="card-body">
        						<h5 class="card-title"><a href="{{ route('dotahero') }}">Dota 2 Heroes</a></h5>
        					</div>
        				</div>
        			</div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/logo-dota-putih.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('dota_analysis') }}">Dota 2 Match Analysis</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/dota3.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('dota_winrate_chart') }}">Dota 2 Hero Winrate Chart</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/idx-logo.jpg" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('saham_main') }}">Simple Emitmen Chart</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/ocr.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('ektp_extract') }}">Ekstrak Data dari File Gambar E-KTP</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/docker-logo.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('docker_web') }}">Setup Web Development environment with Docker</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/uuid.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('pengenalan_uuid') }}">Pengenalan UUID</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/datavisual.png" class="card-img-top" style="width:150px;height:125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('data_sekolah') }}">Data Visualization - Data Sekolah di Indonesia</a></h5>
                            </div>
                        </div>
                    </div>


        		</div>
        	</div>

        </div>
    </section>
</div>

@endsection