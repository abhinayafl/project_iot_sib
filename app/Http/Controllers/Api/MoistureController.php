<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Moisture;

class MoistureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric',
        ]);

        $moisture = Moisture::create($request->all());

        return response()->json($moisture, 201);
    }

    public function index()
    {
        $moistures = Moisture::all();
        return response()->json($moistures);
    }

    public function show($id)
    {
        $moisture = Moisture::find($id);

        if (!$moisture) {
            return response()->json(['message' => 'Moisture not found'], 404);
        }

        return response()->json($moisture);
    }
}