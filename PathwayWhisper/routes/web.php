<?php

use Illuminate\Support\Facades\Route;

// User Controllers
use App\Http\Controllers\User\Authcontroller_User;
use App\Http\Controllers\Shared\Authcontroller as Shared_Authcontroller;
use App\Http\Controllers\Shared\Postscontroller as Shared_Postscontroller;
use App\Models\Postsmodel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MentorsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Mentor\LivestreamController;

use App\Models\User;
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
// public routes
Route::get('/', function () {return view('parent.home');});

route::get('/signup', function(){return view('parent.signup');});
route::get('/login', function(){return view('parent.login');});

// auth middleware routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/forum', function () {
        // fetch all posts joining users table and comments table
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->select('posts.*', 'users.name','users.image','users.role')
            ->get();

        foreach ($posts as $post) {
            $post->comments = DB::table('comments')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->orderBy('comments.created_at', 'asc')
                ->select('comments.*', 'users.name','users.image','users.role')
                ->where('comments.post_id', $post->id)
                ->get();
                // count comments by not using db
            $post->comments_count = count($post->comments);
        }

        return view('forum.home',compact('posts'));});
    Route::get('/predictor', function () {return view('parent.predictor');});
    Route::get('/chatbot', function () {return view('parent.chatbot');});
    Route::get('/logout', [Shared_Authcontroller::class, 'logout'])->name('logout');

    route::post('/create_post', [Shared_Postscontroller::class, 'create_post'])->name('create_post');
    route::post('/create_comment', [Shared_Postscontroller::class, 'create_comment'])->name('create_comment');
});



// middleware to check if user is logged in
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'Rolemiddleware:admin'], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('admin.home');
            Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');
            
        
            // admins routes
            Route::get('/admins', [AuthController::class, 'admins'])->name('admin.admins');
            Route::post('/admins/create', [AuthController::class, 'create'])->name('admins.store');
            Route::get('/admins/delete/{id}', [AuthController::class, 'delete'])->name('admins.delete');
    
            // admins routes
            Route::get('/mentors', [MentorsController::class, 'mentors'])->name('mentors.mentors');
            Route::post('/mentors/create', [MentorsController::class, 'create'])->name('mentors.store');
            Route::get('/mentors/delete/{id}', [MentorsController::class, 'delete'])->name('mentors.delete');
        
        });
    });
    
});

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'Rolemiddleware:mentor'], function () {
        // view for mentor to create /live_stream
        Route::get('/live_stream', [LivestreamController::class, 'streampage'])->name('livestream.lobby');
        Route::get('/delete/livestream/{id}', [LivestreamController::class, 'delete_livestream']);
    });
    // profile
    Route::get('/profilesettings', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profilesettings/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profilesettings/update_password', [ProfileController::class, 'update_password'])->name('profile.update_password');
    // delete post and comment
    Route::get('/deletepost/{id}', [Shared_Postscontroller::class, 'delete_post'])->name('delete_post');
    Route::get('/deletecomment/{id}', [Shared_Postscontroller::class, 'delete_comment'])->name('delete_comment');
    // view for stream
    Route::get('/stream/{streamkey}', [LivestreamController::class, 'stream'])->name('livestream.stream');
    // /live_streams
    Route::get('/live_streams', [LivestreamController::class, 'get_livestreams'])->name('livestreams');
    
    
   
});

route::get('/resetpassword', function(){
    $users = User::all();
    // reset password 1234
    foreach($users as $user){
        $user->password = bcrypt('1234');
        $user->save();
    }
});

// shared routes
Route::post('/login', [Shared_Authcontroller::class, 'login'])->name('login');
Route::post('/signup', [Shared_Authcontroller::class, 'signup'])->name('signup');