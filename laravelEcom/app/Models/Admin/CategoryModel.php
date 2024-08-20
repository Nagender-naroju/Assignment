<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
  protected $table = 'categories';
   
  protected $fillable = [
    'category_name',
    'category_image',
    'status'
  ];
}
