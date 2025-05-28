<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج الاختبار</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="p-6 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">نتيجة الاختبار {{ $session->worksheet->title }}</h1>
                <p class="text-gray-600 mb-4">مجموع النقاط: <span class="font-bold">{{ $session->total_points }}</span></p>
                <p class="text-sm text-gray-500" style="display: none;">رقم الجلسة: {{ $session->uuid }}</p>
            </div>
        </div>

        @if($fields->count() > 0)
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">تحليل النتائج</h2>
                
                @foreach($fields as $field)
                    <div class="mb-4 last:mb-0">
                        <h3 class="font-medium text-lg text-blue-600">{{ $field['name'] }}</h3>
                        <p class="text-gray-700">{{ $field['analysis'] }}</p>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                            <div class="bg-blue-600 h-2.5 rounded-full" 
                                 style="width: {{ ($field['score'] / $session->worksheet->fields->max('max_points')) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('worksheets.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg transition">
            العودة إلى قائمة الأوراق
        </a>
    </div>
</body>
</html>