<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Humidity;

use PhpMqtt\Client\Facades\MQTT;

class HumidityController extends Controller
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
        $mqtt->publish('sensors/humidity', json_encode($data));

        $humidity = Humidity::create($request->all());

        return response()->json($humidity, 201);
    }

    public function index()
    {
        $humidities = Humidity::all();
        return response()->json($humidities);
    }

    public function show($id)
    {
        $humidity = Humidity::find($id);

        if (!$humidity) {
            return response()->json(['message' => 'Humidity not found'], 404);
        }

        return response()->json($humidity);
    }
}
