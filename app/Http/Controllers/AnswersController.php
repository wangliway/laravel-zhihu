<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public $answerRepository;

    /**
     * AnswersController constructor.
     * @param AnswerRepository $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }


    public function store(Request $request, $questionId)
    {
        $data = [
            'body' => $request->get('body'),
            'question_id' => $questionId,
            'user_id' => Auth::id(),
        ];
        $this->answerRepository->create($data);

    }
}
