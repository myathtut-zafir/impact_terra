<?php

namespace App\Http\Middleware;


use App\Http\Controllers\Traits\APIResponser;
use App\Models\Customer;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class JwtAuths
{
    use APIResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    function __construct()
    {
        Config::set('jwt.user', Driver::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]]);
    }

    public function handle($request, Closure $next)
    {
        $authorization = $request->header('authorization');
        $splitted_string = explode(" ", $authorization);
        if (count($splitted_string) > 1) {
            $bearer_token = 'Bearer ' . $splitted_string[count($splitted_string) - 1];
            $request->headers->set('Authorization', $bearer_token);
        }

        $token = JWTAuth::getToken();

        try {
            if (!$user = \Tymon\JWTAuth\Facades\JWTAuth::toUser($token)) {
                return $this->respondErrorToken('Customer Not Found');
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return $this->respondErrorTokenExpire('Please Logout and Login');
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return $this->respondErrorToken('Please Logout and Login');
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

//            $headers = collect($request->header())->transform(function ($item) {
//                return $item[0];
//            });
//            LogInsert::logInsert("Require Token Error", json_encode($headers), 0, "JWT Issue", 0);

            return $this->respondErrorToken('Require Token');
        }
        return $next($request);
    }
}
