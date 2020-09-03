<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\ReservationConfirmed;

class ReservationController extends Controller
{
    public function reserve(Request $request) {

        $this->validate($request, [
            'service_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'date_and_time' => 'required',
            'message' => 'required',
        ]);


        $reservation = new Reservation();
        $reservation->service_id = $request->service_id;
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->date_and_time =  $request->date_and_time;
        $reservation->message = $request->message;
        $reservation->status = false;
        $reservation->save();
        Toastr::success('Reservation request sent successfully. We will confirm to you shortly','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
}

