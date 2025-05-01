
   
       @extends('layout.homepage')
       
       @section('content')
       
       <h2 class="alert alert-success">restaurant {{ $restaurant->title }} </h2>
        </div> 
       
        <div class="container mt-4">

            <div class="row mt-2">
                <a href="{{ route('restaurant',['id'=>$restaurant->id]) }}">all</a>
                @foreach ($categories as $category )
                    <a href="{{ route('restaurant',['id'=>$restaurant->id,'category'=>$category->id]) }}">{{ $category->name }}</a>
                @endforeach

            </div>
        <!-- نمایش  تصویر رستوران -->
        
        <div class="text-center mb-5">
            <img src="{{ asset('img/'.$restaurant->image) }}" alt=" " class="img-fluid rounded" style="max-width: 600px;">
        </div>
        <div class="row">
            <p class="text-center">{{ $restaurant->address }}</p>
        </div>
        <!-- نمایش محصولات به صورت کارت -->
        <div class="row">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">قیمت: {{ $product->price }} تومان</p>
        
                                @if(Auth::user())
                                <form method="POST" action="{{ route('basket.add') }}" id="basket-form-{{ $product->id }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                
                                    <div class="input-group mb-3" style="width: 120px;">
                                       <!-- دکمه کم کردن -->
                                        <button type="button" class="btn btn-outline-secondary" onclick="decrease(this)">-</button>

                                        <!-- اینپوت تعداد -->
                                        <input type="number" name="count" class="form-control text-center" value="1" min="1" id="count-{{ $product->id }}">

                                        <!-- دکمه زیاد کردن -->
                                        <button type="button" class="btn btn-outline-secondary" onclick="increase(this)">+</button>

                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">خرید</button>
                                </form>
                                
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">محصولی برای این رستوران ثبت نشده</p>
            @endif
        </div>
        
         </div>

         <script>
            function increase(button) {
                var input = button.previousElementSibling;
                input.value = parseInt(input.value) + 1;
            }
            
            function decrease(button) {
                var input = button.nextElementSibling;
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            }
            </script>

         
             
     

        
    @endsection()

        
    