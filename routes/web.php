<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/items');

Route::resource('items', ItemController::class);
