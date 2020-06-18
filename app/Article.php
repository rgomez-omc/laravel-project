<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Eloquent\MassAssignmentException protection
    // Override Protection with:
    // Explicitly define all column names that can be mass assigned
    // protected $fillable = ['title', 'excerpt', 'body'];

    // Alternatively, you can TURN OFF this feature with:
    protected $guarded = [];

    public function path()
    {
        // Using actual path & id
        // return '/articles/'. $this->id;

        // Using a Named Route and passing the entire Object - the instance ($this)
        return route('articles.show', $this);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }




}
