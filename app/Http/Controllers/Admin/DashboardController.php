<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Service;
use App\Slider;
use App\Contact;
use App\Reservation;

class DashboardController extends Controller
{
    public function index() {

        $categoryCount = Category::count();
        $serviceCount = Service::count();
        $sliderCount = Slider::count();
        $contactCount = Contact::count();
        $reservations = Reservation::where('status', false)->get();
        return view('admin.dashboard', compact('categoryCount', 'serviceCount', 'sliderCount', 'contactCount', 'reservations'));
    }
}
