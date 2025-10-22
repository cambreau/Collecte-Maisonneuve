<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Force l'anglais par défaut à chaque visite
    App::setLocale('en');
    
    // Optionnel : garder la session pour les changements manuels
    if(session()->has('locale')){
        App::setLocale(session()->get('locale'));
    }
    
    return $next($request);
}
}
