<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Periksa apakah pengguna sudah login dan perannya sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect ke halaman yang sesuai jika peran tidak cocok
            return redirect()->route('home')->withErrors(['role' => 'You do not have the required permissions.']);
        }

        return $next($request);
    }
}
