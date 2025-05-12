<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRestaurantApiController extends Controller
{
    public function index(){
        return Restaurant::paginate(10);
    }

    public function show($id){
        return Restaurant::findOrFail($id);
    }

    public function create(Request $request)
    {
        $data=Validator::make($request->all(), [
            'name'=>'required|string|max:15',
            'image'=>'nullable|mimes:png,jpg',
            'address'=>'required|max:500',
            'is_slide' => 'nullable|boolean',
           
        ]);

        if($data->errors()->any()){
            return $data->errors();
        }

       

        $name=$request->input('name');
        $address=$request->input('address');
        $image=time().'-'.$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img'),$image);
        $slide=$request->input('slide');

        Restaurant::create([
            'title'=>$name,
            'address'=>$address,
            'image'=>$image,
            'slide'=>$slide ?? 0
        ]);
    }


      public function update(Request $request,$id)
     {
 
         $restaurant = Restaurant::findOrFail($id);
         if($restaurant->title != $request->input('name')){
            $data=Validator::make($request->all(),[
                'name'=>'required|unique:restaurants,title'
            ]);
                
          if($data->errors()->any()) {
            return $data->errors();
            }
        }
         return $restaurant->update($request->all());
      
    }


    public function delete($id)
    {
        $restaurant = Restaurant::find($id);
    
        if (!$restaurant) {
            return response()->json(['message' => 'رستوران مورد نظر پیدا نشد.'], 404);
        }
    
        $restaurant->delete();
    
        return response()->json(['message' => 'رستوران با موفقیت حذف شد.'], 200);
    }
 

    }