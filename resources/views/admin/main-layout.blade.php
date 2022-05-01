<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>UnlimitedStore {{isset($page_title)?'| '.$page_title:''}}</title>

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Ionicons --> 
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Tempusdominus Bootstrap 4 -->
		<link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
		<!-- iCheck -->
		<link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
		<!-- JQVMap -->
		<link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
		<!-- summernote -->
		<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
		@yield('styles')
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<!-- Preloader -->
			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__shake" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
			</div>
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>
				</ul>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#"><i class="far fa-user"></i></a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<a href="{{route('logout')}}" class="dropdown-item">Logout</a>
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			@include('admin.left-sidebar')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				@yield('content-header')

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						@yield('content')
					</div><!-- /.container-fluid -->
				</section>
			<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2022-2023 <a href="#">UnlimitedStore</a>.</strong> All rights reserved.
				<div class="float-right d-none d-sm-inline-block"><b>Version</b> 1.0.0</div>
			</footer>
		</div>
		<!-- ./wrapper -->

		<!-- jQuery -->
		<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
		$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- ChartJS -->
		<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
		<!-- Sparkline -->
		<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>
		<!-- JQVMap -->
		<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
		<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
		<!-- jQuery Knob Chart -->
		<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
		<!-- daterangepicker -->
		<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
		<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
		<!-- Summernote -->
		<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
		<!-- overlayScrollbars -->
		<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<!-- <script src="{{asset('admin/dist/js/demo.js')}}"></script> -->
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<!-- <script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script> -->
		@yield('scripts')
	</body>
</html>
