@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('saham_main') }}">Simple Emitmen Chart</a></h2>
        	<br><br><br>

        	<form method="POST" action="{{ route('saham_main_form_proc') }}" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
				 	<label for="exampleFormControlInput1" class="form-label">Kode Emitmen/Saham</label>
				 	<input style="width:100px;" onchange="updatelink();" type="text" class="form-control" name="EmitmenCode" id="FormEmitmenCode" value="" required minlength="4" maxlength="4" />
				</div>

				<div class="mb-3">
				 	<label for="exampleFormControlInput1" class="form-label">Range data dari berapa hari yg lalu</label>
				 	<input style="width:175px;" onchange="updatelink();" type="number" class="form-control" name="JumlahHari" id="FormJumlahHari" value="" placeholder="Jumlah Hari" required />
				</div>

				<div class="mb-3">
					<a href="#invalid" id="FormLinkDownload" onclick="linkDownload(event);" target="_blank">Link Download data saham dari website idx.co.id</a>
					<br>Klik link diatas dan save halamannya dalam format .json
				</div>

				<div class="mb-3">
					<label for="FormFileJson" class="form-label">File .json hasil dowload link diatas</label>
					<input type="file" required name="FileJson" id="FormFileJson" placeholder="Masukkan file json disini" />
				</div>


				<br><br>
				<div class="col-auto">
					<button type="submit" class="btn btn-primary mb-3">Display Chart</button>
				</div>
			</form>

        </div>
    </section>
</div>

<script type="text/javascript">
function updatelink() {
	let EmitmenCode = document.getElementById('FormEmitmenCode').value;
	let JumlahHari = parseInt(document.getElementById('FormJumlahHari').value);
	let objLink = document.querySelector("#FormLinkDownload");

	if(EmitmenCode != "" && !isNaN(JumlahHari)) {
		objLink.setAttribute("href", "https://idx.co.id/primary/ListedCompany/GetTradingInfoSS?code="+EmitmenCode+"&start=0&length="+JumlahHari);
	} else {
		objLink.setAttribute("href", "#invalid");
	}
}

function linkDownload(e) {
	let objLink = document.querySelector("#FormLinkDownload");
	if(objLink.getAttribute("href") == "#invalid") {
		e.preventDefault();
		Swal.fire(
		  	'Information',
		  	'Kode Saham atau Jumlah hari masih belum diisi',
			'info'
		);
		return false;
	}
}
</script>

@endsection