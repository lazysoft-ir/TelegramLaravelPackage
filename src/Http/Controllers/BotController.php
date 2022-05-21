<?php

namespace Lazysoft\Wufor\Http\Controllers;

use Lazysoft\Wufor\Http\Requests\BotRequest;

class BotController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BotRequest $request, string $token)
    {
        dd($token);
    }
}
