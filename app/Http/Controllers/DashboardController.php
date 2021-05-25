<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $cars = Car::count();
        $car_types = CarType::count();
        return view('dashboard', compact('cars', 'car_types'));
    }
}