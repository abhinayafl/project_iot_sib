<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WaterPump;
use App\Models\Lamp;

class ActuatorController extends Controller
{
    public function toggleWaterPump(Request $request)
    {
        $waterPump = WaterPump::first();

        if (!$waterPump) {
            $waterPump = WaterPump::create(['value' => $request->value]);
        } else {
            $waterPump->value = $request->value;
            $waterPump->save();
        }

        return response()->json(['success' => true, 'message' => 'Water pump status updated successfully.']);
    }

    public function toggleLamp(Request $request)
    {
        $lamp = Lamp::first();

        if (!$lamp) {
            $lamp = Lamp::create(['value' => $request->value]);
        } else {
            $lamp->value = $request->value;
            $lamp->save();
        }

        return response()->json(['success' => true, 'message' => 'Lamp status updated successfully.']);
    }
}
