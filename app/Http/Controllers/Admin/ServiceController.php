<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
        $slug = Str::slug($request->name);
        if(isset($image)) {
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentData .'-'. uniqid() .'-'. $image->getClientOriginalExtension();
            if(!file_exists('uploads/service')) {
                mkdir('uploads/service', 0777, true);
            }
            $image->move('uploads/service', $imagename);
        } else {
            $imagename = 'service.png';
        }

        $service = new Service();
        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image = $imagename;
        $service->save();

        return redirect()->route('service.index')->with('successMsg', 'Service Successefully Added');
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

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $service = Service::find($id);
        if(isset($image)) {
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentData .'-'. uniqid() .'-'. $image->getClientOriginalExtension();
            if(!file_exists('uploads/service')) {
                mkdir('uploads/service', 0777, true);
            }
            $image_path = app_path('uploads/service/'.$service->image);
            if(File::exists($image_path)) {
                File::delete($image_path);

            }
            $image->move('uploads/service', $imagename);
        } else {
            $imagename = $service->image;
        }

        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image = $imagename;
        $service->save();

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
        if(file_exists('uploads/service/' .$service->image)) {
            unlink('uploads/service/' .$service->image);
        }
        $service->delete();
        return redirect()->back()->with('successMsg', 'Service Successfully Deleted!');
    }
}
