<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(5);
        return view('admin_pannel.items.item',compact('items'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin_pannel.items.itemAdd',compact('categories'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'item_name'=>'required|min:2|max255',
            'price'=>'required',
            'description'=>'required',
            'item_condition'=>'required',
            'item_type'=>'required',
            'status'=>'',
            'item_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_name'=>'required|min:2|max255',
            'address'=>'required',
        ]);
        dd($validator);
        if ($validator->fails()) {
            return redirect()->route('category')->with('error', 'Validation Error');
        }


    }

}
