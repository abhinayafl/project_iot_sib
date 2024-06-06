<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Temperature;

use PhpMqtt\Client\Facades\MQTT;

class TemperatureController extends Controller
{
    public function store(Request $request) // Ini adalah fungsi / method untuk menyimpan data temperatur ke dalam database, penaamn methodnya hanya contoh saja
    {
        $request->validate([ // Memberikan validasi pada inputan
            'value' => 'required|numeric', // Validasi inputan value harus berupa angka
        ]);

        $data = [
            'value' => $request->value,
        ];

        $mqtt = MQTT::connection();
        $mqtt->publish('sensors/temperature', json_encode($data));

        $temperature = Temperature::create($request->all()); // Menyimpan data temperatur ke dalam database

        return response()->json($temperature, 201);  // Memberikan response berupa data temperatur yang telah disimpan ke dalam database
    }

     // Metode untuk mengambil semua data temperatur
     public function index()
     {
         $temperatures = Temperature::all(); // Mengambil semua data temperatur dari database
         return response()->json($temperatures); // Mengembalikan response berupa JSON dari semua data temperatur
     }

     public function show($id)
    {
        $temperature = Temperature::find($id); // Mencari data temperatur berdasarkan ID

        if (!$temperature) { // Jika data temperatur tidak ditemukan
            return response()->json(['message' => 'Temperature not found'], 404); // Mengembalikan response error 404
        }

        return response()->json($temperature); // Mengembalikan response berupa JSON dari data temperatur yang ditemukan
    }

}
