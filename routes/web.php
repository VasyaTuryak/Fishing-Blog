<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Goutte\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/latest', function () {
    $AllLatest = Post::with('user')->latest()->get();
        return Inertia::render('Shared/LatestPost',[
        'posts'=>$AllLatest
    ]);
});

Route::get('/allmyposts', function () {
    $userId = auth()->id();
    $MyPost=User::find($userId)->posts()->get();
    return Inertia::render('Shared/AllMyPosts',[
        'userPosts'=>$MyPost
    ]);
})->name('allMy');

Route::get('/author-page', function () {
    return Inertia::render('Shared/AuthorPage');
})->name('Authorpage');

Route::get('/weather', function () {
    $searchLocation = 'Заліщики';
    $client = new Client();
    $getPage = $client->request('GET', 'http://dnister.meteo.gov.ua/ua/hydro_operational_data');
    $getHTMLcontent = str_replace(["\t"], '', $getPage->html());
    preg_match_all('/\d{2}+\.+\d{2}+\.+\d{4}/', $getHTMLcontent, $date);
    $positionOfSensor = strpos($getHTMLcontent, $searchLocation);
    $partOfHTML = substr($getHTMLcontent, $positionOfSensor, 150);
    preg_match_all('/\d{3}+\.?\d*/', $partOfHTML, $matches);
    $levelWater = $matches[0][1];
    return Inertia::render('Shared/Weather', [
        'levelOfWaterInRiver' => $levelWater,
        'date' => $date[0][0]
    ]);
});

Route::get('/nasa', function () {
    return Inertia::render('Shared/Nasa');
});

Route::post('/save', function (PostRequest $request) {
    $newArticle=new Post();
    $newArticle->user_id=$request->get('authorID');
    $newArticle->title_post=$request->get('title');
    $newArticle->text_post=$request->get('body');
    $newArticle->save();
})->name('save');

Route::get('/readpost/{id}', function ($id) {
    $post=Post::find($id);
    return Inertia::render('Shared/Post',[
        'post'=>$post
    ]);
})->name('readpost');

Route::fallback(function () {
    return 'incorrect page';
});

require __DIR__ . '/auth.php';
