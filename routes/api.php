<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticator', 'authorizer', 'permissions')->group(function (){
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.delete');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['middleware']);
