@extends('layout.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <form action="{{ route('category-update') }}" method="post">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $category["name"] }}">
            </div>
            <div class="form-group">
                    
              <label>Description</label>
              <textarea class="form-control" name="description" rows="3" placeholder="Description" >{{ $category["description"] }}</textarea>
            </div>
            <input type="hidden" name='id' value="{{ $category["id"] }}">
            
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </form>
        <!-- /.card -->
      </div>
    </div>
  </div>
    
@endsection