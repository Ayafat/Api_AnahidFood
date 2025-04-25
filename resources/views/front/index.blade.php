
@extends('layout.homepage')

@section('content')
 <div class="row">
   
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                $counter=0;
            @endphp
            @foreach ($sliderRestaurants as $sliderRestaurant)

            <div class="carousel-item {{  $counter == 0 ? 'active' : ''}}" >
                <img class="d-block w-100" src="{{asset('img/'.$sliderRestaurant->image) }}" style=height:70vh alt="First slide">
              </div>
            @php
                $counter ++;
            @endphp
                
            @endforeach
            
          
        </div>
       
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-ride="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-ride="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>   
<br>
<div class="row" style=margin:-0.5rem >
    <h2 class="text-end " style=color:blue >جدیدترین ها</h2>
    @foreach ($newrestaurants as $restaurant)
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
  <br>
<!-- نمایش  رستوران‌ها -->
<div class="row">
    <h2 class="text-end " style=color:blue >تمامی رستوران ها</h2>
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
  <br>
  <!-- نمایش بهترین رستوران‌ها -->
<div class="row" style=margin:-0.5rem >
    <h2 class="text-end " style=color:blue >بهترین ها</h2>
    @foreach ($toprestaurants as $restaurant)
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
    <br>
  <!--نمایش دسته بندیها-->
<div class="row">
    <h2 class="text-end " style=color:blue >دسته بندیها</h2>
    @foreach ($categories as $category)
        <div class="card mt-1 ms-1 me-3" style="width:15rem">
            <div class="card-body">
                <a href="{{ route('category', ['id' => $category->id]) }}">
                    <h4 class="card-title">{{ $category->name }}</h4>
                </a>
                
                <p class="card-text">{{ $category->description }}</p>
            </div>
        </div>
    @endforeach 
  </div>
  <br>

   <!--تعداد کاربران-->
<div class="row">
    <h2 class="text-end " style=color:blue >تعداد کاربران</h2>
    
        <div class="card mt-1 ms-1 me-3" style="width:15rem">
            <div class="card-body">  
                <p class="card-text">{{ $usercount }}</p>
            </div>
        </div>
   
  </div>
  <br>

<!-- صفحه‌بندی -->
<nav aria-label="Page navigation example">
    <ul class="pagination">
        {{-- دکمه قبلی --}}
        @if ($restaurants->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $restaurants->previousPageUrl() }}">Previous</a>
            </li>
        @endif
  
        {{-- نمایش شماره صفحات --}}
        @foreach ($restaurants->getUrlRange(1, $restaurants->lastPage()) as $page => $url)
            @if ($page == $restaurants->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endif
        @endforeach
  
        {{-- دکمه بعدی --}}
        @if ($restaurants->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $restaurants->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
  </nav>



@endsection
