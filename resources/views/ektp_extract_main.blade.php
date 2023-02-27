@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('ektp_extract') }}">Ekstrak Data dari File Gambar E-KTP</a></h2>
        	<br><br><br>

        	<form method="POST" action="{{ route('ektp_extract_form_proc') }}" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
					<label for="FormFileJson" class="form-label">Masukkan file gambar E-KTP (.jpg or .jpeg, maksimal size: 500 KB)</label>
					<input type="file" required name="FileProc" id="FormFileProc" />
					<label style="font-weight: bold;color:green;">* Website ini tidak menyimpan file E-KTP yg dimasukkan, file akan terhapus langsung.<br>Untuk Extract Data Text dari Images yg dimasukkan ini menggunakan Google Cloud Vision API</label>
				</div>

				<div class="col-auto">
					<button type="submit" class="btn btn-primary mb-3">Extract Data</button>
				</div>
			</form>

			<div style="height:50px;">&nbsp;</div>

			@if ($isPost === true)
				
				@if ($ArrValidasi['ValidasiProses'] === false)

					<div class="mb-3">
						<label style="font-weight: bold;color:red;">{!! $ArrValidasi['ValidasiMsg'] !!}</label>
					</div>

				@else

					<div class="container">
					 	<div class="row">
					    	<div class="col-6">
								<img src="data:image/{{ $imageextension }};base64,{{ $imagebase64 }}" class="img-thumbnail" style="width:550px;" />
					    	</div>
					    	<div class="col-6">
					    		
					    		<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Provinsi</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Provinsi'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">NIK</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7">
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['KTP'] }}</label>
								  	</div>
								</div>
					    		<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Nama</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7">
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Nama'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Gender</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Gender'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Tempat dan Tanggal Lahir</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Ttl'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Agama</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Agama'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Status Nikah</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['StatusNikah'] }}</label>
								  	</div>
								</div>
								<div class="row">
									<div class="col">
								    	<label style="font-weight: bold;color:#3b5978;">Pekerjaan</label>
								  	</div>
								  	<div class="col-sm-1">:</div>
								  	<div class="col-sm-7" >
								    	<label style="font-weight: bold;color:#3b5978;">{{ $ArrDataExtract['Pekerjaan'] }}</label>
								  	</div>
								</div>

					    	</div>
					    </div>
					</div>

					

				@endif

			@endif

        </div>
    </section>
</div>

@endsection