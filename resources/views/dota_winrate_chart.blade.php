@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('dota_winrate_chart') }}">Dota 2 Winrate Chart</a></h2>
        	<br><br><br>

        	<div class="mb-3">
        		<label for="exampleFormControlInput1" class="form-label"><strong>Select Heroes</strong></label>
        		<select id="cmb-hero">
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
        			id="BtnDisplayChart"
        		><i class="bi bi-clipboard-data"></i>&nbsp;&nbsp;Display Chart</button>
        		<br>
        		<p><span style="color:red;">*</span> Data is based on Competitive matches. Crawl manually from DotaAPI. Source data will be updated periodically depends on i'm busy or not i guess.</span>
        	</div>

        </div>
    </section>
</div>

<script type="text/javascript">
let cmb_hero = new SlimSelect({
	placeholder: 'Select Heroes',
	select: '#cmb-hero',
	hideSelectedOption: true
});

document.getElementById("BtnDisplayChart").onclick = function() {
	let sel_hero = cmb_hero.selected();

	if(sel_hero != "") {
		let urlsearch = '/dota_winrate_chart_display?sel_hero='+sel_hero;
		window.location.href = "{{ url('/')}}"+urlsearch;
	} else {
		Swal.fire(
		  	'Information',
		  	"No hero selected",
			'info'
		);
	}
};
</script>

@endsection