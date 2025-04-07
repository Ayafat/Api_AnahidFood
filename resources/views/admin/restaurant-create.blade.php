@extends('layout.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <form action="{{ route('restaurant-insert') }}" method="post">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                    
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3" placeholder="type the address"></textarea>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="text" class="form-control" name="image" id="image" placeholder="Image">
            </div>
            
            
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        <!-- /.card -->
      </div>
    </div>
  </div>
@endsection