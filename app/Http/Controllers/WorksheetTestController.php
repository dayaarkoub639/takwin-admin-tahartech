<?php

namespace App\Http\Controllers;

use App\Models\Worksheet;
use App\Models\TraineeSession;
use App\Models\TraineeResponse;
use App\Models\Answer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WorksheetTestController extends Controller
{
    public function show($uuid)
    {
        $worksheet = Worksheet::with(['questions.answers', 'fields'])
                        ->where('uuid', $uuid)
                        ->firstOrFail();
        
        return view('worksheet-test', compact('worksheet'));
    }

    public function store(Request $request, $uuid)
    {
        $worksheet = Worksheet::where('uuid', $uuid)->firstOrFail();
        
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:answers,id'
        ]);

        // إنشاء جلسة جديدة
        $session = new TraineeSession();
        $session->id = Str::uuid();
        $session->worksheet_id = $worksheet->id;
        $session->uuid = Str::uuid();
        $session->total_points = 0;
        $session->save();

        $totalPoints = 0;
        
        foreach ($validated['answers'] as $questionId => $answerId) {
            $answer = Answer::find($answerId);
            
            TraineeResponse::create([
                'trainee_session_id' => $session->id,
                'question_id' => $questionId,
                'answer_id' => $answerId
            ]);
            
            $totalPoints += $answer->points;
        }

        $session->update(['total_points' => $totalPoints]);

        return redirect()->route('results.show', $session->uuid);
    }
}