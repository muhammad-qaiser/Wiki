<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
    public function article()
    {
        return $this->belongsTo('App\ArticleTags', 'id');
    }
}
