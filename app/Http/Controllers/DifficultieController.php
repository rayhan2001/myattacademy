<?php

namespace App\Http\Controllers;

use App\Models\Difficultie;
use Illuminate\Http\Request;

class DifficultieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $difficulties = Difficultie::all();
        return view('admin.difficulties.index',compact('difficulties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.difficulties.create');
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
            'name' => 'required',
            'slug' => 'required',
        ], [
            'name.required' => 'This filed is required!',
            'slug.required' => 'This filed is required!',
        ]);

        $difficulty = new Difficultie();
        $difficulty->name = $request->name;
        $difficulty->slug = $request->slug;
        $difficulty->save();

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
        $difficulty = Difficultie::find($id);
        return view('admin.difficulties.edit',compact('difficulty'));
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
        ], [
            'name.required' => 'This filed is required!',
            'slug.required' => 'This filed is required!',
        ]);

        $difficulty = Difficultie::find($id);
        $difficulty->name = $request->name;
        $difficulty->slug = $request->slug;
        $difficulty->save();

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
        $difficulty = Difficultie::find($id);
        $difficulty->delete();

        return response()->json(['status'=>200]);
    }
}
