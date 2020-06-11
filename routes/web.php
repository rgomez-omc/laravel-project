<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

//Route::get('/', function () {
//    $name = request('name');
//    return view('test', [
//        'name' => $name
//    ]);
//});

/*
Route::get('/post/{post}', function ($post) {
    //return view('post');

    $posts = [
        'my-first-post' => 'Hello, this is my first blog post!',
        'my-second-post' => 'Now I\'m getting the hang of this blogging thing.'
    ];

    if (! array_key_exists($post, $posts)) {
        abort(404, 'Sorry, that post was not found');
    }

    return view('post', [
        'post' => $posts[$post]
        ]);
});
*/

//Route::get('/post/{post}', 'PostsController@show');

Route::get('/about', function () {
//    $articles = App\Article::all();
//    $articles = App\Article::take(2)->get();
//    $articles = App\Article::paginate(2);
//    return $articles;
    /* // Longhand
    $articles = App\Article::latest()->get();

    return view('about', [
        'articles' => $articles
        ]);  */

    return view('about', [
        'articles' => App\Article::take(3)->latest()->get()
    ]);
});

Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');
Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');













