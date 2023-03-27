<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MotorResource;
use App\Http\Resources\MotorDetailResource;
use App\Models\Motor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MotorController extends Controller
{
    public function index(){
        $posts = Motor::all();
        // return response()->json(['data' => $posts]);
        //return MotorResource::collection($posts);
        return MotorDetailResource::collection($posts->loadMissing('writer:id,username', 'comments:id,post_id,user_id,rating_motor'));
    }
    public function show($id){
        $post = Motor::with('writer:id,username')->findOrFail($id);
        return new MotorDetailResource($post);
    }
    public function show2($id){
        $post = Motor::with('writer:id,username', 'comments:id,post_id,user_id,rating_motor')->findOrFail($id);
        return new MotorDetailResource($post);
    }

    
    public function store(Request $request){
        $request -> validate([
            'nama_motor' => 'required|max:255',
            'tentang_motor' => 'required',
        ]);

        $image = null;
        if ($request -> file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            $image = $fileName. '.' .$extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        // return response()->json('sudah dapat digunakan');
        $request['image'] = $image;
        $request['author'] = Auth::user()->id;

        $post = Motor::create($request->all());
        return new MotorDetailResource($post->loadMissing('writer:id,username'));

    }
    public function update(Request $request, $id){
        $request -> validate([
            'nama_motor' => 'required|max:255',
            'tentang_motor' => 'required',
        ]);
        $image = null;
        if ($request -> file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            $image = $fileName. '.' .$extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        // return response()->json('sudah dapat digunakan');
        $request['image'] = $image;

        $post = Motor::findOrFail($id);
        $post->update($request->all());
        //return response()->json('sudah dapat digunakan');

        return new MotorDetailResource($post->loadMissing('writer:id,username'));

    }

    public function delete($id){
        $post = Motor::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => "data successfully deleted"
        ]);
    }
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }




}