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
        $this->registerPublishing();
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
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

    /**
     * Undocumented function
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . "/../database/migrations" => database_path("migrations"),
                ],
                "wofur-migrations"
            );

            $this->publishes(
                [
                    __DIR__ . "/../config/wufor.php" => config_path("wufor.php"),
                ],
                "wofur-config"
            );
        }
    }
}
