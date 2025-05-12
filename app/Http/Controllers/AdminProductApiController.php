<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminProductApiController extends Controller
{
    public function index(){
        return Product::paginate(10);
    }

    public function show($id){
        return Product::findOrFail($id);
    }

    public function create(Request $request)
    {
        $data=Validator::make($request->all(), [
            'name'=>'required|string|max:30',
            'price'=>'integer|required',
             'category_id' => 'required|integer|exists:categories,id',
            'restaurant_id' => 'required|integer|exists:restaurants,id'
        ]);

        if($data->errors()->any()){
            return $data->errors();
        }

       

        $name=$request->input('name');
        $price=$request->input('price');
        $category_id=$request->input('category_id');
        $restaurant_id=$request->input('restaurant_id');
      

        Product::create([
            'name'=>$name,
            'price'=>$price,
            'category_id'=>$category_id,
            'restaurant_id'=>$restaurant_id
           
        ]);
    }


    public function update(Request $request, $id)
    {
        // گرفتن مدل
        $product = Product::findOrFail($id);
    
        // لاگ گرفتن از اطلاعات قبلی
        Log::info('Before Update:', $product->toArray());
    
        // لاگ گرفتن از داده‌های جدید
        Log::info('Request Data:', $request->all());
    
        // آپدیت اطلاعات
        $result = $product->update($request->all());
    
        // گرفتن داده‌های جدید از دیتابیس بعد از آپدیت (جهت اطمینان)
        $freshProduct = Product::find($id);
        Log::info('After Update:', $freshProduct->toArray());
    
        // ثبت نتیجه آپدیت
        Log::info('Update Result: ' . ($result ? 'Success' : 'Failed'));
    
        // پاسخ به کاربر
        return response()->json([
            'success' => $result,
            'data' => $freshProduct
        ]);
    }


    public function delete($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'رستوران مورد نظر پیدا نشد.'], 404);
        }
    
        $product->delete();
    
        return response()->json(['message' => 'رستوران با موفقیت حذف شد.'], 200);
    }
}
