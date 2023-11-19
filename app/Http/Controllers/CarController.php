<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function showForm()
    {
        return view('add-car-form');
    }

    public function addCar(Request $request)
    {
        $data = $request->all();
        return redirect()->route('show-car')->with('data', $data);
    }
    

    public function showCar()
    {
        $data = session('data');
        return view('show-car', compact('data'));
    }
}
