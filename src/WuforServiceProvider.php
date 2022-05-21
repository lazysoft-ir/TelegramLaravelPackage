<?php

namespace Lazysoft\Wufor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WuforServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup("wufor_api", config("wufor.api_middleware", []));
        Route::middlewareGroup("wufor_web", config("wufor.web_middleware", []));
        $this->registerRoutes();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/wufor.php", "wufor");
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group(
            [
                "prefix" => "api/" . config("wufor.path"),
                "middleware" => "wufor_api",
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . "/../config/routes/api.php");
            }
        );
        Route::group(
            [
                "prefix" => config("wufor.path"),
                "middleware" => "wufor_web",
            ],
            function () {
                $this->loadRoutesFrom(__DIR__ . "/../config/routes/web.php");
            }
        );
    }
}
