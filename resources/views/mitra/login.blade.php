@extends('front.layouts.app')

@section('content')
		<div class="login-box">
			@include('mitra.message')
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form action="{{ route('mitra.authenticate') }}" method="post">
						@csrf
				  		<div class="input-group mb-3">
							<input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>

							@error('email')
								<p class="invalid-feedback">{{ $message }}</p>
							@enderror
							
				  		</div>
				  		<div class="input-group mb-3">
							<input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>

							@error('password')
								<p class="invalid-feedback">{{ $message }}</p>
							@enderror

				  		</div>
				  		<div class="row">
							<!-- <div class="col-8">
					  			<div class="icheck-primary">
					  			</div>
							</div> -->
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
					<p class="mb-1 mt-3">
						<a href="forgot-password.html">I forgot my password</a>
					</p>
				</div>
				<!-- /.card-body -->
			</div>
			<div class="text-center small">Don't have an account? <a href="{{ route('mitra.register') }}">Sign up</a></div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		@endsection
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootsrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		{{-- <scriptsrc="js/demo.js"></script> --}}