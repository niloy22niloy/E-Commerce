@extends('layouts.dashboard')
@section('content')
<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcumb-item"><a href="javascript:void(0)">Home</li>
        <li class="breadcumb-item"><a href="javascript:void(0)">Product</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body">
               

           
            
                <div class="row">
                <div class="col-lg-6">
                    <select name="category_id"  class="form-control category_id" >
                       
                  <option value="">----Select Category----</option>
                  @foreach ($categories as $category )
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                      
                  @endforeach

                    </select>
                </div>
                <div class="col-lg-6">
                    <select name="subcategory_id" id="subcategory" class="form-control">
                        <option value="">----Select Sub Category-----</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input type="text" name="product_name" class="form-control" placeholder="product name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input type="number" name="price" class="form-control" placeholder="product Price">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input type="number" name="discount" class="form-control" placeholder="Discount %">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input type="text" name="brand" class="form-control" placeholder="Brand">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <input type="text" name="short_desp" class="form-control"  placeholder="Short Description">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <textarea name="long_desp" id="summernote" class="form-control" placeholder="Long Description">
                    </textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Preview</label>
                        <input type="file" name="preview" class="form-control" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Thumbnails</label>
                        <input type="file" name="thumbnails[]" multiple class="form-control" >
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                       
                        <button type="submit" class="btn btn-primary" >Add Product</button>
                       
                    </div>
                </div>
                
                

            </div>
        </div>
    </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script>

   $('.category_id').change(function(){
//            var category_id=$(this).val();
//            $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $.ajax({
//     type:'POST',
//     url:'/getSubcategory',
//     data:{'category_id':category_id},
//     success:function(data){
//        alert(data);
//     }

// });

 var category_id=$(this).val();
 

 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    type:'POST',
    url:'/getSubcategories',
    data:{'category_id':category_id},
    success:function(data){
        $('#subcategory').html(data);
    }
})
 
});
  

   
    
   </script>
   <script>
   $(document).ready(function() {
    $('#summernote').summernote();
  });
</script>
@endsection;
@section('footer_script')
{{-- <script>
   $('#category_id').change(function(){
           alert();
   });
</script> --}}
@endsection