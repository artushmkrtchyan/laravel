<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
  public $table = "category_post";

  protected $fillable = [
    'post_id', 'category_id',
  ];
}
