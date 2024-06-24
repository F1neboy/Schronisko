<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;

class Statistics
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
        /*if(!$request->session()->exists('stats_cookie')){
            $request->session()->put('stats_cookie', true);
            $browser=Agent::browser();
            $browser_version=Agent::version($browser);
            $os=Agent::platform();
            $os_version=Agent::version($os);
            if(Agent::isDesktop())
                $device='Desktop';
            else if(Agent::isPhone())
                $device='Phone';
            else if(Agent::isTablet())
                $device='Tablet';
            DB::insert("insert into statystyki 
            (os, os_wersja, przegladarka, przegladarka_wersja, urzadzenie) values ('$os', '$os_version', '$browser', '$browser_version', '$device')");
        }*/
        return $next($request);
    }
}
