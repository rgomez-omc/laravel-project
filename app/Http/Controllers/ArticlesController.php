<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        // Render a list of a resource

        $articles = Article::latest()->get();

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
        return view('articles.create');
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

        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
        Article::create([
            'title' => request('title'),
            'excerpt' => request('excerpt'),
            'body' => request('body')
        ]);







        return redirect('/articles');
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
        $article->save();

        return redirect('/articles/' . $article->id);


    }

    public function destroy()
    {
        // Delete the resource
    }






}
