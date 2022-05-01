@extends('admin.main-layout')

    @section('color_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Color</h1>
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title">Color Details</h3>
                        <div class="card-tools">
                            <a href="{{route('color')}}" class="btn btn-primary" title="Back"> Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="colorForm" method="POST" action="{{route('color.process')}}">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="lbl_color">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{$color}}" placeholder="Enter Color">
                            </div>
                            @error('color')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$id}}">
                    </form>
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
        <!-- bs-custom-file-input -->
        <script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
        <!-- jquery-validation -->
        <script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$.validator.setDefaults({
                    submitHandler: function () {
                        form.submit();
                    }
                });
                $('#colorForm').validate({
                    rules: {
                        color: {
                            required: true,
                        },
                    },
                    messages: {
                        color: {
                            required: "Please enter a color name",
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    }
                });
			});
		</script>
	@endsection
