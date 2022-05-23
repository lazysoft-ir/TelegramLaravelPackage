<?php

namespace Lazysoft\Wufor\Services;

use Lazysoft\Wufor\WofurPlatformServiceInterface;

class WofurService
{
    private WofurPlatformServiceInterface $driver;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function driver(string $name = null)
    {
        if (isset($this->app[$name]) && $this->app[$name] instanceof WofurPlatformServiceInterface) {
            return $this->driver = $this->app[$name];
        }

        return $this->defaultDriver();
    }

    public function defaultDriver()
    {
        $defaultDeriver = config("wofur_default_driver", "telegram");
        $this->driver = $this->app[$defaultDeriver];
        return $this->driver;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->driver->$method(...$parameters);
    }
}
