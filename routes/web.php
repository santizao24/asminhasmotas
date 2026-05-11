<?php

use App\Http\Controllers\MotasControllerDB;
use Illuminate\Support\Facades\Route;

Route::get('/motas/', [MotasControllerDB::class,'getAll']);

Route::get('/motas/{id}/', [MotasControllerDB::class,'getOne']); 

Route::delete('/motas/{id}/', [MotasControllerDB::class,'remove']); 

Route::post('/motas/', [MotasControllerDB::class,'add']);

Route::view('/motociclos/','asminhasmotas');

Route::redirect('/motos/', '/motas/');