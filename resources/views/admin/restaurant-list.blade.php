@extends('layout.admin')

@section('content')

<div class="row">
  <div class="col-12">
    

    <div class="card">
    
      <div class="card-header">
      
          <a href="{{ route('restaurant-create') }}"  class="col-1 btn btn-block bg-gradient-warning">create</a>
       
          
      </div>
      <!-- /.card-header -->
       
      <div class="card-body ">
        <table id="example1" class="table table-bordered table-striped " >
          <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Image</th>
            <th>Delete</th>
            <th>Edit</a></th>
          </tr>
          </thead>


          <tbody>
            @foreach ($restaurants as $restaurant)
            <tr>    
              <td>{{$restaurant->title  }}</td>
              <td>{{$restaurant->address }}</td>
              <td><img src="{{ asset('img/'. $restaurant->image.'.jpg') }}" width="100" height="50" alt="restaurant image"></td>
              <td><a href="#">Delete</a></td>
              <td><a href="#">Edit</a></td>
              
              </tr>
            @endforeach
              
          
          </tbody>

          
               <tfoot>
                <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Image</th>
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

