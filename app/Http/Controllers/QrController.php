<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
public function showQr()
{
    // الحصول على الـ host من إعدادات الأرتيسان أو استخدام القيمة الافتراضية
    $host = env('APP_URL', 'http://192.168.1.2:8000');
    
    // إذا كان السيرفر يعمل على localhost
    if (str_contains($host, 'localhost') || str_contains($host, '127.0.0.1')) {
        $host = 'http://192.168.1.2:8000'; // أو أي IP آخر تريده
    }
    
    $url = "{$host}/teste";
    
    return view('qr.show', compact('url'));
}
}