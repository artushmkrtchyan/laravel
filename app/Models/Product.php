<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $fillable = [
    'name', 'description', 'price', 'code', 'image',
  ];

  public function shops()
  {
      return $this->belongsToMany(Shop::class);
  }
}
