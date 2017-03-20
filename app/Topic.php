<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Topic extends Model
{
    protected $fillable = ['name','questions_count'];
    
    public function questions()
    {
      return  $this->belongsToMany(Question::class)->withTimestamps();
    }
}
