<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register a new user and login.
     */
  
    public function register(AuthRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $credentials = ['email' => $user->email, 'password' => $request->password];

        return $this->loginFromArray($credentials);
    }

    /**
     * Login a user using credentials from request.
     */
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->loginFromArray($credentials);
    }

    /**
     * Shared login logic.
     */
    private function loginFromArray(array $credentials)
    {
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response_data($this->respondWithToken($token), 'Login successful');
    }

    /**
     * Update the authenticated user's profile.
     */
    public function updateProfile(UserRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        $user->name = $data['name'];

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('public/images/users', $fileName);

            $user->image = $filePath;
            $user->URL_image = Storage::url($filePath);
        }

        $user->save();

        return response_data($user, 'User profile updated successfully');
    }

    /**
     * Get the authenticated user's info.
     */
    public function me()
    {
        return response_data(auth()->user());
    }

    /**
     * Logout the user (invalidate token).
     */
    public function logout()
    {
        auth()->logout();
        return response_data([], 'Successfully logged out');
    }

    /**
     * Refresh JWT token.
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Format token response.
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ];
    }
}
