<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('preview/mail/contact-client', [PreviewController::class, 'contactClientMail']);
Route::get('preview/mail/contact-admin', [PreviewController::class, 'contactAdminMail']);

Route::get('{page}', [PageController::class, 'show'])
    ->name('pages.show')
    ->where('link-picker', 'true');

Route::get('/', HomeController::class)
    ->name('home')
    ->where('link-picker', 'true');
