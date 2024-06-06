<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor;

//Library MQTT
use PhpMqtt\Client\Facades\MQTT;

class SensorController extends Controller
{
    public function index(Request $request){

        $type = $request->type;
        $sensors = Sensor::orderBy("id", "desc");
        if ($type){
            $sensors = Sensor::where("type", $type);
        }
        $sensors = $sensors->paginate(20);

        return response()->json($sensors);

    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'value' => 'required|numeric',
        ]);

        //Data MQTT
        $topic = 'sensors/' . $request->type;
        $data = [
            'value' => $request->value,
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish($topic, json_encode($data));

        //--------------------------------------------

        $sensor = Sensor::create($request->all());

        return response()->json($sensor, 201);
    }

    public function history(Request $request)
    {
        $type = $request->type;
        $query = Sensor::orderBy("id", "desc");

        if ($type) {
            $query->where("type", $type);
        }

        $sensors = $query->paginate(20);

        return response()->json([
            'data' => $sensors->items(),
            'recordsTotal' => $sensors->total(),
            'recordsFiltered' => $sensors->total(),
        ]);
    }



}
