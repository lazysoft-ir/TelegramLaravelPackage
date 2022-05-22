<?php

namespace Lazysoft\Wufor\Tests\Units;

use Lazysoft\Wufor\Services\Wofur\TelegramService;
use Lazysoft\Wufor\Tests\TestCase;
use Lazysoft\Wufor\Wofur;

class LabelsTest extends TestCase
{
    public function test_wofur_default_should_instance_of_telegram_service()
    {
        dd(Wofur::getFacadeRoot());
        $this->assertInstanceOf(TelegramService::class, Wofur::getFacadeRoot());
    }
}
