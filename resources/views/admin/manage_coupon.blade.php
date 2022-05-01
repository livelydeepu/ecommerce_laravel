@extends('admin.main-layout')

    @section('coupon_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Coupons</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Coupon</li>
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
                    <div class="card-header"><h3 class="card-title">Coupon Details</h3>
                        <div class="card-tools">
                            <a href="{{route('coupon')}}" class="btn btn-primary" title="Back"> Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="couponForm" method="POST" action="{{route('coupon.process')}}">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="lbl_title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$title}}" placeholder="Enter Title">
                            </div>
                            @error('title')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="lbl_code">Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{$code}}" placeholder="Enter Code">
                            </div>
                            @error('code')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="lbl_value">Value</label>
                                <input type="text" class="form-control" id="value" name="value" value="{{$value}}" placeholder="Enter Value">
                            </div>
                            @error('value')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="lbl_is_promo">Type</label>
                                <select class="form-control select2" id="type" name="type">
                                    <option value="">Select Type</option>
                                    @if($type=='Value')
                                        <option value="Value" selected>Value</option>
                                        <option value="Per">Per</option>
                                    @elseif($type=='Per')
                                        <option value="Value">Value</option>
                                        <option value="Per" selected>Per</option>
                                    @else
                                        <option value="Value">Value</option>
                                        <option value="Per">Per</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lbl_min_order_amt">Min Order Amt</label>
                                <input type="text" class="form-control" id="min_order_amt" name="min_order_amt" value="{{$min_order_amt}}" placeholder="Enter Min Order Amt">
                            </div>
                            @error('min_order_amt')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="lbl_is_one_time">Is One Time</label>
                                <select class="form-control select2" id="is_one_time" name="is_one_time">
                                    <option value="">Select Is One Time</option>
                                    @if($is_one_time=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @elseif($is_one_time=='0')
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    @else
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @endif
                                </select>
                            </div>
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
                $('#couponForm').validate({
                    rules: {
                        title: {
                            required: true,
                        },
                        code: {
                            required: true,
                        },
                        value: {
                            required: true,
                        },
                    },
                    messages: {
                        title: {
                            required: "Please enter a title name",
                        },
                        code: {
                            required: "Please enter a code name",
                        },
                        value: {
                            required: "Please enter a value name",
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
