<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\User;
class MustBeOperator
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
        if(Auth::user()->active==User::USER_IS_NOT_ACTIVE)
        {
            Auth::logout();
            return redirect()->route('login')->with('fail', 'Akun anda belum diaktifkan');
        }

        if (Gate::allows('is_operator'))
        {
            return $next($request);
        }else{
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini');
        }
    }
}
