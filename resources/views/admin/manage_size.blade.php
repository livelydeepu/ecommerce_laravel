@extends('admin.main-layout')

    @section('size_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Sizes</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Size</li>
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
                    <div class="card-header"><h3 class="card-title">Size Details</h3>
                        <div class="card-tools">
                            <a href="{{route('size')}}" class="btn btn-primary" title="Back"> Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="sizeForm" method="POST" action="{{route('size.process')}}">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="lbl_size">Size</label>
                                <input type="text" class="form-control" id="size" name="size" value="{{$size}}" placeholder="Enter Size">
                            </div>
                            @error('size')
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
                $('#sizeForm').validate({
                    rules: {
                        size: {
                            required: true,
                        },
                    },
                    messages: {
                        size: {
                            required: "Please enter a size name",
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
