@extends('layouts.dashboard');
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Users List</a></li>
        
    </ol>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 m-auto">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Welcome , {{Auth::user()->name}} User List:-  </h3>
                    <span class="">  Total Users :{{$total_user}}</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
 <tr>
    <th>Sl</th>
    <th>Image</th>
    <th>name</th>
    <th>email</th>
    <th>Created at</th>
    <th>Action</th>
 </tr>
 @foreach($users as $key=>$user)
 <tr>
    <td>{{$key+1}}</td>
    <td>
        @if ($user->image == null)
        <img width='50' src="{{ Avatar::create($user->name)->toBase64() }}" />
            @else
            <img src="{{asset('dashboard_asset/images/profile/17.jpg')}}" width="20" alt=""/>
        @endif
    </td>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->created_at->diffForHumans()}}</td>
    <td>
        <a href="{{route('delete',$user->id)}}" class="btn btn-danger">Delete</a>
    </td>
 </tr>
 @endforeach
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection