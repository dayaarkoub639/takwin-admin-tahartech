<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Question;
use App\Models\Field;
use App\Models\TraineeSession;

class Worksheet extends Model
{

        protected $fillable = [
        'title', 'description', 'user_id', 'uuid', 'total_points', 'is_active'
    ];
    
    // علاقة المستخدم
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // علاقة الأسئلة
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }



    // علاقة جلسات المتدربين
    public function traineeSessions(): HasMany
    {
        return $this->hasMany(TraineeSession::class);
    }

        // علاقة مع الحقول (مجالات تحليل الشخصية)
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}







