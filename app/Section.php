<?php

namespace FreshmanGuide;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['title', 'description', 'image'];
    protected $table = 'sections';

    public function articles() {
        return $this->belongsToMany(Article::class);
    }
}
