<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class isPetani
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::exists('petani_status'))
        {
            return $next($request);
        }
        return redirect('/masuk')->with('gagal','Mohon Maaf Silahkan Masuk Terlebih Dahulu');
    }
}
