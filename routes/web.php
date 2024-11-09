<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetByIdController;

Route::GET('/', [HomeController::class, 'index']);

Route::GET('/pets/status/', [HomeController::class, 'findPetByStatus'])->name('findPetByStatus');

Route::GET('/id', [HomeController::class, 'findPetById'])->name('findPetById');
Route::GET('/id/{id}', [PetByIdController::class, 'show'])->name('showPet');

Route::POST('/addPet', [HomeController::class, 'createPet'])->name('createPet');

Route::PUT('/updatePet/{id}', [PetByIdController::class, 'updatePet'])->name('updatePet');

Route::DELETE('/deletePet/{id}', [PetByIdController::class, 'deletePet'])->name('deletePet');


