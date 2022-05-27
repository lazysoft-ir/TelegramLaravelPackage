<?php

return [
    // route prefixes
    "path" => "telegram",
    // route middlewares
    "api_middleware" => ["api"],
    "web_middleware" => ["web"],

    //
    "bots" => explode(",", env("WOFUR_BOT_TOKENS")),

    // if you need proxy
    "proxy" => env("WOFUR_PROXY", null),

    // if you want to use file system and share files between bots
    "file_share_group" => env("WOFUR_FILE_SHARE_GROUP_ID", null),

    "wofur_default_driver" => "telegram",
];
