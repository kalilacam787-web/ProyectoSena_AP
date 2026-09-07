<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanViewApprentices
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() || $request->session()->has('instructor_id') || $request->session()->has('apprentice_id')) {
            return $next($request);
        }

        return redirect()->route('apprentices.access');
    }
}