<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/libros", [BookController::class, "show"]);
Route::get("/libro/filtrar_por_nombre", [BookController::class, "filter_by_name"]);
Route::post("/libro", [BookController::class, "store"]);
Route::put("/libro/:id", [BookController::class, "update"]);
Route::delete("/libro/{id}", [BookController::class, "delete"]);