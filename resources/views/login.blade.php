@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<div class="col-4">

				<h2 class="mb-5">Admin Area</h2>

				<form method="POST" action="{{ route('login_proc') }}">
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

					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Username</label>
					 	<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Fill your email here">
					</div>
					<div class="mb-3">
					 	<label for="exampleFormControlInput1" class="form-label">Password</label>
					 	<input type="password" class="form-control" name="password" placeholder="Fill your password here">
					</div>
					<div class="col-auto">
						<button type="submit" class="btn btn-primary mb-3">Login</button>
					</div>
				</form>

			</div>
		</div>
	</section>
</div>

@endsection