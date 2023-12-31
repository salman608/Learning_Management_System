<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
    } //end

    public function StoreCourse(Request $request)
    {


        $request->validate([
            // 'video' => 'required|mimes:mp4|max:100000',
            'course_title' => 'required',
            'course_name' => 'required',
            'description' => 'required',
            'lavel' => 'required',
            'duration' => 'required',
            'resources' => 'required',
            'cirtificate' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'discount_price' => 'required',
            'prerequisites' => 'required',
        ]);

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('upload/course/thambnail/' . $name_gen);
        $save_url = 'upload/course/thambnail/' . $name_gen;

        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'), $videoName);
        $save_video = 'upload/course/video/' . $videoName;



        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace('', '-', $request->course_name)),
            'description' => $request->description,
            'video' => $save_video,
            // 'video' => $request->video,
            'lavel' => $request->lavel,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'cirtificate' => $request->cirtificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // Course Goal add Form

        $goals = count($request->course_goals);
        if ($goals != NULL) {
            for ($i = 0; $i < $goals; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }

        // Course Goal add Form End

        $notification = array(
            'message' => "Course Inserted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->route('all.course')->with($notification);
    }
}
