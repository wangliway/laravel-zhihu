<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:6|max:196',
            'body' => 'required|min:6',
            'topics' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写标题！',
            'title.min' => '标题必须为6个字符',
            'title.max' => '标题不能超过196个字符',
            'body.required' => '请填写问题描述',
            'body.min' => '问题必须为6个字符',
            'topics.required'=>'请选择一个话题'
        ];
    }
}
