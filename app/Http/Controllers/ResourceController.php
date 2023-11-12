<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::all();
        return view('admin.resource.index',compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resource.create');
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
            'file' => 'required|file|mimes:csv,txt,xlx,xls,jpeg,png,pdf|max:2048',
            'status' => 'required',
        ]);

        $resource = new Resource();
        $resource->file = $this->saveFile($request);
        $resource->status = $request->status;
        $resource->save();

        return response()->json(['status' => 200]);
    }

    public function saveFile(Request $request){
        $file =$request->file('file');
        $fileName =rand().'.'.$file->getClientOriginalExtension();
        $path ='upload/resource/';
        $fileUrl = $path.$fileName;
        $file->move($path,$fileName);
        return $fileUrl;
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
        $resource = Resource::find($id);
        return view('admin.resource.edit',compact('resource'));
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
            'file' => 'required|file|mimes:csv,txt,xlx,xls,jpeg,png,pdf|max:2048',
            'status' => 'required',
        ]);

        $resource = Resource::find($id);
        $resource->file = $this->saveFile($request);
        $resource->status = $request->status;
        $resource->save();

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = Resource::find($id);
        if ($resource->file){
            unlink($resource->file);
        }
        $resource->delete();

        return response()->json([
            'status'=>200
        ]);
    }
}
