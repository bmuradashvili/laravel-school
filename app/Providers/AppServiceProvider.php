<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('poly_exists', function ($attribute, $value, $parameters, $validator) {
            if (!$objectType = array_get($validator->getData(), $parameters[0], false)) {
                return false;
            }

            return !empty(resolve($objectType)->find($value));
        });
    }
}
