<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTags extends Model
{
    //
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo('App\Articles', 'article_id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tags', 'tag_id');
    }
}
