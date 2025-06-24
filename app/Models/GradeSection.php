<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeSection extends Model
{
   use HasFactory;
    protected $guarded = [] ;


    function section(){
     return $this->belongsTo(Section::class);
    }
}
