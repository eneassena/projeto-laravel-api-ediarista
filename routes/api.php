<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Diarista\ObtemDiaristasPorCep;


Route::get('diaristas/localidades', ObtemDiaristasPorCep::class)
  ->name('diaristas.buscar_por_cep');
