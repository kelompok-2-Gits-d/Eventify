<?php

use App\Http\Controllers\CateringController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MuaController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\VideoController;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/product', function(){
    return view('product');
});

Route::get('/detail', function(){
    return view('detail');
});


Route::get('/about-us', function(){
    return view ('about-us');
});



// Route::middleware(['auth', 'verified'])->group(function(){
//     Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::redirect('admin', 'admin/vendor');

Route::prefix('admin')->group(function () {
    Route::prefix('vendor')->group(function () {
        Route::get('/', function () {
            return view('admin.vendor');
        })->name('vendor');

        Route::resource('photo', PhotoController::class);
        Route::resource('video', VideoController::class);
        Route::resource('catering', CateringController::class);
        Route::resource('mua', MuaController::class);
        Route::resource('decoration', DecorationController::class);
    });


    Route::resource('user', CustomerController::class);

    Route::get('status', [StatusController::class, 'index'])->name('status');

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');
});


Route::get('/googleLogin', [HomeController::class, 'googleLogin']);
Route::get('auth/google/callback', [HomeController::class, 'googleHandle']);

route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

require __DIR__ . '/auth.php';
