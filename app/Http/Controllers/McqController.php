<?php

namespace App\Http\Controllers;

use App\Models\Mcq;
use Illuminate\Http\Request;

class McqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcqs = Mcq::all();
        return view('admin.mcq.index',compact('mcqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mcq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $options = json_encode($request->option);


        $mcq = new Mcq();
        $mcq->question = $request->question;
        $images = array();
        $files = $request->file('image_thumbnail');
//        dd($files);
        if (!empty($files)){
            foreach ($files as $file){
                $imageName = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $imageFullName = $imageName.'.'.$ext;
                $dir = 'upload/mcq_image/';
                $imageUrl=$dir.$imageFullName;
                $file->move($dir,$imageFullName);
                $images[]=$imageUrl;
            }
            $mcq['image_thumbnail']=implode("|",$images);
        }
        $mcq->option = $options;

        $option_images = array();
        $img = $request->file('option_image');
        if (!empty($img)){
            foreach ($img as $item){
                $imageName = md5(rand(1000, 10000));
                $ext = strtolower($item->getClientOriginalExtension());
                $imageFullName = $imageName.'.'.$ext;
                $dir = 'upload/mcq_image/';
                $imageUrl=$dir.$imageFullName;
                $item->move($dir,$imageFullName);
                $option_images[]=$imageUrl;
            }
            $mcq['option_image']=implode("|",$option_images);
        }
        $mcq->answer = $request->answer;
        $mcq->save();
        return  redirect()->back();

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
        $mcq = Mcq::find($id);
        return  view('admin.mcq.edit',compact('mcq'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
