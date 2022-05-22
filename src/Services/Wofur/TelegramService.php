<?php

namespace Lazysoft\Wufor\Services\Wofur;

class TelegramService
{
    public function __construct($token = '')
    {
        $this->token = $token;
    }
}
