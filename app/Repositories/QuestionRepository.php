<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/22 0022
 * Time: 9:35
 */

namespace App\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository
{
    /**
     * 根据问题id查找问题附带topics
     * @param $id
     * @return mixed
     */
    public function questionWithTopicBy($id)
    {
        return Question::where('id', $id)->with('topics')->first();
    }

    public function questionBy($id)
    {
        return Question::where('id',$id)->first();
    }
    /**
     * 新增一个问题
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Question::create($attributes);
    }

    /**
     * 选择话题时新增话题或选择话题格式话话题id
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        $topic_ids = collect($topics)->map(function ($topic) {
            //如果是数字可能为数据库已经存在的话题也可能为新增的数字
            if (is_numeric($topic)) {
                Topic::find($topic)->increment('questions_count');
                return $topic;
            }
            return Topic::create(['name' => $topic, 'questions_count' => 1])->id;
        })->toArray();
        return $topic_ids;
    }

    /**
     * @param array $attributes
     * @param $questionId
     * @return Question
     */
    public function update(array $attributes, $questionId)
    {
        return Question::where('id', $questionId)->update($attributes);
    }

    public function getQuestions()
    {
        return Question::published()->latest()->with('user')->get();
    }
}