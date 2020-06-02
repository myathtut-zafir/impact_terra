<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\APIResponser;
use Illuminate\Support\Facades\Config;
use Closure;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    use APIResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('data',['all'=>$request->header('apiKey')]);
        if ($request->header('api-key') !== "") {
            $isApiKeyValid = Config::get('CheckApiKey.api-keys.digitx_api_key') === $request->header('apiKey') ? true : false;

            if (!$isApiKeyValid) {
                return $this->clientApikeyInvalid();
            } else {
                return $next($request);
            }
        } else {
            return $this->exceptionResponse("API key require",Response::HTTP_BAD_REQUEST);

        }
    }
}
