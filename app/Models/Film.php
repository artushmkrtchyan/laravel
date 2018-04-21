<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
  protected $fillable = [
      'title', 'description', 'year', 'youtube_id', 'vidio_embed', 'author_id', 'status', 'image',
  ];

  public function genres()
  {
    return $this->belongsToMany(Genre::class);
  }

  public function actors()
  {
    return $this->belongsToMany(Actor::class);
  }

}
