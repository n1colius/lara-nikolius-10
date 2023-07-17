@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h3>Diary Programmer</h3>
        	<br><br><br>

        	<div class="container">
        		<div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">

        			<div class="col">
        				<div class="card" style="border:none;">
        					<img src="{{url('/')}}/assets/img/lightsail.jpg" class="card-img-top" style="width:150px;height: 125px;">
        					<div class="card-body">
        						<h5 class="card-title"><a href="{{ route('diaryprog_switch_to_aws') }}">Pengalaman switch hosting dari Digital Ocean ke AWS</a></h5>
        					</div>
        				</div>
        			</div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/chartjs.jpg" class="card-img-top" style="width:150px;height: 125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('diaryprog_data_vis') }}">Data Visualization dengan ChartJS dan Google Maps API</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/serverless.png" class="card-img-top" style="width:150px;height: 125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('diaryprog_aws_serverless') }}">Web Push Notification dengan AWS Serverless (S3, API Gateway, Lambda dan DynamoDB) </a></h5>
                            </div>
                        </div>
                    </div>

        		</div>

                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/phpsess.jpg" class="card-img-top" style="width:150px;height: 125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('diaryprog_php_sess_dynamodb') }}">PHP Session with AWS DynamoDB</a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" style="border:none;">
                            <img src="{{url('/')}}/assets/img/auth0cognito.jpg" class="card-img-top" style="width:150px;height: 125px;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ route('diaryprog_auth0_cognito') }}">Auth0 dan AWS Cognito</a></h5>
                            </div>
                        </div>
                    </div>

                </div>
        	</div>

        </div>
    </section>
</div>

@endsection