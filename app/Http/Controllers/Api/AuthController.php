<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        // model as dependency injection
        $this->user = $user;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     operationId="registerUser",
     *     tags={"Register"},
     *     summary="Register a new user",
     *     description="User Registration Endpoint",
     *     @OA\Parameter(
     *          name="name",
     *          description="Enter name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Enter email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User Registered Successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *       response=200,
     *       description="Registered Successfully",
     *       @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent()
     *     ),
     * )
     */

    public function register(Request $request)
    {
        // validate the incoming request
        // set every field as required
        // set email field so it only accept the valid email format

        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|max:255|unique:users', //email:rfc,dns
            'password' => 'required|string|min:6|max:255',
        ]);

        // if the request valid, create user

        $user = $this->user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        // login the user immediately and generate the token
        $token = auth()->login($user);

        // return the response as json 
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User created successfully!',
            ],
            'data' => [
                'user' => $user,
                'access_token' => [
                    'token' => $token,
                    'type' => 'Bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,    // get token expires in seconds
                ],
            ],
        ]);
    }

    //Login api
    /**
        * @OA\Post(
        *     path="/api/login",
        *     operationId="loginUser",
        *     tags={"Login"},
        *     summary="Login a user",
        *     description="User Login Endpoint",
        *     @OA\Parameter(
        *          name="email",
        *          description="Enter email",
        *          required=true,
        *          in="query",
        *          @OA\Schema(
        *              type="string"
        *          )
        *     ),
        *     @OA\Parameter(
        *          name="password",
        *          description="Enter password",
        *          required=true,
        *          in="query",
        *          @OA\Schema(
        *              type="string"
        *          )
        *     ),
        *     @OA\Response(
        *         response="201",
        *         description="User Login Successfully",
        *         @OA\JsonContent()
        *     ),
        *     @OA\Response(
        *       response="200",
        *       description="Login Successfull",
        *       @OA\JsonContent()
        *     ),
        *     @OA\Response(
        *         response="422",
        *         description="Unprocessable Entity",
        *         @OA\JsonContent()
        *     ),
        *     @OA\Response(
        *         response="400",
        *         description="Bad Request",
        *         @OA\JsonContent()
        *     ),
        * )
        */

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // attempt a login (validate the credentials provided)
        $token = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // if token successfully generated then display success response
        // if attempt failed then "unauthenticated" will be returned automatically
        if ($token)
        {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Quote fetched successfully.',
                ],
                'data' => [
                    'user' => auth()->user(),
                    'access_token' => [
                        'token' => $token,
                        'type' => 'Bearer',
                        'expires_in' => auth()->factory()->getTTL() * 600,
                    ],
                ],
            ]);

        }else{
            return response()->json([
                'status'=>'failed',
                'message' => 'Wrong credentials !'
            ]);
        }
    }

    public function logout()
    {
        // get token
        $token = JWTAuth::getToken();

        // invalidate token
        $invalidate = JWTAuth::invalidate($token);

        if($invalidate) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Successfully logged out',
                ],
                'data' => [],
            ]);
        }
    }
}