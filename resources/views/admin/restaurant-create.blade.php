@extends('layout.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <form action="{{ route('restaurant-insert') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
              @error('name')
              <span>نام را پر کنید</span>
                
              @enderror
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
              @error('address')
            <span>طول آدرس بیشتر از حد مجاز است</span>  
            @enderror 
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3" placeholder="type the address"></textarea>
            </div>
            <div class="form-group">

              @error('image')
            <span>invalid image</span>  
            @enderror
              <label for="image">Image</label>
              <input type="file" class="form-control" name="image" id="image" placeholder="Image" value=true>
            </div>
            <br>
            <div class="formgroup">
              <label for="slide">show in Slide</label>
              <input type="checkbox" class="form-control"  id="slide" name="slide" value=1 >

            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
        <!-- /.card -->
      </div>
    </div>
  </div>
@endsection