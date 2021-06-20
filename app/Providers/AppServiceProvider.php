<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
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
        Validator::extend('greater_than_field',function($attribute, $value, $parameters, $validator){
            $inputs = $validator->getData();
            $startDate = $inputs['startDate'];
            $endDate = $inputs['endDate'];
            $now = Carbon::now()->format("Y-m-d");
            return $startDate < $now  && $startDate < $endDate;
        });
    }
}
