<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'value' => 'required|numeric',
        ]);

        $sensor = Sensor::create($request->all());

        return response()->json($sensor, 201);
    }


}
