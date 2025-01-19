<?php

use Illuminate\Support\Facades\Route;


Route::controller(\App\Http\Controllers\PetController::class)->group(function () {
  Route::get('/', 'index')->name('pets.index');
  Route::get('/pets/{id}', 'show');
  Route::get('/create', 'create');
  Route::get('/edit/{petId}', 'edit');
  Route::post('/pets/update', 'update')->name('pets.update');
  Route::post('/pets/store', 'store')->name('pets.store');
  Route::delete('/pets/{petId}', 'delete')->name('pets.delete');
});
