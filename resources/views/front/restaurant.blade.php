
   
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
              @foreach ($products as $product )
             
               <div class="col-md-4 mb-4">
                   <div class="card">
                       <div class="card-body">
                            
                           <h5 class="card-title">{{ $product->name }}</h5>
                           <p class="card-text">قیمت:{{ $product->price }}</p>
                           @if(Auth::user())
                           <a href="{{ route('basket.add',['product_id'=>$product->id,'restaurant_id'=>$restaurant->id]) }}" class="btn btn-primary">خرید</a>
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

        
    @endsection()

        
  
