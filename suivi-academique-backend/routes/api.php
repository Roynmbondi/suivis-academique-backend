<?php
use App\Http\Controllers\NiveauController;
use Illuminate\Support\Facades\Route;

Route::apiResource("niveau",NiveauController::class);
