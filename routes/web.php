<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DBController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Book\BookController;
use Illuminate\Support\Facades\Redis;
use App\Http\Middleware\CheckStatus;

use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\PostGuzzleController;
use App\Http\Controllers\Polymorphic\PostController;
use App\Http\Controllers\ProvisionServer;

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

Route::middleware([CheckStatus::class])->group(function(){

    Route::get('/', function () {
        return "this is ok";
        // return view('welcome');
    });

    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::post('/book-store', [BookController::class, 'store'])->name('book-store');
    Route::get('/db-backup', [DBController::class, 'databaseBackup']);
    Route::get('/user', [UsersController::class, 'findUser']);

});


// redis routes...
Route::get('/redis', function () {
    $visits = Redis::incr('visits');
    $get = Redis::get('visits');
    return $visits;
});

// language change by param
// Route::get('/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, config('app.available_locales'))) {
//         app()->setLocale($locale);
//     }

//     return view('welcome');
// });


Route::get('get-address-from-ip', [GeoLocationController::class, 'index']);

Route::get('posts',[PostGuzzleController::class,'index']);
Route::get('posts/store', [PostGuzzleController::class, 'store' ]);

Route::get('get-posts', [PostController::class, 'index']);

Route::get('/server', [ProvisionServer::class]);
