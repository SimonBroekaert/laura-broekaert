<?php

use App\Http\Controllers\PredefinedPageController;
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

Route::get('contact', [PredefinedPageController::class, 'contact'])
    ->name('contact');

Route::get('cookie', [PredefinedPageController::class, 'cookie'])
    ->name('cookie');

Route::get('privacy', [PredefinedPageController::class, 'privacy'])
    ->name('privacy');

Route::get('{page}', [PageController::class, 'show'])
    ->name('pages.show')
    ->where('link-picker', 'true');

Route::get('/', [PredefinedPageController::class, 'home'])
    ->name('home')
    ->where('link-picker', 'true');
