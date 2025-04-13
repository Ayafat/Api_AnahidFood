
   
       @extends('layout.homepage')
       
       @section('content')
       
       <h2 class="alert alert-success">restaurant {{ $restaurant->title }} </h2>
        </div> 
       
        <div class="container mt-4">
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
                           <a href="#" class="btn btn-primary">خرید</a>
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

        
  
