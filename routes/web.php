<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\PhotoToPost;
use App\Models\Post;
use App\Models\User;
use Goutte\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', function () {
    return redirect()->route('latest');
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

Route::get('/latest', function (Request $request, PhotoToPost $photoToPost) {

//    $paths = DB::table('photo_to_posts')->where('post_id', $post->id)->get();

//    dd($paths);
//    $url=[];
//    $tile='';
//    foreach ($paths as $path) {
//        $url[$path->original_name]= Storage::url($path->path);
//        if ($path->tile_status){
//            $tile=$path->original_name;
//        }
//    }



    $test = Post::query()
        ->when($request->input('search'), function ($query, $search) {
            $query->where('title_post', 'like', "%{$search}%");
        })
        ->with('user')
        ->latest()
        ->paginate(6)
        ->withQueryString()
        ->through(fn($post) => [
            'id' => $post->id,
            'name' => $post->user->name,
            'title_post' => $post->title_post,
            'created_at' => $post->created_at,
            'tilePath'=> DB::table('photo_to_posts')->where('post_id', $post->id)->where('tile_status',1)->first()
        ]);

    return Inertia::render('Shared/LatestPost', [
        'test' => $test,
        'counterPosts' => Post::count(),
        'filter' => $request->only(['search'])
    ]);
})->name('latest');

Route::get('/allmyposts', function () {
    $userId = auth()->id();
    $MyPost = User::find($userId)->posts()->latest()->paginate(10);
    return Inertia::render('Shared/AllMyPosts', [
        'userPosts' => $MyPost,

    ]);
})->name('allMy');

Route::get('/author-page', function () {
    return Inertia::render('Shared/AuthorPage');
})->name('Authorpage');

Route::get('/weather', function (Client $scraper) {
    $searchLocation = 'Заліщики';
    $getPage = $scraper->request('GET', 'http://dnister.meteo.gov.ua/ua/hydro_operational_data');
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

//    dd($request->all());

    $newPost = new Post();
    $newPost->title_post = $request->get('title');
    $newPost->text_post = $request->get('body');
    $newPost->user_id = auth()->id();
    $newPost->save();



    if (!empty($request->all()['photo'])) {
        foreach ($request->all()['photo'] as $photo) {

            if($photo->getClientOriginalName()!==$request->get('tile')){
            $path = $photo->store('photo', 'public');
            $originalName = $photo->getClientOriginalName();
            $newPhoto = new PhotoToPost();
            $newPhoto->post_id = $newPost->id;
            $newPhoto->path = $path;
            $newPhoto->original_name = $originalName;
            $newPhoto->save();
            }

            if($photo->getClientOriginalName()===$request->get('tile')){
                $path = $photo->store('photo', 'public');
                $originalName = $photo->getClientOriginalName();
                $newPhoto = new PhotoToPost();
                $newPhoto->tile_status = true;
                $newPhoto->post_id = $newPost->id;
                $newPhoto->path = $path;
                $newPhoto->original_name = $originalName;
                $newPhoto->save();
            }
        }

    }


    return redirect()->back()->with([
        'message' => 'The save successfully',
    ]);
})->name('save');


Route::post('/saveEdit', function (PostRequest $request) {
    $EditPost = Post::find($request->get('id'));
    $EditPost->title_post = $request->get('title');
    $EditPost->text_post = $request->get('body');
    $EditPost->save();

    return redirect()->back()->with([
        'message' => 'The update successfully',
    ]);
})->name('saveEdit');

Route::delete('/delete', function (Request $request) {
    $detePost = Post::find($request->get('DeletePost'));
    $detePost->delete();
    return redirect()->back()->with([
        'message' => 'The delete successfully',
    ]);
})->name('delete');

Route::get('/edit', function (Request $request) {
    $editPost = Post::find($request->get('EditPost'));
    return Inertia::render('Shared/Edit', [
        'editPosts' => $editPost
    ]);
})->name('edit');


Route::get('/readpost/{post}', function (Post $post, PhotoToPost $photoToPost) {


//    $path=PhotoToPost::where('post_id',$post->id)->path->get();
    $paths = DB::table('photo_to_posts')->where('post_id', $post->id)->get();

//    dd($paths);
    $url=[];
$tile='';
    foreach ($paths as $path) {
       $url[$path->original_name]= Storage::url($path->path);
       if ($path->tile_status){
           $tile=$path->original_name;
       }
    }
//    dd($url);
//
//    $url = Storage::url($path);

    $comments = Comment::with('user')->where('post_id', $post->id)->get();

//    dd($comments);

    return Inertia::render('Shared/Post', [
        'post' => $post,
        'url' => $url,
        'comments'=>$comments,
        'tile'=>$tile
    ]);
})->name('readpost');

Route::post('/addPost', function (Request $request, Comment $comment) {
    $validated = $request->validate([
        'text' => 'required|max:20',
    ]);
    $comment->user_id = $request->get('userId');
    $comment->post_id = $request->get('postId');
    $comment->content = $validated['text'];
    $comment->save();

})->name('addPost');

Route::get('/lee', function (Post $post) {

    $del = Storage::download('photo/r96e4Ofc0TPoRBChtYfYwW2mSoFKnPqEwfESnKYU.png');
//    dd($del);

})->name('lee');


Route::post('/post', function (Request $request) {


    $request->validate([
        'photo1' => 'file|image|max:2048|mimes:jpeg,jpg,png',
        'photo2' => 'file|image|max:2048|mimes:jpeg,jpg,png',
        'photo3' => 'file|image|max:2048|mimes:jpeg,jpg,png',
    ]);
    dd($request->all());
    $path = $request->file('photo')->store('photo', 'public');

    dd($path);
    return Inertia::render('up');
})->name('photo');

Route::get('/test', function () {

    // hash name: "photo/pc8nr35vU9m3S3XvGZLcCUU7o6OnaQqmUZrL7FBc.png"
    // original name: Screenshot from 2024-03-09 08-40-19.png

    $path = Storage::path('pc8nr35vU9m3S3XvGZLcCUU7o6OnaQqmUZrL7FBc.png');
//    dd($path);

    $exist = Storage::exists($path);
//    dd($exist);

    Storage::disk('public')->delete('photo/pc8nr35vU9m3S3XvGZLcCUU7o6OnaQqmUZrL7FBc.png');
//    Storage::delete('Screenshot from 2024-03-09 08-40-19.png');
//    Storage::delete('pc8nr35vU9m3S3XvGZLcCUU7o6OnaQqmUZrL7FBc.png');
//    Storage::delete($path);

    $files = Storage::disk('public')->files('photo');

    //dd($files);

    $url = Storage::url('photo/cB7dfySzdsLvMXVlKN8jgUZbDXzKb68y8WAHvpMa.png');

    return Inertia::render('Shared/AddPhoto', [
        'test' => $url
    ]);
});

//Route::fallback(function () {
//    return 'incorrect page';
//});

require __DIR__ . '/auth.php';
