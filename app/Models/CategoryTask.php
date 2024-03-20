<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTask extends Model
{
    use HasFactory;
    protected $table = 'categorytasks';

    protected $fillable = ['category_id','task_id'];
}
