<?php

namespace Lazysoft\Wufor;

interface WofurPlatformServiceInterface
{

    public function sendMessage(string $message, string $chat_id);
}
