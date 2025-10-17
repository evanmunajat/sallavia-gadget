<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class CountVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $today = now()->format('Y-m-d');

        $alreadyVisited = Visit::where('ip_address', $ip)
            ->whereDate('created_at', $today)
            ->exists();

        if (!$alreadyVisited) {
            Visit::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
