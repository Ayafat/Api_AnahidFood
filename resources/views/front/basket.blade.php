@extends('layout.homepage')

@section('content')


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ProductName</th>
          <th>Price</th>
          <th>Image</th>
          <th>Count</th>
          <th>Total</th>
          <th>Delete</th>
          <th>Edit</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($baskets as $basket)
        <tr>    
          <td>{{$basket->product->name}}</td>
          <td>{{$basket->product->price}} تومان</td>
          <td><img src="{{ asset('img/'. $basket->restaurant->image) }}" width="100" height="50" alt="restaurant image"></td>
          <td>{{$basket->count}}</td>
          <td>{{ $basket->count * $basket->product->price }} تومان</td>
          <td>
            <a href="{{ route('basket.delete',['id'=>$basket->id]) }}">Delete</a>
          </td>
          <td><a href="{{ route('basket.edit', ['id' => $basket->basket_id]) }}">Edit</a></td>
        </tr>
        @endforeach
      </tbody>

      <tfoot>
        <tr>
          <th>ProductName</th>
          <th>Price</th>
          <th>Image</th>
          <th>Count</th>
          <th>Total</th>
          <th>Delete</th>
          <th>Edit</th>
        </tr>
      </tfoot>
    </table>
</div>

<style>
  .payment-form {
    max-width: 400px;
    margin: 100px auto;
    padding: 30px;
    border-radius: 15px;
    background-color: #f8f9fa;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    text-align: center;
  }

  .payment-form input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 1.2rem;
    text-align: center;
    margin-bottom: 20px;
    border: 1px solid #ced4da;
    border-radius: 10px;
  }

  .payment-form input[type="submit"] {
    padding: 10px 25px;
    font-size: 1.1rem;
    border: none;
    border-radius: 10px;
    background-color: #28a745;
    color: white;
    cursor: pointer;
  }

  .payment-form input[type="submit"]:hover {
    background-color: #218838;
  }
</style>



<div class="payment-form">
  <form action="{{route('basket.checkout',['user_id'=>Auth::user()->id] )}}" method="POST">
    @csrf
    <label for="sum"><strong>جمع کل:</strong></label>
    <input type="text" id="sum" name="sum" value="{{ number_format($totalsum) }} تومان" readonly>
    <input type="submit" value="پرداخت">
  </form>
</div>


@endsection
