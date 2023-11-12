<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grade.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.grade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validator = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'This filed is required!',
            'slug.required' => 'This filed is required!',
            'status.required' => 'This filed is required!',
        ]);

        $grade = new Grade();
        $grade->name = $request->name;
        $grade->slug = $request->slug;
        $grade->image = $this->saveImage($request);
        $grade->status = $request->status;
        $grade->is_feature = $request->is_feature;
        $grade->save();

        return  response()->json(['status'=>200]);
    }
    public function saveImage(Request $request){
        $image =$request->file('image');
        $imageName =rand().'.'.$image->getClientOriginalExtension();
        $path ='upload/grade/';
        $imageUrl = $path.$imageName;
        $image->move($path,$imageName);
        return $imageUrl;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::find($id);
        return view('admin.grade.edit',compact('grade'));
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
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'This filed is required!',
            'slug.required' => 'This filed is required!',
            'status.required' => 'This filed is required!',
        ]);

        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->slug = $request->slug;
        $grade->image = $this->saveImage($request);
        $grade->status = $request->status;
        $grade->is_feature = $request->is_feature;
        $grade->save();

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
        $grade = Grade::find($id);
        if ($grade->image){
            unlink($grade->image);
        }
        $grade->delete();

        return response()->json([
            'status'=>200
        ]);
    }
}
