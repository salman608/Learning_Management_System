<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function AllCourse()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->orderBy('id', 'DESC')->get();
        return view('instructor.courses.all_course', compact('courses'));
    } //end

    public function AddCourse()
    {
        $categories = Category::latest()->get();
        return view('instructor.courses.add_course', compact('categories'));
    } //end

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }
}
