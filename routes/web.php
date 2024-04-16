<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::view('/{any}', 'dashboard')
    ->where('any', '.*');

