<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use App\Event;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Notifications\ReservationConfirmed;
use Illuminate\Support\Facades\Notification;


class ReservationController extends Controller
{
    public function index() {
        $reservations = Reservation::all();
        return view('admin.reservation.index', compact('reservations'));
    }

    public function status($id) {
        $reservation = Reservation::find($id);
        $reservation->status = true;
        Notification::route('mail', $reservation->email)
            ->notify(new ReservationConfirmed());
        $reservation->save();
        Toastr::success('Reservation successfully confirmed!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->back();
    }
    public function destroy($id) {
        Reservation::find($id)->delete();
        Toastr::success('Reservation successfully deleted!', 'Success', ["positionClass" =>"toast-top-right"]);
        return redirect()->back();
    }

    public function calendar(){
        $reservations = Reservation::where('status', false)->get();
        $events = Event::all();
        return view('admin.reservation.calendar', compact('reservations', 'events'));
    }

}

