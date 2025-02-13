<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;
use App\Events\UserVerified;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AdminRegisterRequest;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
public function registerAdmin(AdminRegisterRequest $request)
{
    $admin = $this->authService->registerAdmin($request->validated());
    event(new UserRegistered($admin));
    return response()->json([
        'message' => 'Admin registered successfully!',
        'admin' => $admin,
    ], 201);
}
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        if (!$user) {
            return response()->json(['error' => 'Registration failed. Please try again.'], 400);
        }else{
        event(new UserRegistered($user));
        return response()->json(['message' => 'User registered successfully!', 'user' => $user], 201);
        }
    }
        // Verify OTP
    public function verifyOtp(Request $request)
        {
            $user = User::where('email', $request->email)
                        ->orWhere('mobile', $request->mobile)
                        ->first();
    
            if (!$user || $user->otp !== $request->otp || now()->greaterThan($user->otp_expires_at)) {
                return response()->json(['message' => 'Invalid or expired OTP'], 200);
            }
    
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();
            event(new UserVerified($user));
            return response()->json(['message' => 'Account verified successfully.'], 200);
        }


    // Resend OTP
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)
                    ->orWhere('mobile', $request->mobile)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 200);
        }
        if($user->email_verified_at){
            return response()->json(['message' => 'User already verified'], 200);
        }

        $user->otp = rand(100000, 999999);
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        event(new UserRegistered($user));

        return response()->json(['message' => 'OTP sent successfully.'], 200);
    }


public function login(LoginRequest $request): JsonResponse
{
    $result = $this->authService->login($request->validated());
    if (!$result) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    if($result == 'Notverified'){
        return response()->json(['message' => 'Email not verified'], 401);
    }

    return response()->json([
        'token' => $result['token'],
        'user' => $result['user'],
    ], 200);
}
}
