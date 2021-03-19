<?php

namespace App\Http\Middleware;

use App\Role;
use App\RoleUser;
use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ControleRole
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
        if(Str::contains($request->url(), 'dashboard')){
            $admin_role = Role::where('libelle', 'Dispacher')->first();
        }else if(Str::contains($request->url(), 'utilisateur')){
            $admin_role = Role::where('libelle', 'Administrateur')->first();
        }
        $user = Auth::user();
        $roles_user  = $user->roles;
        if($roles_user != null){
            foreach($roles_user as $role_user){
                if($role_user->id ==$admin_role->id){
                    return $next($request);
                }
            }
            return back()->with('message', 'Vous ne pouvez pas acceder à cette ressource');
        }

    }
}
