<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTaxonomy extends Model
{
  public $table = "category_taxonomy";

  protected $fillable = [
    'category_id', 'parent', 'order',
  ];
}
