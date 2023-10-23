<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class AfterLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('penduduk') || session()->has('admin')) {
            Alert::toast('Anda Masih Dalam Keadaan Login', 'info');
            return redirect('dashboard')->with('messageLogin', 'Kamu Dalam Keadaan Login');
        }
        return $next($request);
    }
}
