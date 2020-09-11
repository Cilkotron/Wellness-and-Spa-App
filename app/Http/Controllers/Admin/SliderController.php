<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);


         $image = $request->file('image');
         $filename = $image->getClientOriginalName();
         $filename = time(). '.' . $filename;
         $path =  'upload/'.$filename;
         $storage = Storage::disk('s3');
         $storage->put($path, fopen($image,  'r+'), 'public');

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $path;
        $slider->save();

        Toastr::success('Slider Successefully Saved!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->route('slider.index');

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
       $slider = Slider::find($id);
       return view('admin.slider.edit',  compact('slider'));
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
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png'
        ]);
        $slider = Slider::find($id);
        $image = $request->file('image');
        $filename = $image->getClientOriginalName();
        $filename = time(). '.' . $filename;
        $path =  'upload/'.$filename;
        $storage = Storage::disk('s3');
        $storage->put($path, fopen($image,  'r+'), 'public');

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $path;
        $slider->save();
        Toastr::success('Slider Successefully Updated!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        Toastr::success('Slider Successefully Deleted!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->back();
    }
}
