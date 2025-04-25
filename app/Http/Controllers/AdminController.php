<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\RestaurantRequest;


class AdminController extends Controller
{
    public function admin(){
       
        return view('admin.panel');
    }

    public function categoryList(){
        $categories=Category::all();
        return view('admin.category-list',['categories'=>$categories]);
    }
    public function productList(){
        $products=Product::all();
        return view('admin.product-list',['products'=>$products]);
    }
    public function restaurantList(){
        $restaurants=Restaurant::all();
        return view('admin.restaurant-list',['restaurants'=>$restaurants]);
    }
    public function restaurantCreate(){
        return view('admin.restaurant-create');
    }
    public function restaurantInsert(RestaurantRequest $request){
         // بررسی نام و آدرس تکراری
    $duplicateRestaurant = Restaurant::where('title', $request->input('name'))
    ->where('address', $request->input('address'))
    ->exists();

        if ($duplicateRestaurant) {
            return redirect()->back()->withErrors(['duplicate' => 'نام و آدرس این رستوران قبلاً ثبت شده است.']);
        }
        $request->validated();
        $name=$request->input('name');
        $address=$request->input('address');
        $imageName = null;
        $slide=$request->input('slide');
       // $image=$request->input('image');
       if ($request->hasFile('image')) {
        $uploadedFile = $request->file('image');
        $originalName = $uploadedFile->getClientOriginalName();
        $imagePath = public_path('img/' . $originalName);

        // اگر عکس قبلاً در دیتابیس ذخیره شده باشد، دوباره آپلود نکن
        $existingImage = Restaurant::where('image', $originalName)->exists();
        
        if (!$existingImage) {
            // اگر این عکس قبلاً در مسیر ذخیره نشده باشد، ذخیره کن
            if (!file_exists($imagePath)) {
                $uploadedFile->move(public_path('img'), $originalName);
            }
        }

        // ذخیره نام عکس در دیتابیس (اگر تکراری بود فقط اسمش ذخیره می‌شود)
        $imageName = $originalName;
    }
        
        Restaurant::create([
            'title'=>$name,
            'address'=>$address,
            'image'=>$imageName,
            'slide'=>$slide
        ]);
        return redirect(route('restaurant-list'));
    }

    public function categoryCreate(){
        return view('admin.category-create');
    }

    public function categoryInsert(Request $request){
        $name=$request->input('name');
        $description=$request->input('description');

         
        Category::create([
            'name'=>$name,
            'description'=>$description
        ]);
        return redirect(route('category-list'));

    }

    public function productCreate(){
        $categories=Category::all();
        $restaurants=Restaurant::all();
        return view('admin.product-create',[
            'categories'=>$categories,
            'restaurants'=>$restaurants
        ]);
    }

    public function productInsert(Request $request){
        $name=$request->input('name');
        $price=$request->input('price');
        $category_id=$request->input('category');
        $restaurant_id=$request->input('restaurant');

         
        Product::create([
            'name'=>$name,
            'price'=>$price,
            'category_id'=>$category_id,
            'restaurant_id'=>$restaurant_id
            
        ]);
        return redirect(route('product-list'));

    }

    public function restaurantEdit($id){

        $restaurant=Restaurant::find($id);
        return view('admin.restaurant-edit',['restaurant'=>$restaurant]);
    }  
    
   /* public function restaurantUpdate(Request $request){

        $title=$request->input('name');
        $address=$request->input('address');
        $image=$request->input('image');

        Restaurant::findOrfail($request->input('id'))
        ->update([
            'title'=>$title,
            'address'=>$address,
            'image'=>$image
        ]);

        return redirect(route('restaurant-list'));
    }*/

    public function restaurantUpdate(RestaurantRequest $request)
    {
        $restaurant = Restaurant::findOrFail($request->input('id'));
    
      // بررسی اینکه آیا هم نام و هم آدرس باهم تکراری هستند یا نه
        $duplicateRestaurant = Restaurant::where('title', trim($request->input('name')))
            ->where('address', trim($request->input('address')))
            ->where('id', '!=', $restaurant->id) // خودش را بررسی نکند
            ->exists();
    
        if ($duplicateRestaurant) {
            return redirect()->back()->withErrors(['duplicate' => 'نام و آدرس این رستوران قبلاً ثبت شده است.']);
        }
    
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string|max:500',
            'image' => 'nullable|mimes:png,jpg',
            'slide' => 'nullable|boolean',
        ]);
    
        // مقدار پیش‌فرض عکس همان مقدار قبلی است
        $imageName = $restaurant->image;
    
        // اگر تصویر جدید آپلود شده باشد
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $originalName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME); // نام اصلی بدون پسوند
            $extension = $uploadedFile->getClientOriginalExtension();
            $newImageName = $originalName . '.' . $extension; // نام فایل بدون هش
    
            // بررسی کنیم که آیا این فایل قبلاً در مسیر public/img ذخیره شده یا نه
            if (!file_exists(public_path('img/' . $newImageName))) {
                // حذف عکس قبلی در صورت وجود
                if ($restaurant->image && file_exists(public_path('img/' . $restaurant->image))) {
                    unlink(public_path('img/' . $restaurant->image));
                }
                // اگر فایل وجود ندارد، آن را ذخیره کنیم
                $uploadedFile->move(public_path('img'), $newImageName);
            }
    
            // مقدار تصویر را در دیتابیس ذخیره کنیم
            $imageName = $newImageName;
        }
    
        // مقدار `is_slide` را تنظیم کنید (در صورت `null` بودن، `false` قرار دهید)
        $Slide = $request->input('slide', false);
    
        // آپدیت اطلاعات رستوران
        $restaurant->update([
            'title' => trim($request->input('name')),
            'address' => trim($request->input('address')),
            'image' => $imageName, // مقدار عکس فقط در صورت تغییر عوض می‌شود
            'slide' => $Slide,
        ]);
    
        return redirect(route('restaurant-list'))->with('success', 'رستوران با موفقیت ویرایش شد.');
    }


    public function categoryEdit($id){
        $category=Category::find($id);
        return view('admin.category-edit',['category'=>$category]);
    }

    public function categoryUpdate(Request $request){
        $name=$request->input('name');
        $description=$request->input('description');
       

        Category::findOrfail($request->input('id'))
        ->update([
            'name'=>$name,
            'description'=>$description
            
        ]);

        return redirect(route('category-list'));
    }

    public function productEdit($id){
        $product=Product::find($id);
        $categories=Category::all();
        $restaurants=Restaurant::all();
        return view('admin.product-edit',[
            'product'=>$product,
            'categories'=>$categories,
            'restaurants'=>$restaurants
        ]);
    }

    public function productUpdate(Request $request){
        $name=$request->input('name');
        $price=$request->input('price');
        $category_id=$request->input('category');
        $restaurant_id=$request->input('restaurant');

        Product::findOrfail($request->input('id'))
        ->update([
            'name'=>$name,
            'price'=>$price,
            'category_id'=>$category_id,
            'restaurant_id'=>$restaurant_id
        ]);

        return redirect(route('product-list'));
    }

    public function categoryDelete($id){
        Category::findOrfail($id)->delete();
        return redirect(route('category-list'));
        
    }

    public function productDelete($id){
        Product::findOrfail($id)->delete();
        return redirect(route('product-list'));
        
    }

    public function restaurantDelete($id){
        Restaurant::findOrfail($id)->delete();
        return redirect(route('restaurant-list'));
        
    }


}
