<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PredefinedPageController;
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

Route::middleware("auth")
    ->group(function () {
        Route::get('preview/mail/contact-client', [PreviewController::class, 'contactClientMail']);
        Route::get('preview/mail/contact-admin', [PreviewController::class, 'contactAdminMail']);
        Route::get('preview/mail/session-planned-client', [PreviewController::class, 'sessionPlannedClientMail']);
        Route::get('preview/mail/session-declined-admin', [PreviewController::class, 'sessionDeclinedAdminMail']);
    });

Route::get('contact', [PredefinedPageController::class, 'contact'])
    ->name('contact')
    ->where('link-picker', 'true');

Route::get('cookies', [PredefinedPageController::class, 'cookie'])
    ->name('cookie')
    ->where('link-picker', 'true');

Route::get('privacy', [PredefinedPageController::class, 'privacy'])
    ->name('privacy')
    ->where('link-picker', 'true');

Route::get('plans/{plan}/sessions/{session}/decline/{client}', [PlanController::class, 'declineSession'])
    ->name('plans.sessions.decline');

Route::get('{page}', [PageController::class, 'show'])
    ->name('pages.show')
    ->where('link-picker', 'true');

Route::get('/', [PredefinedPageController::class, 'home'])
    ->name('home')
    ->where('link-picker', 'true');
