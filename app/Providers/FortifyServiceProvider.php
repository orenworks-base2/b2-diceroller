<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\{
    Hash,
    RateLimiter,
    Validator,
};

use Laravel\Fortify\Fortify;

use App\Models\{
    Administrator,
    ActivityLog,
    User,
};

use Helper;

Use Carbon\Carbon;

use Illuminate\Support\Str;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Fortify::authenticateUsing( function ( Request $request ) {

            $user = User::where( 'phone_number', $request->username )->first();
 
            if ($user && Hash::check( $request->password, $user->password )) {
                return $user;
            }
        } );

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );

        $this->app->singleton(
            \Laravel\Fortify\Http\Requests\LoginRequest::class,
            \App\Http\Requests\LoginRequest::class
        );
    }
}
