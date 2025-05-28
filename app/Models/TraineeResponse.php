<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TraineeResponse extends Model
{
    protected $fillable = [
        'trainee_session_id',
        'question_id',
        'answer_id'
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(TraineeSession::class, 'trainee_session_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}