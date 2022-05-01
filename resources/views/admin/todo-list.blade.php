@extends('admin.main-layout')

	@section('dashboard_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Dashboard</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
	@endsection

	@section('content')
		<!-- Left col -->
		<section class="col-lg-7 connectedSortable">
			<div class="card">
				<div class="card-header ui-sortable-handle">
					<h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>To Do List</h3>
						<div class="card-tools">
							<ul class="pagination pagination-sm">{!! $todolists->links() !!}</ul>
						</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					@if(count($todolists))
					@foreach($todolists as $todolist)
					<ul class="todo-list" data-widget="todo-list">
						<li @class="{{$todolist->completed==1 ? 'done' : ''}}">
							<!-- drag handle -->
							<span class="handle ui-sortable-handle">
								<i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i>
							</span>
							<!-- checkbox -->
							<div  class="icheck-primary d-inline ml-1">
								<input type="checkbox" class="todo1" value="" name="todo1" id="todo1" {{$todolist->completed ? 'checked' : ''}}>
								<label for="todoCheck1"></label>
							</div>
							<!-- todo text -->
							<span class="text">{{$todolist->task}}</span>
							<!-- Emphasis label -->
							<small class="badge badge-danger"><i class="far fa-clock"></i>{{$overdueTaskCounts}} min</small>
							<!-- General tools such as edit or delete-->
							<div class="tools">
								<div class="btn-group btn-sm">
									<form method="POST" action="{{route('update', $todolist->id)}}">
									@csrf
									@method('PUT')
										<button class="btn btn-success btn-block btn-sm"><i class="fas fa-check"></i></button>
									</form>
									<form method="POST" action="{{route('destroy', $todolist->id)}}">
									@csrf
									@method('DELETE')
										<button class="btn btn-danger btn-block btn-sm"><i class="fas fa-trash"></i></button>
									</form>
								</div>
							</div>	 
						</li>
					</ul>
					@endforeach
					@endif
				</div>
				<!-- /.card-body -->
				<form method="POST" action="{{route('store')}}">
				@csrf
					<div class="card-footer clearfix">
						<div class="input-group mb-1">
							<input name="task" type="text" class="form-control" placeholder="Add new Todo">
							<div class="col-3"><button type="submit" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button></div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.card -->
		</section>
		<!-- /.Left col -->
	@endsection

	@section('scripts')
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#todo1').click(function(){
					alert('hi');
				})
			});
		</script>
	@endsection
