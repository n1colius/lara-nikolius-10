@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">


			<div class="col-4">

				<h2 class="mb-5">Register User</h2>

				<form method="POST" action="{{ route('register_proc') }}">
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
					 	<label class="form-label">Nama Lengkap</label>
					 	<input type="text" class="form-control" name="name" id="name" placeholder="">
					</div>

					<div class="mb-3">
					 	<label class="form-label">Email</label>
					 	<input type="text" class="form-control" name="email" id="email" placeholder="">
					</div>

					<div class="mb-3">
					 	<label class="form-label">Password</label>
					 	<input type="password" class="form-control" name="password" id="password" placeholder="">
					</div>

					<div class="mb-3">
					 	<label class="form-label">Password Confirmation</label>
					 	<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="">
					</div>

					<div class="col-auto">
						<button type="submit" class="btn btn-primary mb-3">Register</button>
					</div>

                </form>

			</div>

        </div>
    </section>
</div>