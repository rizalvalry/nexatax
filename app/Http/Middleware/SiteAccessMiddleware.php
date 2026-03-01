<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SiteAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (config('site.blocked') && !$this->isWhitelisted($request)) {
            return response()->view('blocked', [
                'title' => config('site.blocked_title'),
                'message' => config('site.blocked_message'),
                'phone' => config('site.developer_phone'),
                'email' => config('site.developer_email'),
                'whatsapp' => config('site.developer_whatsapp'),
            ], 503);
        }

        return $next($request);
    }

    protected function isWhitelisted(Request $request): bool
    {
        $path = $request->path();
        return str_starts_with($path, 'admin') || str_starts_with($path, 'storage');
    }
}
