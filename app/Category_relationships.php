<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_relationships extends Model
{
  protected $fillable = [
    'category_id', 'parent', 'order',
  ];
}
