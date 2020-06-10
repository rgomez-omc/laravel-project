@extends('layout')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" rel="stylesheet">
@endsection

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2 class="heading has-text-weight-bold is-size-3">Update Article</h2>

                    <form method="post" action="/articles/{{ $article->id }}">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label class="label" for="title">Title</label>

                            <div class="control">
                                <input class="input" type="text"  name="title" id="title" value="{{ $article->title }}">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="excerpt">Excerpt</label>

                            <div class="control">
                                <textarea class="textarea" name="excerpt" id="excerpt">{{ $article->excerpt }}</textarea>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="body">Body</label>

                            <div class="control">
                                <textarea class="textarea" name="body" id="body">{{ $article->body }}</textarea>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-link" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

