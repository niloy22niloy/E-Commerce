@extends('layouts.dashboard')
@section('content')
<div class="row">
<div class="col-lg-8 m-auto">
    <div class="card " >
        <div class="card-header">
            <h3>Edit Categorie </h3>
            
        </div>
        <div class="card-body">
            <form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Categorie Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{$category_info->category_name}}">
                    <input type="hidden" name="category_id"  value="{{$category_info->id}}">
                      @error('category_name')

                      <strong class="text-success">{{$message}}</strong>    
                      @enderror
                      {{-- @if(session()->has('message'))

                        @endif --}}
                        @if(session()->has('message'))
{{-- <div class="alert alert-success">
{{ session()->get('message') }}
</div> --}}
<strong class="text-success">{{session()->get('message')}}</strong>
@endif

                </div>
                <div class="mb-3">
                 <label for="" class="form-label">Categorie Image</label>
                 <input type="file" name="category_image" class="form-control" value=""    onchange="document.getElementById('category_image').src = window.URL.createObjectURL(this.files[0])">
                 <br>
                 <img id="category_image" src="{{asset('uploads/category')}}/{{$category_info->category_image}}" style="width:200px;"> 


             </div>
                <div class="mb-3">
                   
                    <button type="submit"  class="btn btn-danger" >Update Categorie</button>


                </div>
            </div>
            </form>
@endsection