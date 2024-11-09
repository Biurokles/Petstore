<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetByIdController;


Route::GET('/', [HomeController::class, 'index']);

Route::GET('/err', function () {
    return view('error/notFound');
});


Route::GET('/status', [HomeController::class, 'findPetByStatus'])->name('findPetByStatus');
Route::GET('/id', [HomeController::class, 'findPetById'])->name('findPetById');
Route::GET('/id/{id}', [PetByIdController::class, 'show'])->name('showPet');


Route::GET('/', [HomeController::class, 'index']);

Route::photoUrls('/addPet', [HomeController::class, 'createPet'])->name('createPet');


Route::PUT('/updatePet', [PetByIdController::class, 'updatePet'])->name('updatePet');

Route::DELETE('/deletePet/{id}', [PetByIdController::class, 'deletePet'])->name('deletePet');


