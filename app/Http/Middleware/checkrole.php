<?php

namespace App\Http\Middleware;

use  App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        // if (Auth::check()) {
        //     $users = Auth::user();
        //     // $use=role::find(1)->user;
        //     $use = User::find($users->id)->role;

        //     if ($use->name == $role) {
        //         return redirect('/');
        //     }
            
        // }
        // else{
        //    return redirect('login');
        // }
        // if (Auth::check()) {
            $users = Auth::user();
            // $use=role::find(1)->user;
            $use = User::find($users->id)->role;

            if ($use->name == $role) {
                return redirect('/');
            }
            
        
        return $next($request);
    }
}
