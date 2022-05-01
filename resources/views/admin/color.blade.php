@extends('admin.main-layout')

    @section('color_select', 'active')

    @section('styles')
        <!-- DataTables -->
		<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
		<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  		<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
    @endsection

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Colors</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Color</li>
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
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header"><h3 class="card-title">Color List</h3>
                            <div class="card-tools">
                                <a href="{{route('color.manage', '')}}" class="btn btn-primary" title="Add"> Add Color</a>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="datatable_color" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Color Id</th>
                                        <th>Color Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($colors))
					                @foreach($colors as $color)
                                    <tr>
                                        <td>{{$color->id}}</td>
                                        <td>{{$color->color}}</td>
                                        <td>{!!$color->status==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>'!!}</td>
                                        <td class="py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                @if($color->status==1)
                                                <form method="POST" action="{{route('color.status', [0, $color->id])}}">
                                                @csrf
                                                @method('PUT')
                                                    <button class="btn btn-success" title="Status"><i class="fas fa-check"></i></button>
                                                </form>
                                                @endif
                                                @if($color->status==0)
                                                <form method="POST" action="{{route('color.status', [1, $color->id])}}">
                                                @csrf
                                                @method('PUT')
                                                    <button class="btn btn-success" title="Status"><i class="fas fa-check"></i></button>
                                                </form>
                                                @endif
                                                <form method="POST" action="{{route('color.manage', $color->id)}}">
									            @csrf
									            @method('GET')
                                                    <button class="btn btn-primary" title="Edit"><i class="fas fa-edit"></i></button>
                                                </form>
                                                <form method="POST" action="{{route('color.destroy', $color->id)}}">
									            @csrf
									            @method('DELETE')
                                                    <button class="btn btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
					                @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Color Id</th>
                                        <th>Color Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
			</div>
		</div>
		<!-- /.row (main row) -->
	@endsection

	@section('scripts')
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <!-- SweetAlert2 -->
        <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function(){

                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif

                $("#datatable_color").DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "lengthMenu": [[5, 50, 100, -1], [4, 50, 100, "All"]],
                    
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#datatable_color_wrapper .col-md-6:eq(0)');
			});
		</script>
	@endsection