<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Mail;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/locale/{id}', 'language')->name('changeLang');
    Route::get('/', 'index')->name('index');
    Route::post('/application', 'application')->name('application');
    Route::get('/successful-application', 'success')->name('success');
});

// Ajax utils routes
Route::prefix('utils')->middleware(['ajax'])->controller(UtilsController::class)->group(function () {
    Route::get('states', 'getStates')->name('states');
    Route::get('cities', 'getCities')->name('cities');
});

Route::get('/mailable', function () {
    $user = App\Models\User::find(1);
    try {
        $mail = Mail::to("juanpablomadariagacardona@gmail.com")->send(new App\Mail\Application($user));
    } catch (\Throwable $th) {
        throw $th;
    }


    return new App\Mail\Application($user);
});
