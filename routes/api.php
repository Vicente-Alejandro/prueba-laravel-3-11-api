<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/user', function(Request $request) : Request {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () : Illuminate\Http\JsonResponse {
    return response()->json(['message' => 'API funcionando correctamente']);
});

Route::get('category/all', [CategoryController::class, 'all']);
Route::get('category/slug/{category:slug}', [CategoryController::class, 'show_by_slug']);
Route::resource('category', CategoryController::class)->except(['create', 'edit']);

Route::resource('post', PostController::class)->except(['create', 'edit']);