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
               <h3>Inventory/{{$product_info->product_name}}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
          <tr>
            <th>Serial</th>
            <th>color</th>
            <th>size</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
          @foreach ($inventory as $key=>$invent)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$invent->rel_to_color->color_name}}</td>
            <td>{{$invent->rel_to_size->size_name}}</td>
            <td>{{$invent->quantity}}</td>
            <td>
                <button type="submit" name="submit" class="btn btn-success">DELETE</button>
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
        <h3>Add Inventory/{{$product_info->product_name}}</h3>

    </div>
    <div class="card-body">
        <form action="{{route('inventory.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Product Thumbnails</label>
                <input type="text" hidden name="product_id"  class="form-control" value="{{$product_info->id}}">
                <input type="text" readonly class="form-control" value="{{$product_info->product_name}}">
            </div>
            <div class="mb-3">
                <select name="color_id" id="" class="form-control">
                    <option value="">---Select Color-----</option>
                    @foreach ($colors as $key=>$color )
                    <option value="{{$color->id}}">{{$color->color_name}}</option>    
                    @endforeach
                    
                </select>
            </div>
            <div class="mb-3">
                <select name="size_id" id="" class="form-control">
                    <option value="">---Select Size-----</option>
                    @foreach ($sizes as $key=>$size )
                    <option value="{{$size->id}}">{{$size->size_name}}</option>    
                    @endforeach
                    
                </select>
            </div>
            <div class="mb-3">
                <input type="number" name="quantity" class="form-control" placeholder="quantity" >
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" class="btn btn-primary" >Add Inventory</button>
            </div>
        </form>
    </div>
</div>
       
    </div>
</div>
@endsection