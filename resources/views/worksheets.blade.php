<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أوراق العمل</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">أوراق العمل المتاحة</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($worksheets->where('is_active', true) as $worksheet)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $worksheet->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ $worksheet->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                {{ $worksheet->questions_count }} أسئلة
                            </span>
                            <a href="{{ route('worksheets.test.show', $worksheet->uuid) }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                                بدء الاختبار
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>