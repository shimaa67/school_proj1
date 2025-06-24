<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $guarded = [] ;
   public static function getIdByTag($tag){
     $stage=self::query()->where('tag',$tag)->first();
     return $stage->id;
    }
}
