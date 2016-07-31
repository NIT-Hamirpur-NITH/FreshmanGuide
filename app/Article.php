<?php

namespace FreshmanGuide;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'slug'];
    protected $appends = ['status', 'section', 'count', 'cover_photo'];

    public function sections() {
        return $this->belongsToMany(Section::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function cover() {
        return $this->hasOne(Cover::class);
    }

    // custom attributes
    public function getStatusAttribute() {
        $value = 'New';
        if ($this->published) {
            $value = 'Published';
        }

        if ($this->edited) {
            $value = 'Edited';
        }

        if ($this->new) {
            $value = 'New';
        }

        return $value;
    }

    public function getSectionAttribute() {
        return $this->sections()->first();
    }

    public function getCoverPhotoAttribute() {
        if ($this->cover) {
            return url($this->cover->path);
        } else {
            return url('images/articles/default.jpg');
        }
    }

    public function ago() {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($this->updated_at))->diffForHumans();
    }

    public function getCountAttribute() {
        return $this->comments()->where('reply', '')->count();
    }

}
