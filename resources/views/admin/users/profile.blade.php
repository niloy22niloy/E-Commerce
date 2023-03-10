@extends('layouts.dashboard');
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
        
    </ol>
</div>
<div class="container-fluid">
 <div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Chnage Name </h3>
            </div>
            <div class="card-body">
                <form action="{{route('name.update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">


                    </div>
                    <div class="mb-3">
                       
                        <button type="submit"  class="btn btn-success" >Update a Name</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Chnage Password</h3>
            </div>
            <div class="card-body">
                <form action="{{route('pass.update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        
                         @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        
                       
                             
                        @endif
                        <label for="" class="form-label">Old Password</label>
                        <input type="password" name="old_password" class="form-control" >
                      @error('old_password')
                      <strong class="text-danger">{{$message}}</strong>
                          
                      @enderror
                      @if(session('wrong_pass'))
                      <strong class="text-danger">{{session('wrong_pass')}}</strong>
                      @endif

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" >
                        @error('password')
                        <strong class="text-danger">{{$message}}</strong>
                            
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" >
                        @error('password_confirmation')
                        <strong class="text-danger">{{$message}}</strong>
                            
                        @enderror

                    </div>
                    <div class="mb-3">
                       
                        <button type="submit"  class="btn btn-success" >Update Password</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <img src="{{Auth::user()->image}}"  style="height:100px; width:100px; border-radius:50px;">
                
                <h3>Image Upload</h3>
            </div>
            <div class="card-body">
                <form action="{{route('upload.image')}}" method="POST"  enctype='multipart/form-data'>
                    @csrf
                    <div class="mb-3">
                        @if (session('success_image'))
                            <div class="alert alert-success">{{session('success_image')}}</div>
                        
                       
                             
                        @endif
                        
                        
                        <input type="file" name="photo">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
 </div>

</div>
@endsection