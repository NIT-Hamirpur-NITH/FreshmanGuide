<?php

namespace FreshmanGuide;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'message'];
    protected $appends = ['status', 'section'];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
