<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{Config::get('constants.site_name')}} | Login</title>

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
	</head>
	<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Unlimited</b>Store</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				@if(session('error'))
				<div class="alert alert-danger alert-dismissible">{{session('error')}}</div>
				@endif
				@if(session('success'))
				<div class="alert alert-success alert-dismissible">{{session('success')}}</div>
				@endif
				<h5><center>ADMIN PANEL</center></h5>
				<hr>
				<p class="login-box-msg">Sign in to start your session</p>
				<form method="POST" action="{{route('postLogin')}}">
				@csrf
					<div class="input-group mb-1">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					@error('email')
					<div class="text-danger">{{$message}}</div>
					@enderror
					<div class="input-group mb-1">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					@error('password')
					<div class="text-danger">{{$message}}</div>
					@enderror
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input name="remember" type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<div class="social-auth-links text-center mb-3">
					<p>- OR -</p>
					<a href="#" class="btn btn-block btn-primary">
						<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
					</a>
					<a href="#" class="btn btn-block btn-danger">
						<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
					</a>
				</div>
				<!-- /.social-auth-links -->

				<p class="mb-1">
					<a href="forgot-password.html">I forgot my password</a>
				</p>
				<p class="mb-0">
					<a href="register.html" class="text-center">Register a new membership</a>
				</p>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
	</body>
</html>
