<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('apiJson', function ($success, $statusCode, $data) use ($factory) {

            $customFormat = [
                'success' => $success,
                'statusCode' => $statusCode,
                'data' => $data
            ];
            return $factory->make($customFormat);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
