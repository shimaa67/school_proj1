<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lucture extends Model
{
   use HasFactory;
 protected $guarded = [] ;


  public function subject(){
 return $this->belongsTo(Subject::class);
 }

  public function teacher(){
 return $this->belongsTo(Teacher::class);
 }
}
