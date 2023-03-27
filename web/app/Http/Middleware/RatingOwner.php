<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Rating;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RatingOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $comment = Rating::findOrFail($request->id);

        if ($comment->user_id != $user->id) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        return $next($request);
    }
}
