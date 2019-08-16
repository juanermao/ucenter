<?php

namespace App\Providers;

use App\Business\Utils\Unique;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
        DB::listen(function ($query){
            $tmp = str_replace('?', "'%s'", $query->sql);
            $bindings = [];
            foreach ($query->bindings as $key => $value) {
                if (is_numeric($key)) {
                    $bindings[] = $value;
                } else {
                    $tmp = str_replace(':'.$key, '"'.$value.'"', $tmp);
                }
            }
            $tmp = vsprintf($tmp, $bindings);
            $tmp = str_replace("\\", "", $tmp);
            Log::info(Unique::LOG_SQL . $query->time.'ms; ' . $tmp);
        });
    }

}
