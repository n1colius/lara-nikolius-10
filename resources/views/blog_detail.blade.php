@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2>{{ $blog->BlogTitle }}</h2>
            <div class="container">
                <img src="{{ $blog->BlogHeadlinePic }}" class="img-fluid" />
            </div>
            <h5>{{ $blog->BlogDate }}</h5>
            <div class="row row-cols-auto">
                @php
                    $ArrTags = explode(',',$blog->BlogTags);
                @endphp
                @if(count($ArrTags))
                    @foreach($ArrTags as $key=>$tag)
                        <div class="col">
                            <span class="badge bg-success">{{$tag}}</span>
                        </div>
                    @endforeach
                @endif
            </div>
            {!! $shareButtons !!}

            <br><br>

            <div class="container">
                {!! $blog->BlogArticle !!}
            </div>

        </div>
    </section>
</div>

@endsection