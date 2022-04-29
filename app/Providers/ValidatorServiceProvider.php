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
        $this->app['validator']->extend('check_password', function ($attribute, $value) {
            if(!Hash::check($value, auth('admin')->user()->getAuthPassword()))
                return false;
            return true;
        });
    }
}
