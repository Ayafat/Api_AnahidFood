
@extends('layout.admin')

@section('content')

<div class="row">
  <div class="col-12">
    

    <div class="card">
    
      <div class="card-header">
      
          <a href="{{ route('product-create') }}"  class="col-1 btn btn-block bg-gradient-warning">create</a>
       
          
      </div>
      <!-- /.card-header -->
       
      <div class="card-body ">
        <div class="col-sm-6">
          <h3 class="mb-3">ProductList</h3>
        </div>
        <table id="example1" class="table table-bordered table-striped mt-3">
          <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Restaurant</th>
            <th>Delete</th>
            <th>Edit</th>
          </tr>
          </thead>


          <tbody>
               
              @foreach ($products as $product)
              <tr>
              <td>{{ $product->name }}</td>
              <td>{{$product->price  }}</td>
              <td>{{$product->category()->name}}</td>
              <td>{{$product->restaurant()->title}}</td>
              <td><a href="#">Delete</a></td>
              <td><a href="#">Edit</a></td>
            </tr>
              @endforeach 
              
              
              
          
          </tbody>

          
               <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Restaurant</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                </tfoot>
          </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

@endsection

