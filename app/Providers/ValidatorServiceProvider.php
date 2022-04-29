<?php

namespace EcommerceCourse\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('check_password', function ($attribute, $value, $parameters) {
            if(!Hash::check($value, auth($parameters[0])->user()->getAuthPassword()))
                return false;
            return true;
        });
    }
}
