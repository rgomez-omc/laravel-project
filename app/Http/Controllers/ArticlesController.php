<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        // Render a list of a resource

        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', ['articles' => $articles]);

    }


    public function show(Article $article)
    {
        // Show a single resource
        // $article = Article::find($id);
        // $article = Article::findOrFail($id);  // Replaced by call to Model above (Article $article)

        return view('articles.show', ['article' => $article]);
    }


    public function create()
    {
        // Show a view to create a new resource
        // die('Hello Create');
        // Loading view only:
        // return view('articles.create');

        // return view and pass tags:
        return view('articles.create', [
            'tags' => Tag::all()
        ]);



    }


    public function store()
    {
        // Persist the new resource from create()
        // die('Hello Store()');

        // Data is in the Request() helper
        // dump(request()->all());

        /*  The LONG way:
        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save(); */

        /* OLD
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        Article::create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        ]); */

        /* OLD
        $validatedAttributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        Article::create($validatedAttributes); */

        /* NEW
        Article::create($this->validateArticle()); */

        // testing:
        // dd(request()->all());

        // Can't create Article yet because a recent update now requires a user_id
        // So we will instantiate it first, then hard code the user_id
        // Article::create($this->validateArticle());

        /* OLD - validation no longer maps to Article properties
        $article = new Article($this->validateArticle());
        $article->user_id = 1; // after we learn authentication then: auth()->id();
        $article->save();
        $article->tags()->attach(request('tags')); //tags is an array [1,2,3] */

        $this->validateArticle();
        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // after we learn authentication then: auth()->id();
        $article->save();
        $article->tags()->attach(request('tags')); //tags is an array [1,2,3]


        // return redirect('/articles');
        // Updated using Named Routes
        return redirect(route('articles.index'));

    }


    public function edit(Article $article)
    {
        // Show a view to edit an existing resource
        // die('Hello Edit');

        // Find the Article object associated with the id in the URI
        // $article = Article::find($id);  // Replaced by call to Model above (Article $article)

        //Pass the Article object to the view
        // return view('articles.edit', ['article' => $article]);

        // Alternate code using compact() function
        return view('articles.edit', compact('article'));

    }


    public function update(Article $article)
    {
        // Persist the edited resource

        /* OLD
        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        // Find the Article object associated with the id in the URI
        // $article = Article::find($id);  // Replaced by call to Model above (Article $article)
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save(); */

        $article->update($this->validateArticle());

        // return redirect('/articles/' . $article->id);
        // Updated using Named Routes
        // return redirect(route('articles.show', $article));

        // Using new path() Method in Article Model
        return redirect($article->path());
    }


    public function destroy()
    {
        // Delete the resource
    }


    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }


}
