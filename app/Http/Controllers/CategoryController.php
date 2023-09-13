<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin_pannel.category',compact('categories'));
    }

    public function create()
    {
        return view('admin_pannel.categoryAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'=>'required|min:2|max:255',
            'status'=>'',
            'category_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category')->with('error', 'Validation Error');
        }

        // Store the category and status in the database
        $category = new Category();
        $category->category = $request->input('category');
        $category->status = $request->input('status');

        // Upload the category_photo to a folder
        if ($request->hasFile('category_photo')) {
            $image = $request->file('category_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Save the image path in the database if needed
            $category->category_photo = 'images/' . $imageName;
        }
        $category->save();
        return redirect()->route('category')->with('success', 'Category added successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin_pannel.categoryEdit',[
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|min:2|max:255',
            'status' => '',
            'category_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
     
        if ($validator->fails()) {
            return redirect()->route('category')->with('error', 'Cannot Update current Category');
        }
     
        // Check if the user uploaded a new category photo
        if ($request->hasFile('category_photo')) {
            $image = $request->file('category_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
     
            // Delete the existing category photo file, if it exists
            if ($category->category_photo && file_exists(public_path($category->category_photo))) {
                unlink(public_path($category->category_photo));
            }
     
            $image->move(public_path('images'), $imageName);
     
            // Save the image path in the database
            $category->category_photo = 'images/' . $imageName;
        }
     
        // Update other category properties
        $category->category = $request->input('category');
        $category->status = $request->input('status');
     
        if ($category->save()) {
            return redirect()->route('category')->with('success', 'Updated successfully');
        }else {
            return back()->with('error', 'Cannot Update at the moment');
        }
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }

}
