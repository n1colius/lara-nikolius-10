@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('dotahero') }}">Dota 2  Heroes</a></h2>
        	<br><br><br>

        	<!-- SearchBox Section -->
        	<div class="container-fluid">
        	    <div class="row">
        	        <div class="col">
        	        	<select id="cmbhero" multiple>
        	        		<option data-placeholder="true"></option>
        				  	@if(count($cmb_hero)>0)
        	                	@foreach($cmb_hero as $key=>$item)
        	                		<option value="{{ $item->id }}">{{ $item->label }}</option>		
        	                	@endforeach
        	                @endif
        	        	</select>
        	        </div>
        	        <div class="col">
        	        	<button 
        	        		class="btn btn-primary btn-search" 
        	        		type="button"
        	        		id="BtnSearch"
        	        	><i class="fa fa-search fa-fw"></i> Search</button>
        	        </div>
        	    </div>
        	</div>
        	<br><br><br><br>
        	<!-- SearchBox Section -->

        	<div class="container-fluid">
        	    <div class="row">
        	        <div class="col">
        	        	
        	        	<h4>Strengh Heroes</h4>

    				  	@if(count($data_hero_str)>0)
    	                	@foreach($data_hero_str as $key=>$item)

		        	        	<div class="card">
		        	        	  	<div class="card-body">

		        	        	  		<div class="d-flex justify-content-between">
		        	        	  			<div><img src="{{ $item->Picture }}" ></div>

		        	        	  			<div style="margin-left:13px;">
		        	        	  				<h5 class="card-title">{{ $item->HeroName }}</h5>
		        	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $item->AttackType }}</div>
		        	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $item->HeroRoles }}</div>
		        	        	  			</div>
		        	        	  		</div>

			        	        	    <p class="card-text">
			        	        	    	<h5>Notes</h5>	
			        	        	    	<ul class="notes-list">
			        	        	    		@php
			        	        	    			$ArrNotes = array();
			        	        	    			$ArrNotes = explode('@@',$item->HeroNotes);
			        	        	    		@endphp
		                						@if($ArrNotes[0] != "")
		                							@foreach($ArrNotes as $key=>$notes)
			                							<li>{{ $notes }}</li>
	                								@endforeach
	                							@else
	                							    <li style="color:red;">No notes</li>
	                							@endif
			        	        	    	</ul>
			        	        	    </p>

		        	        	  	</div>
		        	        	</div>

	                		@endforeach
	                	@endif

        	        </div>

        	        <div class="col">
        	            
        	            <h4>Agility Heroes</h4>

        	        	@if(count($data_hero_agi)>0)
    	                	@foreach($data_hero_agi as $key=>$item)

		        	        	<div class="card">
		        	        	  	<div class="card-body">

		        	        	  		<div class="d-flex justify-content-between">
		        	        	  			<div><img src="{{ $item->Picture }}" ></div>

		        	        	  			<div style="margin-left:13px;">
		        	        	  				<h5 class="card-title">{{ $item->HeroName }}</h5>
		        	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $item->AttackType }}</div>
		        	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $item->HeroRoles }}</div>
		        	        	  			</div>
		        	        	  		</div>

			        	        	    <p class="card-text">
			        	        	    	<h5>Notes</h5>	
			        	        	    	<ul class="notes-list">
			        	        	    		@php
			        	        	    			$ArrNotes = array();
			        	        	    			$ArrNotes = explode('@@',$item->HeroNotes);
			        	        	    		@endphp
		                						@if($ArrNotes[0] != "")
		                							@foreach($ArrNotes as $key=>$notes)
			                							<li>{{ $notes }}</li>
	                								@endforeach
	                							@else
	                							    <li style="color:red;">No notes</li>
	                							@endif
			        	        	    	</ul>
			        	        	    </p>

		        	        	  	</div>
		        	        	</div>

	                		@endforeach
	                	@endif

        	        </div>

        	        <div class="col">
        	            
        	            <h4>Intelligence Heroes</h4>

			        	@if(count($data_hero_int)>0)
    	                	@foreach($data_hero_int as $key=>$item)

		        	        	<div class="card">
		        	        	  	<div class="card-body">

		        	        	  		<div class="d-flex justify-content-between">
		        	        	  			<div><img src="{{ $item->Picture }}" ></div>

		        	        	  			<div style="margin-left:13px;">
		        	        	  				<h5 class="card-title">{{ $item->HeroName }}</h5>
		        	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $item->AttackType }}</div>
		        	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $item->HeroRoles }}</div>
		        	        	  			</div>
		        	        	  		</div>

			        	        	    <p class="card-text">
			        	        	    	<h5>Notes</h5>	
			        	        	    	<ul class="notes-list">
			        	        	    		@php
			        	        	    			$ArrNotes = array();
			        	        	    			$ArrNotes = explode('@@',$item->HeroNotes);
			        	        	    		@endphp
		                						@if($ArrNotes[0] != "")
		                							@foreach($ArrNotes as $key=>$notes)
			                							<li>{{ $notes }}</li>
	                								@endforeach
	                							@else
	                							    <li style="color:red;">No notes</li>
	                							@endif
			        	        	    	</ul>
			        	        	    </p>

		        	        	  	</div>
		        	        	</div>

	                		@endforeach
	                	@endif

			        </div>
        	    </div>
        	</div>

        </div>
    </section>
</div>

<script type="text/javascript">
let filterhero = new SlimSelect({
	placeholder: 'Filter Heroes',
	select: '#cmbhero',
	hideSelectedOption: true,
	closeOnSelect: false
});

let strfilterhero = '{{ $filtersearch }}';
if(strfilterhero != '') filterhero.set(strfilterhero.split(','));

document.getElementById("BtnSearch").onclick = function(){
	let arrfilter = filterhero.selected();
	if(arrfilter.length > 0) {
		let urlsearch = '/dotahero?search='+arrfilter.join(',');
		window.location.href = "{{ url('/')}}"+urlsearch;
	} else {
		Swal.fire(
		  	'Information',
		  	'Filter is empty',
			'info'
		);
	}
};
</script>

@endsection