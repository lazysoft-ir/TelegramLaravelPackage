<?php

namespace Lazysoft\Wufor\Tests\Units\Services\Wofur;

use Lazysoft\Wufor\Services\Wofur\TelegramService;
use Lazysoft\Wufor\Services\WofurService;
use Lazysoft\Wufor\Tests\TestCase;
use Lazysoft\Wufor\Wofur;

class TelegramServiceTest extends TestCase
{
    public function test_telegram_service_should_be_able_to_use_with_wofur_facade()
    {
        $this->assertInstanceOf(TelegramService::class, Wofur::driver("telegram"));
    }

    public function test_telegram_service_should_be_able_to_send_message()
    {
        dd(env("BOT_TOKEN"));
        // Wofur::dirver("telegram")->setToken()
    }
}
