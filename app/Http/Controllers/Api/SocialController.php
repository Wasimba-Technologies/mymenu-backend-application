<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Scopes\TenantScope;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        //return Socialite::driver($provider)->redirect();
        return redirect(
            Socialite::with($provider)
                ->stateless()
                ->redirect()
                ->getTargetUrl()
        );
    }

    public function callback($provider)
    {
        //$socialUser =   Socialite::driver($provider)->user();
        $socialUser = Socialite::with($provider)->stateless()->user();

        $user = User::where('email',  $socialUser->getEmail())->first();
        if($user){
            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully',
                'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);
        }else{
            $role = Role::withoutGlobalScope(TenantScope::class)
                ->where('name', 'Customer')->first();
            $user = User::create([
                'name'          => $socialUser->getName(),
                'email'         => $socialUser->getEmail(),
                'image'         => $socialUser->getAvatar(),
                'password'      => encrypt('123456dummy'),
                'role_id'       => $role->id,
                'auth_provider_id'   => $socialUser->getId(),
                'auth_provider'      => $provider,
            ]);

            Customer::create([
                'user_id'          => $user->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Created Successfully',
                'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user
            ], 200);
        }
    }
}
