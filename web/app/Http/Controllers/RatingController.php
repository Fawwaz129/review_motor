<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request -> validate([
            'post_id' => 'required|exist:posts,id',
            'rating_motor' => 'required'
        ]);
    }
}