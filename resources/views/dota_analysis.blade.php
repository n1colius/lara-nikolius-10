@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('dota_analysis') }}">Dota 2 Match Analysis</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<label for="exampleFormControlInput1" class="form-label"><strong>Radiant Heroes</strong></label>
        		<select id="cmb-radiant-hero" multiple>
	        		<option data-placeholder="true"></option>
				  	@if(count($cmb_hero)>0)
	                	@foreach($cmb_hero as $key=>$item)
	                		<option value="{{ $item->id }}">{{ $item->label }}</option>		
	                	@endforeach
	                @endif
	        	</select>
        	</div>

        	<div class="mb-3 mt-3">
        		<label for="exampleFormControlInput1" class="form-label"><strong>Dire Heroes</strong></label>
        		<select id="cmb-dire-hero" multiple>
	        		<option data-placeholder="true"></option>
				  	@if(count($cmb_hero)>0)
	                	@foreach($cmb_hero as $key=>$item)
	                		<option value="{{ $item->id }}">{{ $item->label }}</option>		
	                	@endforeach
	                @endif
	        	</select>
        	</div>

        	<div class="mb-3 mt-4">
        		<button 
        			class="btn btn-primary btn-search" 
        			type="button"
        			id="BtnAnalyze"
        		><i class="bi bi-clipboard-data"></i>&nbsp;&nbsp;Analyze</button>
        		<br>
        		<p><span style="color:red;">*</span> Data is based on Competitive matches. Crawl manually from DotaAPI. Source data will be updated periodically depends on i'm busy or not i guess.</span>
        	</div>

        </div>
    </section>
</div>

<script type="text/javascript">
let radiant_hero = new SlimSelect({
	placeholder: 'Select Radiant Heroes',
	select: '#cmb-radiant-hero',
	hideSelectedOption: true,
	closeOnSelect: false
});

let dire_hero = new SlimSelect({
	placeholder: 'Select Dire Heroes',
	select: '#cmb-dire-hero',
	hideSelectedOption: true,
	closeOnSelect: false
});

document.getElementById("BtnAnalyze").onclick = function() {
	//Validasi
	let is_valid = true;
	let val_radiant_hero = radiant_hero.selected();
	let val_dire_hero = dire_hero.selected();
	let val_radiant_dire_hero = val_radiant_hero.concat(val_dire_hero); //array merge

	if(val_radiant_hero.length != 5) {
		is_valid = false;
	}

	if(val_dire_hero.length != 5) {
		is_valid = false;
	}

	if(checkForDuplicates(val_radiant_dire_hero)) is_valid = false;

	if(is_valid == true) {

		let urlsearch = '/dota_analysis_result?radiant_hero='+val_radiant_hero.join(',')+'&dire_hero='+val_dire_hero.join(',');
		window.location.href = "{{ url('/')}}"+urlsearch;

	} else {
		Swal.fire(
		  	'Information',
		  	"You must select 5 radiant dan 5 dire heroes that doesn't duplicate",
			'info'
		);
	}

};
</script>

@endsection