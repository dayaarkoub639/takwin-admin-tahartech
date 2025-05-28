<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'question' => 'required|string',
        'answers' => 'required|array|min:1',
        'answers.*.text' => 'required|string',
        'answers.*.points' => 'required|integer',
        'answers.*.field_id' => 'required|exists:fields,id',
    ]);

    $question = Question::create([
        'text' => $request->input('question'),
    ]);

    foreach ($request->answers as $answerData) {
        $question->answers()->create($answerData);
    }

    return back()->with('success', 'تم حفظ السؤال والإجابات بنجاح');
}

}
