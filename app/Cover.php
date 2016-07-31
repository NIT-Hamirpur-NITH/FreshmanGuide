<?php

namespace FreshmanGuide;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model {

  public function article() {
    return $this->belongsTo(Article::class);
  }

}
