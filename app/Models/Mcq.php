<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'image_thumbnail', 'option', 'option_image', 'answer'];
}
