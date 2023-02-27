@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('dota_analysis') }}">Dota 2 Match Analysis</a></h2>
        	<br><br><br>

        	<h4 style="margin-top:20px;">Radiant Heroes</h4>
        	<p>Role Summary:
        		@if(count($InfoHeroRolesRadiant)>0)
        			<div class="container">
        		    	<div class="row">
	        			@foreach($InfoHeroRolesRadiant as $key=>$item)
	        				<div class="col-12 col-md-2 HeroRolesBadges">
	        					<button type="button" class="btn btn-primary btn-sm">
	        						{{$item->Roles}} <span class="badge bg-light text-dark">{{$item->CountRoles}}</span>
	        					</button>
	        				</div>	
	        			@endforeach
	        			</div>
	        		</div>
        		@endif
        	</p>

        	<div class="container-fluid">
        	    <div class="row">

        	        <div class="col">

        	        	<div class="card">
        	        	  	<div class="card-body">

        	        	  		<div class="d-flex justify-content-between">
        	        	  			<div><img src="{{ $ReturnRadiant1[0]['Picture'] }}" ></div>

        	        	  			<div style="margin-left:13px;">
        	        	  				<h5 class="card-title">{{ $ReturnRadiant1[0]['Hero'] }}</h5>
        	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnRadiant1[0]['AttackType'] }}</div>
        	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnRadiant1[0]['Roles'] }}</div>
        	        	  			</div>
        	        	  		</div>

        	        	  		<p class="card-text">
        	        	  			<h5>Winrate</h5>	
        	        	  			<ul class="notes-list">
        	        	  				<li><strong>{{ $ReturnRadiant1[0]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant1[0]['WinRate'] }}% ({{ $ReturnRadiant1[0]['TotalMatch'] }} games)</li>
        	        	  				<li><strong>{{ $ReturnRadiant1[1]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant1[1]['WinRate'] }}% ({{ $ReturnRadiant1[1]['TotalMatch'] }} games)</li>
        	        	  				<li><strong>{{ $ReturnRadiant1[2]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant1[2]['WinRate'] }}% ({{ $ReturnRadiant1[2]['TotalMatch'] }} games)</li>
        	        	  				<li><strong>{{ $ReturnRadiant1[3]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant1[3]['WinRate'] }}% ({{ $ReturnRadiant1[3]['TotalMatch'] }} games)</li>
        	        	  				<li><strong>{{ $ReturnRadiant1[4]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant1[4]['WinRate'] }}% ({{ $ReturnRadiant1[4]['TotalMatch'] }} games)</li>
        	        	  			</ul>
        	        	  		</p>

        	        	  	</div>
        	        	</div>

        	        </div>


        	        <div class="col">

        	        	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnRadiant2[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnRadiant2[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnRadiant2[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnRadiant2[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnRadiant2[0]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant2[0]['WinRate'] }}% ({{ $ReturnRadiant2[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant2[1]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant2[1]['WinRate'] }}% ({{ $ReturnRadiant2[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant2[2]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant2[2]['WinRate'] }}% ({{ $ReturnRadiant2[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant2[3]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant2[3]['WinRate'] }}% ({{ $ReturnRadiant2[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant2[4]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant2[4]['WinRate'] }}% ({{ $ReturnRadiant2[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>

        	        </div>


        	        <div class="col">

        	        	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnRadiant3[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnRadiant3[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnRadiant3[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnRadiant3[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnRadiant3[0]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant3[0]['WinRate'] }}% ({{ $ReturnRadiant3[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant3[1]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant3[1]['WinRate'] }}% ({{ $ReturnRadiant3[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant3[2]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant3[2]['WinRate'] }}% ({{ $ReturnRadiant3[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant3[3]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant3[3]['WinRate'] }}% ({{ $ReturnRadiant3[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant3[4]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant3[4]['WinRate'] }}% ({{ $ReturnRadiant3[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>

        	        </div>

        	    </div>
        	</div>

			<div class="container">
				<div class="row justify-content-start">
				    <div class="col-4">
				    	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnRadiant4[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnRadiant4[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnRadiant4[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnRadiant4[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnRadiant4[0]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant4[0]['WinRate'] }}% ({{ $ReturnRadiant4[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant4[1]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant4[1]['WinRate'] }}% ({{ $ReturnRadiant4[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant4[2]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant4[2]['WinRate'] }}% ({{ $ReturnRadiant4[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant4[3]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant4[3]['WinRate'] }}% ({{ $ReturnRadiant4[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant4[4]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant4[4]['WinRate'] }}% ({{ $ReturnRadiant4[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>
				    </div>
				    <div class="col-4">
				    	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnRadiant5[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnRadiant5[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnRadiant5[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnRadiant5[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnRadiant5[0]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant5[0]['WinRate'] }}% ({{ $ReturnRadiant5[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant5[1]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant5[1]['WinRate'] }}% ({{ $ReturnRadiant5[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant5[2]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant5[2]['WinRate'] }}% ({{ $ReturnRadiant5[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant5[3]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant5[3]['WinRate'] }}% ({{ $ReturnRadiant5[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnRadiant5[4]['HeroAgainst'] }}</strong> - {{ $ReturnRadiant5[4]['WinRate'] }}% ({{ $ReturnRadiant5[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>
				    </div>
				</div>
			</div>
        	
        	<h4 class="mt-5">Dire Heroes</h4>
        	<p>Role Summary:
        		@if(count($InfoHeroRolesDire)>0)
        			<div class="container">
        		    	<div class="row">
	        			@foreach($InfoHeroRolesDire as $key=>$item)
	        				<div class="col-12 col-md-2 HeroRolesBadges">
	        					<button type="button" class="btn btn-primary btn-sm">
	        						{{$item->Roles}} <span class="badge bg-light text-dark">{{$item->CountRoles}}</span>
	        					</button>
	        				</div>	
	        			@endforeach
	        			</div>
	        		</div>
        		@endif
        	</p>

        	<div class="container-fluid">
        	    <div class="row">

        	        <div class="col">

        	        	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnDire1[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnDire1[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnDire1[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnDire1[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnDire1[0]['HeroAgainst'] }}</strong> - {{ $ReturnDire1[0]['WinRate'] }}% ({{ $ReturnDire1[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire1[1]['HeroAgainst'] }}</strong> - {{ $ReturnDire1[1]['WinRate'] }}% ({{ $ReturnDire1[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire1[2]['HeroAgainst'] }}</strong> - {{ $ReturnDire1[2]['WinRate'] }}% ({{ $ReturnDire1[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire1[3]['HeroAgainst'] }}</strong> - {{ $ReturnDire1[3]['WinRate'] }}% ({{ $ReturnDire1[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire1[4]['HeroAgainst'] }}</strong> - {{ $ReturnDire1[4]['WinRate'] }}% ({{ $ReturnDire1[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>

        	        </div>


        	        <div class="col">

        	        	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnDire2[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnDire2[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnDire2[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnDire2[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnDire2[0]['HeroAgainst'] }}</strong> - {{ $ReturnDire2[0]['WinRate'] }}% ({{ $ReturnDire2[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire2[1]['HeroAgainst'] }}</strong> - {{ $ReturnDire2[1]['WinRate'] }}% ({{ $ReturnDire2[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire2[2]['HeroAgainst'] }}</strong> - {{ $ReturnDire2[2]['WinRate'] }}% ({{ $ReturnDire2[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire2[3]['HeroAgainst'] }}</strong> - {{ $ReturnDire2[3]['WinRate'] }}% ({{ $ReturnDire2[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire2[4]['HeroAgainst'] }}</strong> - {{ $ReturnDire2[4]['WinRate'] }}% ({{ $ReturnDire2[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>

        	        </div>


        	        <div class="col">

        	        	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnDire3[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnDire3[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnDire3[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnDire3[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnDire3[0]['HeroAgainst'] }}</strong> - {{ $ReturnDire3[0]['WinRate'] }}% ({{ $ReturnDire3[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire3[1]['HeroAgainst'] }}</strong> - {{ $ReturnDire3[1]['WinRate'] }}% ({{ $ReturnDire3[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire3[2]['HeroAgainst'] }}</strong> - {{ $ReturnDire3[2]['WinRate'] }}% ({{ $ReturnDire3[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire3[3]['HeroAgainst'] }}</strong> - {{ $ReturnDire3[3]['WinRate'] }}% ({{ $ReturnDire3[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire3[4]['HeroAgainst'] }}</strong> - {{ $ReturnDire3[4]['WinRate'] }}% ({{ $ReturnDire3[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>

        	        </div>

        	    </div>
        	</div>

			<div class="container">
				<div class="row justify-content-start">
				    <div class="col-4">
				    	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnDire4[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnDire4[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnDire4[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnDire4[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnDire4[0]['HeroAgainst'] }}</strong> - {{ $ReturnDire4[0]['WinRate'] }}% ({{ $ReturnDire4[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire4[1]['HeroAgainst'] }}</strong> - {{ $ReturnDire4[1]['WinRate'] }}% ({{ $ReturnDire4[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire4[2]['HeroAgainst'] }}</strong> - {{ $ReturnDire4[2]['WinRate'] }}% ({{ $ReturnDire4[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire4[3]['HeroAgainst'] }}</strong> - {{ $ReturnDire4[3]['WinRate'] }}% ({{ $ReturnDire4[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire4[4]['HeroAgainst'] }}</strong> - {{ $ReturnDire4[4]['WinRate'] }}% ({{ $ReturnDire4[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>
				    </div>
				    <div class="col-4">
				    	<div class="card">
	    	        	  	<div class="card-body">

	    	        	  		<div class="d-flex justify-content-between">
	    	        	  			<div><img src="{{ $ReturnDire5[0]['Picture'] }}" ></div>

	    	        	  			<div style="margin-left:13px;">
	    	        	  				<h5 class="card-title">{{ $ReturnDire5[0]['Hero'] }}</h5>
	    	        	  				<div style="font-size:13px;"><span class="warnabiru">Attack:</span> {{ $ReturnDire5[0]['AttackType'] }}</div>
	    	        	  				<div style="font-size:13px;"><span class="warnahijau">Roles:</span> {{ $ReturnDire5[0]['Roles'] }}</div>
	    	        	  			</div>
	    	        	  		</div>

	    	        	  		<p class="card-text">
	    	        	  			<h5>Winrate</h5>	
	    	        	  			<ul class="notes-list">
	    	        	  				<li><strong>{{ $ReturnDire5[0]['HeroAgainst'] }}</strong> - {{ $ReturnDire5[0]['WinRate'] }}% ({{ $ReturnDire5[0]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire5[1]['HeroAgainst'] }}</strong> - {{ $ReturnDire5[1]['WinRate'] }}% ({{ $ReturnDire5[1]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire5[2]['HeroAgainst'] }}</strong> - {{ $ReturnDire5[2]['WinRate'] }}% ({{ $ReturnDire5[2]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire5[3]['HeroAgainst'] }}</strong> - {{ $ReturnDire5[3]['WinRate'] }}% ({{ $ReturnDire5[3]['TotalMatch'] }} games)</li>
	    	        	  				<li><strong>{{ $ReturnDire5[4]['HeroAgainst'] }}</strong> - {{ $ReturnDire5[4]['WinRate'] }}% ({{ $ReturnDire5[4]['TotalMatch'] }} games)</li>
	    	        	  			</ul>
	    	        	  		</p>

	    	        	  	</div>
	    	        	</div>
				    </div>
				</div>
			</div>

        </div>
    </section>
</div>

@endsection