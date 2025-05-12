<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminCategoryApiController extends Controller
{
    public function index(){
        return Category::paginate(10);
    }
    public function show($id){
        return Category::findOrFail($id);
    }
    public function create(Request $request){
       $data=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:600',
           
        ],["required"=>"فیلد نام حتما باید پر شود"]);

        if($data->errors()->any()){
            return $data->errors();
        }

        return Category::create(
           $request->all()
        );

    }

    public function update(Request $request,$id){

        $category = Category::findOrFail($id);
        return $category->update($request->all());
    }

    public function delete($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['message' => 'رستوران مورد نظر پیدا نشد.'], 404);
        }
    
        $category->delete();
    
        return response()->json(['message' => 'رستوران با موفقیت حذف شد.'], 200);
    }


    
}
