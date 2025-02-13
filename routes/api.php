<?php
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Issue access tokens
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken'])
    ->middleware(['throttle'])
    ->name('passport.token');

// Revoke access tokens
Route::post('/oauth/token/revoke', function (Request $request) {
    $request->user()->token()->revoke();
    return response()->json(['message' => 'Token revoked']);
})->middleware('auth:api');

// Get authenticated user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);  // Register
Route::post('/admin/register', [AuthController::class, 'registerAdmin']);// Register Admin
Route::post('/login', [AuthController::class, 'login']);  // Login
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);  // Send OTP
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);  // Verify OTP

Route::middleware(['auth:api'])->group(function () {
    Route::post('/addjob', [JobController::class, 'addjob']);
});
Route::middleware('auth:api')->group(function () {
    Route::post('/jobs/apply', [JobController::class, 'apply']);
});

// Protected route to get user details
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);