<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\APIResponser;
use App\Models\Customer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    use APIResponser;

    public function __construct()
    {
        Config::set('jwt.user', Customer::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]]);
    }
    /**
     * @SWG\Post(
     *   path="/api/login",
     *   summary="login endpoint",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="fail"),
     *     @SWG\Parameter(
     *          name="phone_number",
     *          description="phone number",
     *          in="formData",
     *          type="string"
     *      ),
     *       @SWG\Parameter(
     *          name="password",
     *          description="password",
     *          in="formData",
     *          type="string"
     *      ),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function login(Request $request)
    {
        $customer = Customer::where('phone_number', $request['phone_number'])->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            $input = ['phone_number' => $customer->phone_number, 'password' => $request->password];

            if (!$token = JWTAuth::attempt($input)) {
                return $this->exceptionResponse("Login Fail", 400);
            }
            $customer->token=$token;
        }

        return $customer;
    }
}
