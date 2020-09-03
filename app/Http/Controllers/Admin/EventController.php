<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Brian2694\Toastr\Facades\Toastr;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listEvent() {
        $event = Event::latest()->get();
        return response()->json($event, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
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
            'start' => 'required',
            'end' => 'required',
            'note' => 'required',
            'color' => 'required',
            'text_color' => 'required',
        ]);
            $event = new Event();
            $event->title = $request->title;
            $event->start = $request->start;
            $event->end = $request->end;
            $event->note = $request->note;
            $event->color = $request->color;
            $event->text_color = $request->text_color;
            if(empty($request->id)) {
                if($event->save()) {
                    $event->refresh();
                    Toastr::success('Event Successfully added!', 'Success', ["positionClass" =>"toast-top-right"]);
                    return redirect()->back();
                }
            } else {
                Event::where('id', $request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'note' => $request->note,
                    'color' => $request->color,
                    'text_color' => $request->text_color
                ]);
                $event->refresh();
                Toastr::success('Event Successfully Updated!', 'Success', ["positionClass" =>"toast-top-right"]);
                return redirect()->back();
            }


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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(isset($request->id)){
            $event = Event::findOrFail($request->id);
            $event->delete();
            return response()->json(['success' => 'Event successfully deleted']);
      }

    }
}
