<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Language;
use App\Models\Unit;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $grades = Grade::all();
        return view('admin.course.create',compact('languages','grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'course_name' => 'required',
            'slug' => 'required',
            'instructor_name' => 'required',
            'price' => 'required',
            'difficulties' => 'required',
            'language' => 'required',
            'course_type' => 'required',
            'grade' => 'required',
            'course_status' => 'required',
            'intro_video' => 'required',
            'video_link' => 'required_if:intro_video,1',
            'short_description' => 'required',
            'long_description' => 'required',
        ],[
            'video_link.required'=>'The field is required.'
        ]);

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->slug = $request->slug;
        $course->instructor_name = $request->instructor_name;
        $course->price = $request->price;
        $course->difficulties = $request->difficulties;
        $course->language_id = $request->language;
        $course->course_type = $request->course_type;
        $course->grade_id = $request->grade;
        $course->course_status = $request->course_status;
        $course->intro_video = $request->intro_video;
        $course->video_link = $request->video_link;
        $course->short_description = $request->short_description;
        $course->long_description = $request->long_description;
        $course->save();

        return response()->json(['status'=>200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $units = Unit::all();
        return view('admin.course.show',compact('course','units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $languages = Language::all();
        $grades = Grade::all();
        return view('admin.course.edit',compact('course','languages','grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'course_name' => 'required',
            'slug' => 'required',
            'instructor_name' => 'required',
            'price' => 'required',
            'difficulties' => 'required',
            'language' => 'required',
            'course_type' => 'required',
            'grade' => 'required',
            'course_status' => 'required',
            'intro_video' => 'required',
            'video_link' => 'required_if:intro_video,1',
            'short_description' => 'required',
            'long_description' => 'required',
        ],[
            'video_link.required'=>'The field is required.'
        ]);

        $course = Course::find($id);
        $course->course_name = $request->course_name;
        $course->slug = $request->slug;
        $course->instructor_name = $request->instructor_name;
        $course->price = $request->price;
        $course->difficulties = $request->difficulties;
        $course->language_id = $request->language;
        $course->course_type = $request->course_type;
        $course->grade_id = $request->grade;
        $course->course_status = $request->course_status;
        $course->intro_video = $request->intro_video;
        $course->video_link = $request->video_link;
        $course->short_description = $request->short_description;
        $course->long_description = $request->long_description;
        $course->save();

        return response()->json(['status'=>200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();

        return response()->json(['status'=>200]);
    }

//    Unit Section
    public function createUnit($id){
        $course = Course::find($id);
        return view('admin.course.create_unit',compact('course'));
    }

    public function storeUnit(Request $request){
        $validator = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ]);

        $unit = new Unit();
        $unit->course_id = $request->course_id;
        $unit->grade_id = $request->grade_id;
        $unit->title = $request->title;
        $unit->slug = $request->slug;
        $unit->sub_title = $request->sub_title;
        $unit->description = $request->description;
        $unit->save();

        return response()->json(['status'=>200]);
    }
    public function editUnit($id){
        $unit = Unit::find($id);
        return view('admin.course.edit_unit',compact('unit'));
    }
    public function updateUnit(Request $request, $id){
        $validator = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ]);

        $unit = Unit::find($id);
        $unit->course_id = $request->course_id;
        $unit->grade_id = $request->grade_id;
        $unit->title = $request->title;
        $unit->slug = $request->slug;
        $unit->sub_title = $request->sub_title;
        $unit->description = $request->description;
        $unit->status = $request->status;
        $unit->save();

        return response()->json(['status'=>200]);
    }
    public function deleteUnit($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return response()->json(['status'=>200]);
    }
}
