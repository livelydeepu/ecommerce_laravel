@extends('admin.main-layout')

    @section('product_select', 'active')

    @section('styles')
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
						<h1 class="m-0">Products</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
							<li class="breadcrumb-item active">Product</li>
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
                <div class="col-md-12">
                    <div class="col-md-6">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>{{session('error')}}</div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>{{session('success')}}</div>
                    @endif
                    @error('attr_image.*')
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>{{$message}}</div>
                    @enderror
                    </div>
                    <!-- general form elements -->
                    <div class="card card-primary card-outline">
                        <div class="card-header"><h3 class="card-title">Product Details</h3>
                            <div class="card-tools">
                                <a href="{{route('product')}}" class="btn btn-primary" title="Back"> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="productForm" method="POST" action="{{route('product.process')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$name}}" placeholder="Enter Name">
                                </div>
                                @error('name')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$slug}}" placeholder="Enter SLug">
                                </div>
                                @error('slug')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" value="{{$image}}" {{$image_required}}>
                                            <label class="custom-file-label" for="lbl_image">Choose Image</label>
                                        </div>
                                        <div class="input-group-append">
                                        <span>
                                            @if($image!='')
                                            <a href="{{asset('storage/media/'.$image)}}" target="_blank"><img src="{{asset('storage/media/'.$image)}}" alt="Product Image" width="40px"></a>
                                            @endif
                                        </span>
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control select2" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($category as $catlist)
                                        @if($category_id==$catlist->id)
                                        <option value="{{$catlist->id}}" selected>{{$catlist->category_name}}</option>
                                        @else
                                        <option value="{{$catlist->id}}">{{$catlist->category_name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control select2" id="brand_id" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brandlist)
                                        @if($brand_id==$brandlist->id)
                                        <option value="{{$brandlist->id}}" selected>{{$brandlist->name}}</option>
                                        @else
                                        <option value="{{$brandlist->id}}">{{$brandlist->name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_model">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" value="{{$model}}" placeholder="Enter Model">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_description">Description</label>
                                    <textarea class="form-control" rows="2" id="description" name="description" placeholder="Enter Description">{{$description}}</textarea>
                                </div>
                                @error('description')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_short_description">Short Description</label>
                                    <textarea class="form-control" rows="2" id="short_description" name="short_description" placeholder="Enter Short Description">{{$short_description}}</textarea>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_technical_specification">Technical Specification</label>
                                    <textarea class="form-control" rows="2" id="technical_specification" name="technical_specification" placeholder="Enter Technical Specification">{{$technical_specification}}</textarea>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_keywords">Keywords</label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" value="{{$keywords}}" placeholder="Enter Keywords">
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_uses">Uses</label>
                                    <input type="text" class="form-control" id="uses" name="uses" value="{{$uses}}" placeholder="Enter Uses">
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lbl_warranty">Warranty</label>
                                    <input type="text" class="form-control" id="warranty" name="warranty" value="{{$warranty}}" placeholder="Enter Warranty">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_lead_time">Lead Time</label>
                                    <input type="text" class="form-control" id="lead_time" name="lead_time" value="{{$lead_time}}" placeholder="Enter Lead Time">
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_tax_id">Tax</label>
                                    <select class="form-control select2" id="tax_id" name="tax_id">
                                    <option value="">Select Tax</option>
                                    @foreach($taxes as $taxlist)
                                        @if($tax_id==$taxlist->id)
                                        <option value="{{$taxlist->id}}" selected>{{$taxlist->tax_name}}</option>
                                        @else
                                        <option value="{{$taxlist->id}}">{{$taxlist->tax_name}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_is_promo">Is Promotional</label>
                                    <select class="form-control select2" id="is_promo" name="is_promo">
                                    <option value="">Select Is Promo</option>
                                    @if($is_promo=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @elseif($is_promo=='0')
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    @else
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @endif
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_is_featured">Is Featured</label>
                                    <select class="form-control select2" id="is_featured" name="is_featured">
                                    <option value="">Select Is Featured</option>
                                    @if($is_featured=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @elseif($is_featured=='0')
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    @else
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @endif
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_is_discounted">Is Discounted</label>
                                    <select class="form-control select2" id="is_discounted" name="is_discounted">
                                    <option value="">Select Is Discounted</option>
                                    @if($is_discounted=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @elseif($is_discounted=='0')
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    @else
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @endif
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_is_trending">Is Trending</label>
                                    <select class="form-control select2" id="is_trending" name="is_trending">
                                    <option value="">Select Is Trending</option>
                                    @if($is_trending=='1')
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    @elseif($is_trending=='0')
                                        <option value="1">Yes</option>
                                        <option value="0" selected>No</option>
                                    @else
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    @endif
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="card-header"><h3 class="card-title">Product Attributes</h3>
                                <div class="card-tools">
                                    <input type="hidden" class="form-control" id="attr_count" name="attr_count" value="{{count($productAttrs)}}">
                                </div>
                            </div>
                            <!-- product-attributes row -->
                            @php
                                $loop_counta = 1;
                            @endphp
                            @foreach($productAttrs as $key => $row)
                            <?php
                                $loop_countd = $loop_counta;
                                $prdAttr = (array)$row;
                            ?>
                            <div class="row" class="product_append" id="product_append_{{$loop_counta++}}">
                                <input type="hidden" class="form-control" id="idAttr" name="idAttr[]" value="{{$prdAttr['id']}}">
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_sku">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku[]" value="{{$prdAttr['sku']}}" placeholder="SKU">
                                </div>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group">
                                    <label for="lbl_mrp">MRP</label>
                                    <input type="text" class="form-control" id="mrp" name="mrp[]" value="{{$prdAttr['mrp']}}" placeholder="MRP">
                                </div>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group">
                                    <label for="lbl_price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price[]" value="{{$prdAttr['price']}}" placeholder="Price">
                                </div>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group">
                                    <label for="lbl_quantity">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity[]" value="{{$prdAttr['quantity']}}" placeholder="Quantity">
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label>Size</label>
                                    <select class="form-control select2" id="size_id" name="size_id[]">
                                    <option value="">Select Size</option>
                                    @foreach($sizes as $sizelist)
                                        @if($prdAttr['size_id']==$sizelist->id)
                                        <option value="{{$sizelist->id}}" selected>{{$sizelist->size}}</option>
                                        @else
                                        <option value="{{$sizelist->id}}">{{$sizelist->size}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control select2" id="color_id" name="color_id[]">
                                    <option value="">Select Color</option>
                                    @foreach($colors as $collist)
                                        @if($prdAttr['color_id']==$collist->id)
                                        <option value="{{$collist->id}}" selected>{{$collist->color}}</option>
                                        @else
                                        <option value="{{$collist->id}}">{{$collist->color}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lbl_attr_image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attr_image" name="attr_image[]">
                                            <label class="custom-file-label" for="lbl_attr_image">Choose Image</label>
                                        </div>
                                        @if($prdAttr['attr_image']!='')
                                        <span><img src="{{asset('storage/media/'.$prdAttr['attr_image'])}}" alt="Product Image" width="40px"></span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group"><label>Action</label>
                                @if($loop_counta == 2)
                                    <button type="button" id="add_more" class="btn btn-warning add_more" title="Add"><i class="fas fa-plus"></i> Add</button>
                                @else
                                    <a href="{{url('admin/product/productAttr_delete/'.$prdAttr['id'].'/'.$id)}}"><button id="remove_{{$loop_countd}}" class="form-control btn btn-danger" title="Remove" onclick="remove_row('{{$loop_countd}}')"><i class="fas fa-trash"></i></button></a>
                                @endif
                                </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- /.row (product-attributes row) -->
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
        <!-- SweetAlert2 -->
        <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
		<script>
            $(document).ready(function(){
                var attr_cnt = $('#attr_count').val();
                var count_row = attr_cnt;
                $("#add_more").click(function(){  
                    count_row++;
                    var divrow='<div class="row" id="product_append_'+count_row+'">';
                    divrow+='<input type="hidden" class="form-control" id="idAttr" name="idAttr[]" />';
                    divrow+='<div class="col-md-2"><div class="form-group"><label for="lbl_sku">SKU</label><input type="text" class="form-control" id="sku" name="sku[]" placeholder="SKU" required></div></div>';
                    divrow+='<div class="col-md-1"><div class="form-group"><label for="lbl_mrp">MRP</label><input type="text" class="form-control" id="mrp" name="mrp[]" placeholder="MRP" required></div></div>';
                    divrow+='<div class="col-md-1"><div class="form-group"><label for="lbl_price">Price</label><input type="text" class="form-control" id="price" name="price[]" placeholder="Price" required></div></div>';
                    divrow+='<div class="col-md-1"><div class="form-group"><label for="lbl_quantity">Quantity</label><input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity"></div></div>';
                    var size_id_html=$('#size_id').html();
                    size_id_html=size_id_html.replace("selected","");
                    divrow+='<div class="col-md-2"><div class="form-group"><label>Size</label><select class="form-control select2" id="size_id" name="size_id[]">'+size_id_html+'</select></div></div>';
                    var color_id_html=$('#color_id').html();
                    color_id_html=color_id_html.replace("selected","");
                    divrow+='<div class="col-md-2"><div class="form-group"><label>Color</label><select class="form-control select2" id="color_id" name="color_id[]">'+color_id_html+'</select></div></div>';
                    divrow+='<div class="col-md-2"><div class="form-group"><label for="lbl_attr_image">Image</label><div class="input-group"><div class="custom-file"><input type="file" class="custom-file-input" id="attr_image" name="attr_image[]"><label class="custom-file-label" for="lbl_attr_image">Choose Image</label></div></div></div></div>';
                    divrow+='<div class="col-md-1"><div class="form-group"><label>Remove</label><button type="button" id="remove_'+count_row+'" class="form-control btn btn-danger" title="Remove" onclick="remove_row('+count_row+')"><i class="fas fa-trash"></i></button></div></div>';
                    divrow+='</div>';
                    jQuery('#product_append_1').append(divrow);
                });
                
				$.validator.setDefaults({
                    submitHandler: function () {
                        form.submit();
                    }
                });
                $('#productForm').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        slug: {
                            required: true,
                        },
                        category_id: {
                            required: true,
                        },
                        description: {
                            required: true,
                        },
                        short_description: {
                            required: true,
                        },
                        brand: {
                            required: true,
                        },
                        model: {
                            required: true,
                        },
                        keywords: {
                            required: true,
                        },
                        technical_specification: {
                            required: true,
                        },
                        uses: {
                            required: true,
                        },
                        warranty: {
                            required: true,
                        },
                        sku: {
                            required: true,
                        },
                        mrp: {
                            required: true,
                        },
                        price: {
                            required: true,
                        },
                        quantity: {
                            required: true,
                        },
                        size_id: {
                            required: true,
                        },
                        color_id: {
                            required: true,
                        },
                    },
                    messages: {
                        name: {
                            required: "Please enter a product name",
                        },
                        slug: {
                            required: "Please enter a product slug",
                        },
                        category_id: {
                            required: "Please enter a category",
                        },
                        description: {
                            required: "Please enter a description",
                        },
                        short_description: {
                            required: "Please enter a short description",
                        },
                        brand: {
                            required: "Please enter a brand",
                        },
                        model: {
                            required: "Please enter a model",
                        },
                        keywords: {
                            required: "Please enter a keywords",
                        },
                        technical_specification: {
                            required: "Please enter a technical specification",
                        },
                        uses: {
                            required: "Please enter a uses",
                        },
                        warranty: {
                            required: "Please enter a warranty",
                        },
                        sku: {
                            required: "Please enter a SKU",
                        },
                        mrp: {
                            required: "Please enter a MRP",
                        },
                        price: {
                            required: "Please enter a price",
                        },
                        quantity: {
                            required: "Please enter a quantity",
                        },
                        size_id: {
                            required: "Please enter a size",
                        },
                        color_id: {
                            required: "Please enter a color",
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

                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
			});

            function remove_row(count_row){ 
                jQuery('#product_append_'+count_row).remove();
            } 
		</script>
	@endsection
