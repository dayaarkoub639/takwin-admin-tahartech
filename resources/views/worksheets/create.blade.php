@extends('layouts.app')

@section('content')
<!-- استيراد الخط من Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

<style>
    body {
        direction: rtl;
        font-family: 'Tajawal', sans-serif;
        background: linear-gradient(to bottom, #e3f2fd, #ffffff);
        background-attachment: fixed;
        margin: 0;
        padding: 0;
    }

    .worksheet-container {
        background-color: #ffffff;
        background-image: url('/images/background.png'); /* تأكد من وجود الصورة */
        background-repeat: no-repeat;
        background-position: top center;
        background-size: 120px;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-top: 50px;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        font-weight: bold;
        margin-bottom: 30px;
    }

    label {
        font-weight: bold;
        color: #34495e;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
    }

    .card {
        border-radius: 15px;
        background-color: #fafafa;
        border: 1px solid #ddd;
    }
</style>

<div class="container worksheet-container">
    <h2>📝 إنشاء ورقة عمل جديدة</h2>

    <form method="POST" action="{{ route('worksheets.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">عنوان الورقة</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">وصف الورقة (اختياري)</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <hr>
        <div id="questions-wrapper">
            <!-- الأسئلة ستُضاف ديناميكياً -->
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="button" class="btn btn-secondary" onclick="addQuestion()">➕ إضافة سؤال</button>
        </div>

        <hr>
        <h4 class="mt-4">🔍 مجالات تحليل الشخصية حسب النقاط</h4>
        <div id="fields-wrapper"></div>
        <button type="button" class="btn btn-secondary mt-2 mb-4" onclick="addField()">➕ إضافة مجال</button>

        <hr>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-primary">💾 حفظ ورقة العمل</button>
        </div>
    </form>
</div>

<script>
    let questionCount = 0;
    let fieldCount = 0;

    // إضافة سؤال
    function addQuestion() {
        let questionHTML = `
            <div class="card p-4 mb-4">
                <label>السؤال:</label>
                <input type="text" name="questions[${questionCount}][text]" class="form-control mb-3" required>

                <div class="answers-wrapper">
                    <label>الأجوبة:</label>
                    <div id="answers-${questionCount}">
                        ${generateAnswerFields(questionCount, 0)}
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="addAnswer(${questionCount})">➕ إضافة جواب</button>
                </div>
            </div>
        `;
        document.getElementById('questions-wrapper').insertAdjacentHTML('beforeend', questionHTML);
        questionCount++;
    }

    // إضافة جواب
    function generateAnswerFields(questionIndex, answerIndex) {
        return `
            <div class="d-flex flex-row-reverse gap-2 mb-2">
                <input type="text" name="questions[${questionIndex}][answers][${answerIndex}][text]" class="form-control" placeholder="نص الجواب" required>
                <input type="number" name="questions[${questionIndex}][answers][${answerIndex}][points]" class="form-control" placeholder="النقاط" required>
            </div>
        `;
    }

    function addAnswer(questionIndex) {
        const answersDiv = document.getElementById(`answers-${questionIndex}`);
        const currentIndex = answersDiv.children.length;
        answersDiv.insertAdjacentHTML('beforeend', generateAnswerFields(questionIndex, currentIndex));
    }

    // إضافة مجال تحليل الشخصية
    function addField() {
        let fieldHTML = `
            <div class="card p-4 mb-4" id="field-${fieldCount}">
                <label>اسم المجال:</label>
                <input type="text" name="fields[${fieldCount}][name]" class="form-control mb-3" required>

                <label>من النقاط:</label>
                <input type="number" name="fields[${fieldCount}][from]" class="form-control mb-3" required>

                <label>إلى النقاط:</label>
                <input type="number" name="fields[${fieldCount}][to]" class="form-control mb-3" required>

                <label>التحليل:</label>
                <textarea name="fields[${fieldCount}][analysis]" class="form-control mb-3" required></textarea>

                <button type="button" class="btn btn-danger mt-2" onclick="removeField(${fieldCount})">🗑️ حذف المجال</button>
            </div>
        `;
        document.getElementById('fields-wrapper').insertAdjacentHTML('beforeend', fieldHTML);
        fieldCount++;
    }

    // إزالة مجال
    function removeField(fieldIndex) {
        document.getElementById(`field-${fieldIndex}`).remove();
    }
</script>

@endsection


