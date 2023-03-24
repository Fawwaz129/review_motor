<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MotorResource;
use App\Http\Resources\MotorDetailResource;
use App\Models\Motor;

class MotorController extends Controller
{
    public function index(){
        $posts = Motor::all();
        // return response()->json(['data' => $posts]);
        return MotorResource::collection($posts);
    }
    public function show($id){
        $post = Motor::findOrFail($id);
        return new MotorDetailResource($post);
    }
}
