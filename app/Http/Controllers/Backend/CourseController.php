<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
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
    } //end

    public function EditCourse($id)
    {
        $course = Course::find($id);
        $goals = Course_goal::where('course_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('instructor.courses.edit_course', compact('course', 'categories', 'subcategories', 'goals'));
    } //end


    public function UpdateCourse(Request $request)
    {


        $course_id = $request->course_id;


        Course::find($course_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace('', '-', $request->course_name)),

            'description' => $request->description,
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

        ]);



        $notification = array(
            'message' => "Course Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->route('all.course')->with($notification);
    } //end

    public function UpdateCourseImage(Request $request)
    {
        $course_id = $request->id;
        $oldImage = $request->old_image;

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('upload/course/thambnail/' . $name_gen);
        $save_url = 'upload/course/thambnail/' . $name_gen;


        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Course::find($course_id)->update([
            'course_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Course Image Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function UpdateCourseVideo(Request $request)
    {
        $course_id = $request->vid;
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'), $videoName);
        $save_video = 'upload/course/video/' . $videoName;


        if (file_exists($oldVideo)) {
            unlink($oldVideo);
        }

        Course::find($course_id)->update([
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Course Video Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    } //end

    public function UpdateCourseGoal(Request $request)
    {
        $course_goal_id = $request->id;
        if ($request->course_goals == NULL) {
            return redirect()->back();
        } else {
            Course_goal::where('course_id', $course_goal_id)->delete();

            $goals = count($request->course_goals);

            for ($i = 0; $i < $goals; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_goal_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            } //end for
        } //end else

        $notification = array(
            'message' => "Course Goal Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    } //end

    public function DeleteCourse($id)
    {
        $course = Course::find($id);
        unlink($course->course_image);
        unlink($course->video);

        Course::find($id)->delete();
        $goalData = Course_goal::where('course_id', $id)->get();
        foreach ($goalData as $item) {
            $item->goal_name;
            Course_goal::where('course_id', $id)->delete();
        }

        $notification = array(
            'message' => "Course  deleted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }



    ///////Add Course Lecture

    public function AddCourseLecture($id)
    {
        $course = Course::find($id);
        $section = CourseSection::where('course_id', $id)->latest()->get();
        return view('instructor.courses.section.add_course_lecture', compact('course', 'section'));
    }

    public function AddCourseSection(Request $request)
    {
        $cid = $request->id;
        CourseSection::insert([
            'course_id' => $cid,
            'section_title' => $request->section_title,
        ]);

        $notification = array(
            'message' => "Course Section Title Inserted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    } //end

    public function SaveLecture(Request $request)
    {

        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->url = $request->lecture_url;
        $lecture->content = $request->content;
        $lecture->save();

        return response()->json(['success' => 'Lecture Saved Successfully']);
    } // End Method

    public function EditLecture($id)
    {
        $clecture = CourseLecture::find($id);
        return view('instructor.courses.lecture.edit_course_lecture', compact('clecture'));
    }

    public function UpdateCourseLecture(Request $request)
    {
        $clecture_id = $request->id;
        CourseLecture::find($clecture_id)->update([
            'lecture_title' => $request->lecture_title,
            'url' => $request->url,
            'content' => $request->content,
        ]);
        $notification = array(
            'message' => "Course Lecture Updated Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    } //end

    public function DeleteLecture($id)
    {
        CourseLecture::find($id)->delete();
        $notification = array(
            'message' => "Course Lecture Deleted Successfully!",
            'alert-type' => "success"
        );
        return redirect()->back()->with($notification);
    }
}
