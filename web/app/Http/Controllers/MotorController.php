<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MotorResource;
use App\Http\Resources\MotorDetailResource;
use App\Models\Motor;
use Illuminate\Support\Facades\Auth;


class MotorController extends Controller
{
    public function index(){
        $posts = Motor::all();
        // return response()->json(['data' => $posts]);
        return MotorResource::collection($posts);
    }
    public function show($id){
        $post = Motor::with('writer:id,username')->findOrFail($id);
        return new MotorDetailResource($post);
    }
    public function show2($id){
        $post = Motor::findOrFail($id);
        return new MotorDetailResource($post);
    }

    
    public function store(Request $request){
        $request -> validate([
            'nama_motor' => 'required|max:255',
            'tentang_motor' => 'required',
        ]);

        // return response()->json('sudah dapat digunakan');
        $request['author'] = Auth::user()->id;

        $post = Motor::create($request->all());
        return new MotorDetailResource($post->loadMissing('writer:id,username'));

    }
    public function update(Request $request, $id){
        $request -> validate([
            'nama_motor' => 'required|max:255',
            'tentang_motor' => 'required',
        ]);
        $post = Motor::findOrFail($id);
        $post->update($request->all());
        //return response()->json('sudah dapat digunakan');

        return new MotorDetailResource($post->loadMissing('writer:id,username'));

    }



}