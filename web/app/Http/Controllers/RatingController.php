<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'post_id' => 'required|exists:motors,id',
            'rating_motor' => 'required'
        ]);

        $request['user_id'] = auth()->user()->id;

        $rating = Rating::create($request->all());

        // return response()->json($comment);

        return new RatingResource($rating->loadMissing(['commentator:id,username']));

    }
    public function update(Request $request, $id)
    {
        $request->validate([]);
        $request->validate([
            'rating_motor' => 'required'
        ]);

        $comment = Rating::findOrFail($id);
        $comment->update($request->only('rating_motor'));

        return new RatingResource($comment->loadMissing(['commentator:id,username']));

    }

    public function delete($id){
        $comment = Rating::findOrFail($id);
        $comment->delete();

        return new RatingResource($comment->loadMissing(['commentator:id,username']));
    }


}