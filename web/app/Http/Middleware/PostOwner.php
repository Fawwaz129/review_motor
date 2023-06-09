<?php

namespace App\Http\Middleware;

use App\Models\Motor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd("ini menggunakan middleware");

        $currentUser  = Auth::user();
        $post = Motor::findOrFail($request->id);

        if ($post -> author != $currentUser->id) {
            return response()->json([
                'message' => 'Kowe sopo cok'
            ], 404);
        }

        // return response()->json($currentUser);

        return $next($request);
    }
}