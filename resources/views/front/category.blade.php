
       @extends('layout.homepage')
       
       @section('content')
       <div>
       <h2 class="alert alert-success">category {{ $category->name }} </h2>
        </div> 
       
        <div class="row">
            <p class="text-center">{{ $category->description }}</p>
        </div>
        <!-- نمایش محصولات به صورت کارت -->
        <div class="row">
            @if (count($products) > 0)
              @foreach ($category->products() as $product )
             
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
               <p class="text-center">محصولی برای این دسته بندی ثبت نشده</p>
              
               @endif   
             
              
          
   </div>
         </div>

        
    @endsection()

        
  