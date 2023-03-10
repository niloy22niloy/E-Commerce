@extends('layouts.dashboard');
@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                Edit Product From Product List

            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="sub">Submit</button>
                    

                </form>
            </div>
        </div>
    </div>
</div>



@endsection