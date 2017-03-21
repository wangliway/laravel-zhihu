<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

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
        $topic_ids = collect($topics)->map(function ($topic) {
            //如果是数字可能为数据库已经存在的话题也可能为新增的数字
            if (is_numeric($topic)) {
                self::find($topic)->increment('questions_count');
                return $topic;
            }
            return self::create(['name' => $topic,'questions_count'=>1])->id;
        });
        return $topic_ids->toArray();
    }
}
