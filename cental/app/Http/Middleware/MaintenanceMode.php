<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $currentTime = Carbon::now();// Output in Bangladesh local time
        $startTime = Carbon::createFromTime(10, 0); // 10:00 AM
       $endTime = Carbon::createFromTime(22, 00);   // 5:00 PM

    //   if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
    //     return response()->view('frontend.maintenanceMode');
    // }

    return $next($request);
    }
}
