<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\{
    Hash,
    RateLimiter,
};

use Laravel\Fortify\Fortify;

use App\Models\{
    administrators,
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
        if( request()->is( 'backoffice/*' ) ) {
            config()->set( 'fortify.guard', 'admin' );
            config()->set( 'fortify.home', '/admin/home' );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Fortify::authenticateUsing( function ( Request $request ) {

            $user = administrators::where( 'email', $request->username )->first();
 
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
