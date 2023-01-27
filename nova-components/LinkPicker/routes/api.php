<?php

use Illuminate\Support\Facades\Route;
use Simonbroekaert\LinkPicker\Http\Controllers\ApiController;

Route::get('models/{model}', [ApiController::class, 'models'])
    ->where('model', '.*');
