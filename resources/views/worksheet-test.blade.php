<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $worksheet->title }} - اختبار</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .answer-radio:checked + .answer-label {
            background-color: #3B82F6;
            color: white;
            border-color: #3B82F6;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $worksheet->title }}</h1>
            <p class="text-gray-600">{{ $worksheet->description }}</p>
        </div>

        <form action="{{ route('worksheets.test.store', $worksheet->uuid) }}" method="POST">
            @csrf
            
            @foreach($worksheet->questions as $index => $question)
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        السؤال {{ $index + 1 }}: {{ $question->text }}
                    </h2>
                    
                    <div class="space-y-3">
                        @foreach($question->answers as $answer)
                            <div>
                                <input type="radio" 
                                       name="answers[{{ $question->id }}]" 
                                       id="answer-{{ $answer->id }}" 
                                       value="{{ $answer->id }}"
                                       class="answer-radio hidden"
                                       required>
                                <label for="answer-{{ $answer->id }}" 
                                       class="answer-label block w-full p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                    {{ $answer->text }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="fixed bottom-0 left-0 right-0 bg-white p-4 shadow-lg">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition">
                    إنهاء الاختبار
                </button>
            </div>
        </form>
    </div>
</body>
</html>