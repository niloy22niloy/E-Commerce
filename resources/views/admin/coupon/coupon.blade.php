@extends('layouts.dashboard');
@section('content')
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Coupon</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
 <div class="card">
    <div class="card-header">
        <h3>Coupon List</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>SL</th>
                <th>Coupon</th>
                <th>Type</th>
                <th>Ammount</th>
                <th>Validity</th>
                <th>Action</th>
            </tr>
            @foreach ($coupons as $key=>$coupon )
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$coupon->coupon_code}}</td>
                <td>{{$coupon->type==1?'Percentage':'Solid'}}</td>
                <td>{{$coupon->amount}}</td>
                <td><div class="bdge badge-primary text-center" style="width:100px;">{{Carbon\Carbon::now()->diffInDays($coupon->validity,false)}}days left</div></td>
                <td>
                    <a href=""class="btn btn-success">Delete</a>
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
                <h3>Add Coupon</h3>
            </div>
            <div class="card-body">
                <form action="{{route('coupon.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="" class="form-label">Coupon Code</label>
                  <input type="text" name="coupon_code" class="form-control">
                </div>
                <div class="mb-3">
                    <select name="type" class="form-control" id="">
                        <option value="">--Select type----</option>
                        <option value="1">Percentage</option>
                        <option value="2">Solid Ammount</option>


                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount Ammount</label>
                    <input type="number" name="amount" class="form-control">
                    
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Validity</label>
                 <input type="date" name="validity" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection