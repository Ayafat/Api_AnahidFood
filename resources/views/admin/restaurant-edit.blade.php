@extends('layout.admin')
@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <form action="{{ route('restaurant-update') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $restaurant->title }}">
              <input type="hidden" name="id" value="{{ $restaurant->id}}"/>
            </div>
            <div class="form-group">
                    
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3" placeholder="type the address">{{ $restaurant->address }}</textarea>
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" name="image" id="image" placeholder="Image" value="{{ $restaurant->image }}">
            </div>

            <div class="formgroup">
              <label for="slide">show in Slide</label>
              <input type="checkbox" class="form-control"  id="slide" name="slide" value=1 {{ $restaurant->slide == 1 ? 'checked' :'' }} >

            </div>
            
            
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