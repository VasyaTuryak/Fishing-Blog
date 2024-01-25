<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    $user = 'God=Vasya=go sleep';
    return Inertia::render('User/show', [
        'user' => $user
    ]);
});

Route::get('/about', function () {
    return Inertia::render('About/About');
});

Route::get('/search', function () {
    return Inertia::render('Shared/Search');
});

Route::get('/contact', function () {
    return Inertia::render('Contact/Contact');
});
Route::get('/home', function () {

    return Inertia::render('Home',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/latest', function () {
    return Inertia::render('Shared/latestpost');
});

Route::get('/author-page', function () {
    return Inertia::render('Shared/Authorpage');
});

Route::get('/weather', function () {
    return Inertia::render('Shared/Weather');
});

Route::get('/nasa', function () {
    return Inertia::render('Shared/nasa');
});

Route::get('/lee', function () {
    $head = [1,1,2];
    $result=array_unique($head);
    dd($result);
    return Inertia::render('Shared/nasa');
});

Route::fallback(function (){
    return'incorrect page';
});

require __DIR__ . '/auth.php';
