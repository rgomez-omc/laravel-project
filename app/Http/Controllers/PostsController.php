<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;


class PostsController extends Controller
{

    public function show($slug)
    {
        // The backslash "\" proceeding DB::table is because we are not in the correct namespace
        // an alternative would be to use "use DB;"
        // Using the DB Class, select from the 'posts' table
        // where the 'slug' column is equal to what we fetched from the URI ($slug)
        // and give me the first result
        // $post = DB::table('posts')->where('slug', $slug)->first();

        // Above uses DB Class, below Eloquent Model
        $post = Post::where('slug', $slug)->firstOrFail();

        // Helper function dd() Dump & Die
        // dd($post);

        // $posts = [
        //    'my-first-post' => 'Hello, this is my first blog post!',
        //    'my-second-post' => 'Now I\'m getting the hang of this blogging thing.'
        // ];

        // if (! array_key_exists($post, $posts)) {
        //    abort(404, 'Sorry, that post was not found');
        //}

        // if(! $post) {
        //      abort(404);
        //}

        return view('post', [
            'post' => $post
        ]);
    }






}
