<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

@extends('layouts.dashboard')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    
</head>
<body>

    

<div class="page-title">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)" class="href">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)" class="href">Subcategory</a></li>

    </ol>
</div>
<div class="row">
    <div class="col-lg-8">
     <div class="card">
        <div class="card-header">
            <h3>Subcategory List</h3>
        </div>
        <div class="card-body">
           
             <table class="table table-striped" id="table_id">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Sub Category</th>
                    <th> Category</th>
                    <th>Added By</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
            <tbody>
                @foreach ($subcategories as $key=>$subcategory)
                <tr>
                
                    
                        <td>{{$key+1}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>{{$subcategory->rel_to_subcategory->category_name}}</td>
                        <td>{{$subcategory->rel_to_user->name}}</td>
                        <td>{{$subcategory->created_at->diffForHumans()}}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Edit</a>
                                    <a class="dropdown-item" href="">Permanent Delete</a>
                                    <a class="dropdown-item" href="">Delete</a>
                                </div>
                            </div>
                        </td>
                    

                
            </tr>
            @endforeach
        </tbody>
            </table> 
            
           {{-- <tr>
            <td>
                <select name="category_id" id="category_id" class="form-control" >
                <option value="">--select Caltegory---</option>
                @foreach ( $categories as $category)
                <option value="{{$category->id}}" >{{$category->category_name}}</option>
                    
                @endforeach
                </select>
            </td>
           </tr> --}}
           {{-- <div class="mt-5">
            <h3>Subcategory Info</h3>
            
          <table class="table table">
            <tr>
                <th>Subcategory Name</th>
                <th>Subcategory Action</th>
            </tr>
            <tr class="subcate">
                
            </tr>
          </table>
            
           </div> --}}
        </div>
        </div>
            {{-- <table class="table table-striped">
                <tr>
                    <th>Sl</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Added By</th>
                    <th>Created At</th>

                </tr> --}}
                {{-- @foreach ($subcategories as $key=>$subcategory)
                <tr>
                
                    
                        <td>{{$key+1}}</td>
                        <td>{{$subcategory->rel_to_subcategory->category_name}}</td>
                        <td></td>
                    

                
            </tr>
            @endforeach --}}
            {{-- </table> --}}
        </div>
     

    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>subcategory</h3>
            </div>
            <div class="card-body">
                <form action="{{route('subcategory.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" id="" class="form-control" >

                            <option value="" >---Select Category---</option>
                            @foreach (  $categories as $category)
                            <option  value="{{$category->id}}" >{{$category->category_name}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <select name="category_id" id="subb" class="form-control" >

                            <option value="" >---Select Category---</option>
                            @foreach (  $subcategories as $subcategory)
                            <option  value="{{$subcategory->id}}" >{{$subcategory->subcategory_name}}</option>
                            @endforeach
                            
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label for="" clas="form-control">Subcategory Name</label>
                        <input type="text" name="subcategory_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Add Subcategory</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <a href="javascript:void(0)" onclick="click_here()">Click Here</a>
    {{-- <script>
        function click_here(){
            alert('a');
        }
        $('#category_ids').onchange(function(){
            var category_id = $(this).value();
            alert('category_id');
        });
        </script>
     --}}
    {{-- <script>
        function myFunction() {
            $('#category_ids').change(function(){
           var category_id = $(this).val();
         $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    });
    $.ajax({
        url:'/getsubcategory',
        type:'POST',
        data: {'category_id': category_id },
        success:function(data){
            alert(data);
        }
    });
        }
        </script> --}}
        
   {{-- <script>
    $(function(){
        $('#subb').hide();
      $('#category_ids').change(function(){
        var category_id=$(this).val();
        if($('#category_ids').val() !=null){
            // $('#subb').show();
            alert(category_id);
        }
      });
    });
    
   </script> --}}
   {{-- <script>
    $('#category_id').change(function(){
        var $category_id= $(this).val();
        
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// $.ajax({
//      url:'/getsubcategory',
//      type:'POST',
//      data:{'category_id':$category_id},
//      success:function(data){
//      $('.subcate').html(data);
//      }
     
// });
    });
   </script> --}}
   
</div>
</div>

</body>
    </html>
    <script>
        $(document).ready( function () {
    $('#table_id').DataTable();
} );
        </script>
@endsection

