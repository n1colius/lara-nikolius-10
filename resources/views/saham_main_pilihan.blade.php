@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('saham_main') }}">Simple Emitmen Chart</a></h2>
        	<br><br><br>

        	<form method="POST" action="{{ route('saham_main_pilihan_form_proc') }}">
				@csrf

				@if (Session::has('error_msg'))
                    <div class="alert alert-danger">
                        {{ Session::get('error_msg') }}
                    </div>
                @endif

				<div class="mb-3">
				 	<label for="exampleFormControlInput1" class="form-label">Kode Emitmen/Saham</label>
				 	<input style="width:100px;" onchange="updatelink();" type="text" class="form-control" name="EmitmenCode" id="FormEmitmenCode" value="" required minlength="4" maxlength="4" />
				</div>

				<div class="mb-3">
				 	<label for="exampleFormControlInput1" class="form-label">Range data dari berapa hari yg lalu</label>
				 	<input style="width:175px;" onchange="updatelink();" type="number" class="form-control" name="JumlahHari" id="FormJumlahHari" value="" placeholder="Jumlah Hari" required />
				</div>

				<br><br>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary mb-3">Display Chart</button>
				</div>

			</form>

        </div>
    </section>
</div>

@endsection