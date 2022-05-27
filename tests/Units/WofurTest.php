<?php

namespace Lazysoft\Wufor\Tests\Units;

use Lazysoft\Wufor\Services\Wofur\TelegramService;
use Lazysoft\Wufor\Services\WofurService;
use Lazysoft\Wufor\Tests\TestCase;
use Lazysoft\Wufor\Wofur;

class LabelsTest extends TestCase
{
    public function test_wofur_default_should_instance_of_wofur_service()
    {
        $this->assertInstanceOf(WofurService::class, Wofur::getFacadeRoot());
    }

    public function test_wofur_telegram_driver_should_return_instance_of_telegram_service()
    {
        $this->assertInstanceOf(TelegramService::class, Wofur::driver("telegram"));
    }

    public function test_wofur_default_driver_should_return_instance_of_telegram_service()
    {
        $this->assertInstanceOf(TelegramService::class, Wofur::driver());
    }
}
