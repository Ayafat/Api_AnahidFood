
@extends('layout.admin')

@section('content')

<div class="row">
  <div class="col-12">
    

    <div class="card">
    
      <div class="card-header">
      
          <a href="{{ route('category-create') }}"  class="col-1 btn btn-block bg-gradient-warning">create</a>
       
          
      </div>
      <!-- /.card-header -->
       
      <div class="card-body ">
        <div class="col-sm-6">
          <h3 class="mb-3">CategoryList</h3>
        </div>
        <table id="example1" class="table table-bordered table-striped " >
          <thead>
          <tr >
            <th>Name</th>
            <th>Description</th>
            <th>Delete</th>
            <th>Edit</th>
          </tr>
          </thead>


          <tbody>
               
              @foreach ($categories as $category)
              <tr>
              <td>{{ $category->name }}</td>
              <td>{{ $category->description }}</td>
              <td><a href="#">Delete</a></td>
              <td><a href="#">Edit</a></td>
              </tr>
              @endforeach 
              
              
              
          
          </tbody>

          
               <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Description</th>
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

