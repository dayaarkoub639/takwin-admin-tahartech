<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['worksheet_id', 'text'];

    public function worksheet()
    {
         return $this->belongsTo(Worksheet::class, 'worksheet_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function responses()
    {
        return $this->hasMany(TraineeResponse::class);
    }

    public function field()
        {
            return $this->belongsTo(Field::class);
        }


}