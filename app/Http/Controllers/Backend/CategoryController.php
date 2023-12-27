<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    public function AddCategory()
    {
        return view('admin.backend.category.add_category');
    } //end

    public function StoreCategory(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('upload/category/' . $name_gen);
        $save_url = 'upload/category/' . $name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => "Category Inserted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    } //end

    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 246)->save('upload/category/' . $name_gen);
            $save_url = 'upload/category/' . $name_gen;

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => "Category Update with Image!",
                'alert-type' => "success"
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),

            ]);

            $notification = array(
                'message' => "Category Update without Image!",
                'alert-type' => "success"
            );
            return redirect()->route('all.category')->with($notification);
        }
    } //end

    public function DeleteCategory($id)
    {
        $item = Category::find($id);
        $img = $item->image;
        unlink($img);
        Category::find($id)->delete();

        $notification = array(
            'message' => "Category Deleted Successfull!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }

    ////////////All Sub Category Method Start//////////

    public function AllSubCategory()
    {
        $subcategory = SubCategory::get();
        return view('admin.backend.subcategory.all_subcategory', compact('subcategory'));
    }
}
