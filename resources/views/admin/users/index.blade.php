@extends('admin.main-layout')

	@section('user_open', 'menu-open')
	@section('user_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6"><h1 class="m-0">Users</h1></div>
					<!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Users</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
	@endsection

	@section('content')
		<!-- Main row -->
		<div class="row">
			<div class="container-fluid">
				Users List
			</div>
		</div>
		<!-- /.row (main row) -->
	@endsection