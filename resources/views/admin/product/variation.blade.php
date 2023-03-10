@extends('layouts.dashboard')
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcumb-item"><a href="javascript:void(0)">Home</li>
        <li class="breadcumb-item"><a href="javascript:void(0)">Inventory</li>
    </ol>
</div> 
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Color List
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Color Name</th>
                        <th>Color</th>
                        <th>Action</th>
                        
                    </tr>
                    @foreach ($colors as $key=>$color)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$color->color_name}}</td>
                        <td><div style="width:40px;height:50px;background-color:{{$color->color_code}}">
                        {{($color->color_code==null)?'NA':''}}
                        </div></td> 
                        <td><button type="" class="btn btn-danger">Delete</td>
                     </tr>
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Sizes List
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Serial</th>
                        <th>Size Name</th>
                        <th>Action</th>
                        
                    </tr>
                    @foreach ($sizes as $key=>$size )
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$size->size_name}}</td>
                        <td>
                            <button type="submit" class="btn btn-success">Delete</button>
                        </td>
                     </tr>
                   
                    @endforeach
                  
                    
                </table>
            </div>
        </div>
    </div>
        <div class="col-lg-4">
<div class="card">
    <div class="card-header">
        <h3>Add Inventory</h3>

    </div>
    <div class="card-body">
        <form action="{{route('add.color')}}" method="POST">
            @csrf
           
           
            <div class="mb-3">
                <input type="text" name="color_name" class="form-control" placeholder="Color Name" >
            </div>
            <div class="mb-3">
                <input type="text" name="color_code" class="form-control" placeholder="Color Code" >
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-primary" >Add Color</button>
            </div>
        </form>
    </div>
    
</div>
<div class="card">
    <div class="card-header">
        <h3>Add Sizes</h3>

    </div>
    <div class="card-body">
        <form action="{{route('add.size')}}" method="POST">
            @csrf
           
           
            <div class="mb-3">
                <input type="text" name="size_name" class="form-control" placeholder="Size Name" >
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-primary" >Add Sizes</button>
            </div>
            
        </form>
    </div>
    
</div>
       
    </div>
</div>
@endsection