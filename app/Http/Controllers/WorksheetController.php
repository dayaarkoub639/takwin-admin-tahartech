<?php

namespace App\Http\Controllers;

use App\Models\Worksheet;

use App\Models\Question;
use App\Models\TraineeSession;
use App\Models\Answer;
use App\Models\Field;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;


class WorksheetController extends Controller
{
        public function index()
    {
        $worksheets = Worksheet::with(['user', 'questions'])->latest()->get();
        return view('worksheets', compact('worksheets'));
    }

    public function create()
    {
        return view('worksheets.create');
    }

    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fields' => 'array',
            'fields.*.name' => 'required|string',
            'fields.*.from' => 'required|integer',
            'fields.*.to' => 'required|integer',
            'fields.*.analysis' => 'required|string',
        ]);

        // إنشاء ورقة العمل
        $worksheet = Worksheet::create([
            'title' => $request->title,
            'description' => $request->description,
            'uuid' => (string) Guid::uuid4(), // إضافة UUID لتتبع الورقة
            'total_points' => 0, // إضافة مجموع النقاط الافتراضي
            'user_id' => auth()->id(), // ✅ هذا السطر هو المفتاح لحل المشكلة
        ]);

        // حفظ مجالات تحليل الشخصية
        if ($request->has('fields')) {
            foreach ($request->fields as $field) {
                $worksheet->fields()->create([
                    'name' => $field['name'],
                    'min_points' => $field['from'], // <-- بدل points_from
                    'max_points' => $field['to'],   // <-- بدل points_to
                    'analysis' => $field['analysis'],
                ]);
            }
        }

        // حفظ الأسئلة والأجوبة
        foreach ($request->questions as $q) {
            $question = $worksheet->questions()->create([
                'text' => $q['text'],
            ]);

            foreach ($q['answers'] as $a) {
                $question->answers()->create([
                    'text' => $a['text'],
                    'points' => $a['points'],
                ]);
            }
        }

        // إعادة التوجيه بعد حفظ ورقة العمل
        return redirect()->route('worksheets.create')->with('success', 'تم إنشاء ورقة العمل بنجاح.');
    }

            public function destroy(Worksheet $worksheet)
        {
            $worksheet->delete();
            return redirect()->back()->with('success', 'تم حذف ورقة العمل بنجاح');
        }

        public function toggle(Worksheet $worksheet)
            {
                $worksheet->update(['is_active' => !$worksheet->is_active]);
                return back()->with('success', 'تم تحديث حالة الورقة بنجاح');
            }

           public function showResults($id)
{
    $worksheet = Worksheet::with('fields')->findOrFail($id);
    $date = request('date', now()->format('Y-m-d'));

    // جلسات المتكونين لليوم المطلوب
    $sessions = TraineeSession::where('worksheet_id', $id)
        ->whereDate('created_at', $date)
        ->get();

    // تهيئة الإحصائيات
    $fieldStats = [];
    foreach ($worksheet->fields as $field) {
        $fieldStats[$field->id] = [
            'trainees_count' => 0,
            'total_points' => 0,
            'avg_points' => 0,
            'percentage' => 0
        ];
    }

    // تحليل كل session حسب المجال المناسب لنقاطه
    foreach ($sessions as $session) {
        $matchedField = $worksheet->fields->first(function ($field) use ($session) {
            return $session->total_points >= $field->min_points && $session->total_points <= $field->max_points;
        });

        if ($matchedField) {
            $fieldId = $matchedField->id;
            $fieldStats[$fieldId]['trainees_count']++;
            $fieldStats[$fieldId]['total_points'] += $session->total_points;
        }
    }

    // حساب المتوسط والنسبة المئوية لكل مجال
    foreach ($worksheet->fields as $field) {
        if ($fieldStats[$field->id]['trainees_count'] > 0) {
            $avg = $fieldStats[$field->id]['total_points'] / $fieldStats[$field->id]['trainees_count'];
            $fieldStats[$field->id]['avg_points'] = round($avg, 2);
            $fieldStats[$field->id]['percentage'] = round(($avg / $field->max_points) * 100, 2);
        }
    }

    return view('worksheets.results', [
        'worksheet' => $worksheet,
        'fields' => $worksheet->fields,
        'fieldStats' => $fieldStats,
        'date' => $date
    ]);
}


}
