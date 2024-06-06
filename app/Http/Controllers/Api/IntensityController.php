<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intensity;

use PhpMqtt\Client\Facades\MQTT;

class IntensityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric',
        ]);

        $data = [
            'value' => $request->value,
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('sensors/intensity', json_encode($data));

        $intensity = Intensity::create($request->all());

        return response()->json($intensity, 201);
    }

    public function index()
    {
        $intensities = Intensity::all();
        return response()->json($intensities);
    }

    public function show($id)
    {
        $intensity = Intensity::find($id);

        if (!$intensity) {
            return response()->json(['message' => 'Intensity not found'], 404);
        }

        return response()->json($intensity);
    }
}
