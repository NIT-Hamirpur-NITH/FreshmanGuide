<?php

namespace FreshmanGuide;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'slug'];
    protected $appends = ['status', 'section'];

    public function sections() {
        return $this->belongsToMany(Section::class);
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

    public function ago() {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($this->updated_at))->diffForHumans();
    }

}
