<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
        /**
         * Create User
         * @param RegisterUserRequest $request
         * @return JsonResponse
         */
        public function register(RegisterUserRequest $request): JsonResponse
        {
            try {
                $data = $request->validated();
                $user = User::create($data);

                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);

            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        }

        /**
         * Login The User
         * @param LoginRequest $request
         * @return JsonResponse
         */
        public function login(LoginRequest $request): JsonResponse
        {
            try {

                if(!Auth::attempt($request->only(['email', 'password']))){
                    return response()->json([
                        'status' => false,
                        'message' => 'Email & Password does not match with our record.',
                    ], 401);
                }

                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                    'user' => $user
                ], 200);

            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
        }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function logout(Request $request): Response|RedirectResponse
    {
        if ($request->wantsJson()) {
            // Revoke the token that was used to authenticate the current request...
            Log::info(json_encode($request->user()));
            $request->user()->currentAccessToken()->delete();
            return response()->noContent();
        }

    }
}
