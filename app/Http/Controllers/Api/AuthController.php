<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
        /**
         * Create User
         * @param RegisterUserRequest $request
         * @return JsonResponse
         */
        public function register(RegisterUserRequest $request): JsonResponse
        {
                $data = $request->validated();
                $data['password'] = Hash::make($data['password']);
                $user = User::create($data);

                //event(new Registered($user));

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Created Successfully',
                    'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                    'user' => $user
                ], 200);

        }

    /**
     * Login The User
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
        public function login(LoginRequest $request): JsonResponse
        {

            if(!Auth::attempt($request->only(['email', 'password']))){
                        throw ValidationException::withMessages([
                            'email' => trans('auth.failed'),
                        ]);
                }

                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Logged In Successfully',
                    'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                    'user' => $user
                ], 200);

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
