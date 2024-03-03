@extends('backend.layouts.admin_master')

@section('products')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Products</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-plus"></i> Add New Product
                    <a href="{{ route('admin.products') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Product</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Name English: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="name_en" class="form-control" placeholder="Name English">
                                        @error('name_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Name Bangla: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="name_bn" class="form-control" placeholder="Name Bangla">
                                        @error('name_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Short Description En: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <textarea class="form-control" name="short_desc_en" rows="2" placeholder="Product Short Description English">
                                            
                                        </textarea>
                                        @error('short_desc_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Short Description Bn: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <textarea class="form-control" name="short_desc_bn" rows="2" placeholder="Product Short Description Bangla">
                                            
                                        </textarea>
                                        @error('short_desc_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Long Description En: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <textarea class="form-control" name="long_desc_en" rows="4" id="summernote2" placeholder="Product Long Description English">
                                            
                                        </textarea>
                                        @error('long_desc_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Long Description Bn: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <textarea class="form-control" name="long_desc_bn" rows="4" id="summernote" placeholder="Product Long Description Bangla">
                                            
                                        </textarea>
                                        @error('long_desc_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="product_code" class="form-control" placeholder="Product Code">
                                        @error('product_code') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="selling_price" class="form-control" placeholder="Product Selling Price">
                                        @error('selling_price') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="discount_price" class="form-control" placeholder="Product Discount Price">
                                        
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="quantity" class="form-control" placeholder="Product Quantity">
                                        @error('quantity') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Tag En: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="tag_en" class="form-control" placeholder="Product Tag English" data-role="tagsinput">
                                        @error('tag_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Tag Bn: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="tag_bn" class="form-control" placeholder="Product Tag Bangla" data-role="tagsinput">
                                        @error('tag_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Size En: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="size_en" class="form-control" placeholder="Product Size English" data-role="tagsinput">
                                        @error('size_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Size Bn: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="size_bn" class="form-control" placeholder="Product Size Bangla" data-role="tagsinput">
                                        @error('size_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Color En: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="color_en" class="form-control" placeholder="Product Color English" data-role="tagsinput">
                                        @error('color_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Color Bn: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="color_bn" class="form-control" placeholder="Product Color Bangla" data-role="tagsinput">
                                        @error('color_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Select Brand: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <select name="brand_id" class="form-control select2-show-search" data-placeholder="Select Brand">
                                            <option label="Choose Brand"></option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Select Category: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <select name="category_id" class="form-control select2-show-search" data-placeholder="Select Category">
                                            <option label="Choose Category"></option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Select Subcategory: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <select name="subcategory_id" class="form-control select2-show-search" data-placeholder="Select Subcategory">
                                            <option label="Choose Subcategory"></option>
                                            
                                        </select>
                                        @error('subcategory_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Select Sub Subcategory: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <select name="subsubcategory_id" class="form-control select2-show-search" data-placeholder="Select Sub Subcategory">
                                            <option label="Choose Sub Subcategory"></option>
                                            
                                        </select>
                                        @error('subsubcategory_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Hot Deals:</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="checkbox" name="hot_deals" value="1"> <span>Check Hot Deals</span>
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Featured:</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="checkbox" name="featured" value="1"> <span>Check Featured</span>
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Special Offer:</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="checkbox" name="special_offer" value="1"> <span>Check Special Offer</span>
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Special Deals:</label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="checkbox" name="special_deals" value="1"> <span>Check Special Deals</span>
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Image: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="file" name="product_image" class="form-control" onchange="mainThambUrl(this)">
                                        @error('product_image') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <img src="" id="mainThmb">
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Gallery Image: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="file" name="images[]" id="multiimage" class="form-control" multiple>
                                    </div>
                                    
                                    <div class="col-sm-3" id="showimage">
                                        
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label"></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <button type="submit" class="btn btn-info mg-r-5">Save change</button>
                                        <button class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                               </form>
                            </div><!-- card -->
                        </div><!-- col-6 -->
                    </div><!-- row -->
            </div><!-- card -->
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->

<script src="{{asset('backend')}}/lib/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/admin/subcategory/get') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">'+ value.name_en +'</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });
        
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/admin/sub-subcategory/get') }}/"+subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">'+ value.subcatename_en +'</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });
        
    });
</script>

  <!-- Show multiple image -->  
<script>

  $(document).ready(function(){
   $('#multiimage').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(50)
                  .height(50); //create image element
                      $('#showimage').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

</script>
  
<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(50)
                  .height(50);
        };
        reader.readAsDataURL(input.files[0]);


      }
    }
</script>
@endsection
