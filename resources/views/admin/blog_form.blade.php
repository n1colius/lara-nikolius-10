@extends('layouts.default')
@section('content')

@include('includes.manage_data_menu')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

            <h3>Blog Form</h3>
            <br><br><br>

            <form method="POST" action="{{ route('adm_blog_form_proc') }}">
            	@csrf

				@if(session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Something it's wrong:
                        <ul>
                        	@foreach ($errors->all() as $error)
                        		<li>{{ $error }}</li>
                        	@endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <input type="hidden" name="OpsiForm" value="{{ $opsi }}">

                <div class="mb-3">
                 	<label for="exampleFormControlInput1" class="form-label">Blog ID</label>
                 	<input type="text" class="form-control" name="BlogId" value="{{ old('BlogId', $dataform['BlogId']) }}">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="BlogTitle" value="{{ old('BlogTitle', $dataform['BlogTitle']) }}">
                </div>

                <div class="mb-3">
                 	<label for="exampleFormControlInput1" class="form-label">Headline Picture</label>
                 	<input type="text" class="form-control" name="BlogHeadlinePic" value="{{ old('BlogHeadlinePic', $dataform['BlogHeadlinePic']) }}">
                </div>

                <div class="mb-3">
                 	<label for="exampleFormControlInput1" class="form-label">Date</label>
                 	<input type="date" class="form-control" name="BlogDate" value="{{ old('BlogDate', $dataform['BlogDate']) }}">
                </div>

                <div class="mb-3">
                 	<label for="exampleFormControlInput1" class="form-label">Tags</label><br>
                 	<div class="form-check form-check-inline">
                	 	<input class="form-check-input" type="checkbox" name="BlogTags[]" id="TagsOpini" value="1"
                	 		{{ (is_array(old('BlogTags', $dataform['BlogTags'])) and in_array('1', old('BlogTags', $dataform['BlogTags']))) ? ' checked' : '' }}
                	 	>
                	 	<label class="form-check-label" for="TagsOpini">Opini</label>
                	</div>
            	 	<div class="form-check form-check-inline">
            		 	<input class="form-check-input" type="checkbox" name="BlogTags[]" id="TagsProgramming" value="2"
            		 		{{ (is_array(old('BlogTags', $dataform['BlogTags'])) and in_array('2', old('BlogTags', $dataform['BlogTags']))) ? ' checked' : '' }}
            		 	>
            		 	<label class="form-check-label" for="TagsProgramming">Programming</label>
            		</div>
        		 	<div class="form-check form-check-inline">
        			 	<input class="form-check-input" type="checkbox" name="BlogTags[]" id="TagsDatabase" value="3"
        			 		{{ (is_array(old('BlogTags', $dataform['BlogTags'])) and in_array('3', old('BlogTags', $dataform['BlogTags']))) ? ' checked' : '' }}
        			 	>
        			 	<label class="form-check-label" for="TagsDatabase">Database</label>
        			</div>
    			 	<div class="form-check form-check-inline">
    				 	<input class="form-check-input" type="checkbox" name="BlogTags[]" id="TagsMacammacam" value="20"
    				 		{{ (is_array(old('BlogTags', $dataform['BlogTags'])) and in_array('20', old('BlogTags', $dataform['BlogTags']))) ? ' checked' : '' }}
    				 	>
    				 	<label class="form-check-label" for="TagsMacammacam">Macam macam</label>
    				</div>
                </div>

                <div class="mb-3">
                 	<label for="exampleFormControlInput1" class="form-label">Description</label>
                 	<textarea rows="10" class="form-control" id="BlogDesc" name="BlogDesc">{{ old('BlogDesc', $dataform['BlogDesc']) }}</textarea> 
                </div>

				<div class="mb-3">
				 	<label for="exampleFormControlInput1" class="form-label">Article</label>
				 	<textarea rows="10" class="form-control" id="BlogArticle" name="BlogArticle">{{ old('BlogArticle', $dataform['BlogArticle']) }}</textarea> 
				</div>                

                <br><br>
                <div class="col-auto">
                	<button type="submit" class="btn btn-primary mb-3">Save</button>
                	<button type="button" class="btn btn-secondary mb-3" onclick="window.location='{{ route("adm_blog") }}'">Back</button>
                </div>

            </form>

        </div>
    </section>
</div>

<script type="text/javascript">
ClassicEditor.create( document.querySelector( '#BlogDesc' ) );
ClassicEditor.create( document.querySelector( '#BlogArticle' ) );
</script>

@endsection