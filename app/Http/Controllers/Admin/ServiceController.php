<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.service.create', compact('categories'));
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
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
        ]);
        $image = $request->file('image');
         $filename = $image->getClientOriginalName();
         $filename = time(). '.' . $filename;
         $path =  'upload/service/'.$filename;
         $storage = Storage::disk('s3');
         $storage->put($path, fopen($image,  'r+'), 'public');

        $service = new Service();
        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image = $path;
        $service->save();

        Toastr::success('Service Successefully Saved!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->route('service.index');
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
       $service = Service::find($id);
       $categories = Category::all();
       return view('admin.service.edit',  compact('service', 'categories'));
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
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png'
        ]);

        $service = Service::find($id);
        $image = $request->file('image');
        $filename = $image->getClientOriginalName();
        $filename = time(). '.' . $filename;
        $path =  'upload/service/'.$filename;
        $storage = Storage::disk('s3');
        $storage->put($path, fopen($image,  'r+'), 'public');

        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image = $path;
        $service->save();
        Toastr::success('Slider Successefully Updated!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->route('service.index')->with('successMsg', 'Service Successefully Updated ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        Toastr::success('Slider Successefully Deleted!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->back();;
    }
}
