@php
	$current_route = request()->route()->getName();
@endphp
	
	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="index3.html" class="brand-link">
			<img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">UnlimitedStore</span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="#" class="d-block">{{auth()->user()->name}}</a>
				</div>
			</div>
			<!-- SidebarSearch Form -->
			<div class="form-inline">
				<div class="input-group" data-widget="sidebar-search">
					<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-sidebar">
							<i class="fas fa-search fa-fw"></i>
						</button>
					</div>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
					<li class="nav-item">
						<a href="{{route('dashboard')}}" class="nav-link @yield('dashboard_select')">
							<i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p>
						</a>
					</li>
					<li class="nav-item @yield('user_open')">
						<a href="#" class="nav-link @yield('user_select')">
							<i class="nav-icon fas fa-users"></i><p> User Management<i class="right fas fa-angle-left"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{route('users.index')}}" class="nav-link @yield('user_select')">
									<i class="far fas fa-user"></i><p> Users</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="{{route('category')}}" class="nav-link @yield('category_select')">
							<i class="nav-icon fas fa-list"></i><p> Category</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('size')}}" class="nav-link @yield('size_select')">
							<i class="nav-icon fas fa-window-maximize"></i><p> Size</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('color')}}" class="nav-link @yield('color_select')">
							<i class="nav-icon fas fa-fill"></i><p> Color</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('brand')}}" class="nav-link @yield('brand_select')">
							<i class="nav-icon fas fa-copyright"></i><p> Brand</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('coupon')}}" class="nav-link @yield('coupon_select')">
							<i class="nav-icon fas fa-tag"></i><p> Coupon</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('tax')}}" class="nav-link @yield('tax_select')">
							<i class="nav-icon fas fa-table"></i><p> Tax</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{route('product')}}" class="nav-link @yield('product_select')">
							<i class="nav-icon fas fa-pager"></i><p> Product</p>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>