@extends('layout.homepage')

@section('content')


<div class="row" style=margin:-0.5rem >
    @if (count($restaurants) == 0)
    <h2>نتیجه  ای یافت نشد.</h2>
    @endif
   
    @foreach ($restaurants as $restaurant)
        <div class="card mt-1 ms-1 me-3" style="width:15rem">
            <div class="card-body">
                <a href="{{ route('restaurant', ['id' => $restaurant->id]) }}">
                    <h4 class="card-title">{{ $restaurant->title }}</h4>
                </a>
                <img src="{{ asset('img/'.$restaurant->image) }}" width="170" height="100" alt="">
                <p class="card-text">{{ $restaurant->address }}</p>
            </div>
        </div>
    @endforeach 
  </div>





@endsection