@extends('layout.homepage')

@section('content')

<form action="{{ route('basket.update') }}" method="POST">
@csrf

<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ProductName</th>
        <th>price</th>
        <th>Image</th>
        <th>count</th>
        <th>total</th>
      </tr>
    </thead>

    <tbody>
      @foreach ($baskets as $basket)
      <tr>
        <td>{{ $basket->product->name }}</td>
        <td>{{ $basket->product->price }} تومان</td>
        <td><img src="{{ asset('img/'. $basket->restaurant->image) }}" width="100" height="50" alt="restaurant image"></td>
        <td>
          <input type="number"
                 name="count[{{ $basket->id }}]"
                 class="form-control text-center"
                 value="{{ $basket->count }}"
                 min="1">
        </td>
        <td>{{ $basket->count * $basket->product->price }} تومان</td>
       
      </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <th>ProductName</th>
        <th>price</th>
        <th>Image</th>
        <th>count</th>
        <th>total</th>
      </tr>
    </tfoot>
  </table>

  <div class="text-center mt-3">
    <button type="submit" class="btn btn-warning">ویرایش سبد خرید</button>
  </div>
</div>

</form>

@endsection
