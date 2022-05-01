@extends('admin.main-layout')

    @section('category_select', 'active')

	@section('content-header')
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Categories</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Category</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
	@endsection

	@section('content')
        @php
            if($id > 0){
                $image_required = "";
            }
            else {
                $image_required = "required";
            }
        @endphp
		<!-- Main row -->
		<div class="row">
			<div class="container-fluid">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title">Category Details</h3>
                        <div class="card-tools">
                            <a href="{{route('category')}}" class="btn btn-primary" title="Back"> Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="categoryForm" method="POST" action="{{route('category.process')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="lbl_category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category_name}}" placeholder="Enter Category">
                            </div>
                            @error('category')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control select2" id="parent_category_id" name="parent_category_id">
                                    <option value="">Select Category</option>
                                    @foreach($category as $catlist)
                                        @if($parent_category_id==$catlist->id)
                                        <option value="{{$catlist->id}}" selected>{{$catlist->category_name}}</option>
                                        @else
                                        <option value="{{$catlist->id}}">{{$catlist->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lbl_category_slug">Category Slug</label>
                                <input type="text" class="form-control" id="category_slug" name="category_slug" value="{{$category_slug}}" placeholder="Enter Category Slug">
                            </div>
                            @error('category_slug')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                            <div class="form-group">
                                <label for="lbl_category_image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="category_image" name="category_image" value="{{$category_image}}" {{$image_required}}>
                                    <label class="custom-file-label" for="lbl_category_image">Choose Image</label>
                                    </div>
                                    <div class="input-group-append">
                                    <span>
                                        @if($category_image!='')
                                        <a href="{{asset('storage/media/'.$category_image)}}" target="_blank"><img src="{{asset('storage/media/'.$category_image)}}" alt="Category Image" width="40px"></a>
                                        @endif
                                    </span>
                                    </div>
                                    @error('category_image')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_home" name="is_home" {{$is_home_selected}}>
                                    <label class="form-check-label" for="lbl_is_home">Show in Home</label>
                                </div>
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
                $('#categoryForm').validate({
                    rules: {
                        category_name: {
                            required: true,
                        },
                        category_slug: {
                            required: true,
                        },
                    },
                    messages: {
                        category_name: {
                            required: "Please enter a category name",
                        },
                        category_slug: {
                            required: "Please enter a category slug",
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

                bsCustomFileInput.init();

                //Initialize Select2 Elements
                $('.select2').select2();
			});
		</script>
	@endsection
