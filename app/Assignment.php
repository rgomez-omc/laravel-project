<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function complete()
    {
        // Update 'completed' field to TRUE
        $this->completed = true;
        $this->save();
    }









}
