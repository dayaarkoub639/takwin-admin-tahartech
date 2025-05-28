<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    // تحديد الحقول القابلة للتعبئة
   protected $fillable = ['name', 'min_points', 'max_points', 'analysis', 'worksheet_id'];

    // علاقة الانتماء إلى ورقة العمل
    public function worksheet()
    {
        return $this->belongsTo(Worksheet::class);
    }
}
