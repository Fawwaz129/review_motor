<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MotorResource;
use App\Models\Motor;

class MotorController extends Controller
{
    public function index(){
        $posts = Motor::all();
        // return response()->json(['data' => $posts]);
        return MotorResource::collection($posts);
    }
}
