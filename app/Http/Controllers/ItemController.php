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
        $categories = Category::get()->where('status',1);
        return view('admin_pannel.items.itemAdd',compact('categories'));
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'item_name'=>'required|min:2|max:255',
            'price'=>'required',
            'description'=>'required',
            'item_condition'=>'required',
            'item_type'=>'required',
            'status'=>'',
            'item_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number'=>'required|max:255',
            'owner_name'=>'required|min:2|max:255',
            'address'=>'required',
        ]);
        //dd($validator);
        if ($validator->fails()) {
            return redirect()->route('item')->with('error', 'Validation Error');
        }
        $category = Category::find($request->input('category_id'));

        $item = new Item();
        $item->item_name = $request->input('item_name');
        $item->price = $request->input('price');
        $item->category_id = $category->id;
        $item->description = $request->input('description');
        $item->item_condition = $request->input('item_condition');
        $item->item_type = $request->input('item_type');
        $item->status = $request->input('status');
        $item->phone_number = $request->input('phone_number');
        $item->owner_name = $request->input('owner_name');
        $item->address = $request->input('address');

        // Upload the category_photo to a folder
        if ($request->hasFile('item_photo')) {
            $image = $request->file('item_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/items/'), $imageName);

            // Save the image path in the database if needed
            $item->item_photo = 'images/items/' . $imageName;
        }
        $item->save();
        return redirect()->route('item')->with('success', 'Item added successfully');
    }
    public function edit(Item $item)
    {   
        $categories=Category::all();
        return view('admin_pannel.items.itemEdit',[
            'item'=>$item,
            'categories'=>$categories
        ]);
    }
    public function update(Request $request,Item $item)
    {
        
        $validator = Validator::make($request->all(), [
            'item_name'=>'required|min:2|max:255',
            'price'=>'required',
            'description'=>'required',
            'item_condition'=>'required',
            'item_type'=>'required',
            'status'=>'',
            'item_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number'=>'required|max:255',
            'owner_name'=>'required|min:2|max:255',
            'address'=>'required',
        ]);
        //dd($validator);
        if ($validator->fails()) {
            return redirect()->route('item')->with('error', 'Validation Error');
        }
        $category = Category::find($request->input('category_id'));

        // Check if the user uploaded a new category photo
        if ($request->hasFile('item_photo')) {
            $image = $request->file('item_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
     
            // Delete the existing category photo file, if it exists
            if ($item->item_photo && file_exists(public_path($item->item_photo))) {
                unlink(public_path($item->item_photo));
            }
     
            $image->move(public_path('images/items/'), $imageName);
     
            // Save the image path in the database
            $item->item_photo = 'images/items/' . $imageName;
        }
        //Update the item
        $item->item_name = $request->input('item_name');
        $item->price = $request->input('price');
        $item->category_id = $category->id;
        $item->description = $request->input('description');
        $item->item_condition = $request->input('item_condition');
        $item->item_type = $request->input('item_type');
        $item->status = $request->input('status');
        $item->phone_number = $request->input('phone_number');
        $item->owner_name = $request->input('owner_name');
        $item->address = $request->input('address');

        if ($item->save()) {
            return redirect()->route('item')->with('success', 'Updated successfully');
        }else {
            return back()->with('error', 'Cannot Update at the moment');
        }
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return back();
    }

}
