<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('instructor_id')) {
            return $next($request);
        }

        return redirect()->route('teachers.access');
    }
}