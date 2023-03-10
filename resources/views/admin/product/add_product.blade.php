@extends('layouts.dashboard')
@section('content')
<!DOCTYPE html>
<head>
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
            <form action=" " method="POST">
                @csrf
                <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body">
               

           
            
                <div class="row">
                <div class="col-lg-6">
                    <select name="category_id"  class="form-control category_id" id="category_id">
                       
                  <option value="">----Select Category----</option>
                  @foreach ($categories as $category )
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                      
                  @endforeach

                    </select>
                </div>
                <div class="col-lg-6">
                    <input type="text" id="subcategory" value="">
                    </select>
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

   $('#category_id').change(function(){
           var category_id=$(this).val();
           $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    type:'POST',
    url:'/getSubcategory',
    data:{'category_id':category_id},
    success:function(data){
       alert(data);
    }

});


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