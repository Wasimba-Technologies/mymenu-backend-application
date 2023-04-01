<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\Role;
use App\Models\Scopes\TenantScope;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
                $data['role_id'] = null;
                $user = User::create($data);
                $role = Role::withoutGlobalScope(TenantScope::class)
                        ->where('name', 'Admin')->first();
                $user->role_id = $role->id;
                $user->save();

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
        // Revoke the token that was used to authenticate the current request...
        //Log::info(json_encode($request->user()));
        //$request->user()->currentAccessToken()->delete();
        $tokenId = Str::before(request()->bearerToken(), '|');
        auth()->user()->tokens()->where('id', $tokenId )->delete();
        return response()->noContent();

    }

    public function getRoles(): JsonResponse
    {
        $roles = Role::withoutGlobalScope(TenantScope::class)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'User Created Successfully',
            'data' => $roles
        ], 200);
    }
}
