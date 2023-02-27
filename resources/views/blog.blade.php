@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h3>Blog</h3>
        	<br><br><br>

			<div class="container">
				<div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
				  	@if(count($data)>0)
	                	@foreach($data as $key=>$item)
	                		<div class="col">
	                			<div class="card" style="border:none;">
	                				<img src="{{ $item->BlogHeadlinePic }}" class="card-img-top">
	                				<div class="card-body">
	                					<h5 class="card-title"><a title="Read Article" href="{{ route("blog_detail", ['id' => $item->BlogId]) }}">{{ $item->BlogTitle }}</a></h5>
	                					<div class="row row-cols-auto">
	                						@php
	                							$ArrTags = explode(',',$item->BlogTag);
	                						@endphp
	                						@if(count($ArrTags))
	                							@foreach($ArrTags as $key=>$tag)
		                							<div class="col">
		                							    <span class="badge bg-success">{{$tag}}</span>
		                							</div>
                								@endforeach
                							@endif
	                					</div>
	                				</div>
	                			</div>
	                		</div>
                		@endforeach
                	@endif
				</div>
			</div>

        </div>
    </section>
</div>

@endsection	