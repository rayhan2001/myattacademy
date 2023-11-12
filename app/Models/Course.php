<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;
    public function language()
    {
        return $this->belongsTo(Language::class,'language_id','id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id','id');
    }
}
