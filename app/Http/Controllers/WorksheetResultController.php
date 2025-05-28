<?php

namespace App\Http\Controllers;

use App\Models\TraineeSession;

class WorksheetResultController extends Controller
{
    public function show($uuid)
    {
        $session = TraineeSession::with(['worksheet.fields', 'responses.answer'])
            ->where('uuid', $uuid)
            ->firstOrFail();
            
        $fields = $session->worksheet->fields->map(function($field) use ($session) {
            return [
                'name' => $field->name,
                'analysis' => $field->analysis,
                'score' => $session->total_points >= $field->min_points && 
                          $session->total_points <= $field->max_points ? 
                          $session->total_points : null
            ];
        })->filter(fn($field) => !is_null($field['score']));

        return view('test-result', compact('session', 'fields'));
    }
}