<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Topic extends Model
{
    protected $fillable = ['name', 'questions_count', 'bio'];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    /**
     *当有新的topics 时生成新的topics
     * @param $topics
     * @return static
     */
    public static function createNewTopic($topics)
    {

    }
}
