<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ ActionController, RewardController, UserController };

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
    }

    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

// Model Paths
Route::get('/actions', [ActionController::class, 'index' ]);
Route::post('/actions', [ActionController::class, 'store' ]);
Route::get('/actions/{id}', [ActionController::class, 'show' ]);
Route::delete('/actions/{id}', [ActionController::class, 'destroy' ]);
Route::post('/actions/{id}', [ActionController::class, 'update' ]);

Route::get('/rewards', [RewardController::class, 'index' ]);
Route::post('/rewards', [RewardController::class, 'store' ]);
Route::get('/rewards/{id}', [RewardController::class, 'show' ]);
Route::delete('/rewards/{id}', [RewardController::class, 'destroy' ]);

Route::get('/users', [UserController::class, 'index' ]);
Route::post('/user', [UserController::class, 'store' ]);
Route::get('/user/{id}', [UserController::class, 'show' ]);

/**
 * Goals
 */

/**
 * Plans - complex actions
 * Post - Initial creation
 * Put - Construction
 * Get
 * Delete
*/

// Relations
Route::put('/user/{user_id}/addAction/{action_id}', [UserController::class, 'addAction' ]);
Route::put('/user/{user_id}/addReward/{reward_id}', [UserController::class, 'addReward' ]);
