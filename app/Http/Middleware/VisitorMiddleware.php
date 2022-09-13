<?php

namespace App\Http\Middleware;

use App\Models\Link;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class VisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $link_id = $request->route('link')->id;
        $user_ip = $request->getClientIp();

        $visitor = Visitor::where('user_ip', $user_ip)->where('link_id', $link_id)->get();

        if (!count($visitor)) {
            $link = Link::where('id', '=', $link_id)->increment('visitors');
            Visitor::updateOrCreate([
                'user_ip' => $user_ip,
                'post_id' => $link_id,
            ]);
        }
        return $next($request);
    }

}
