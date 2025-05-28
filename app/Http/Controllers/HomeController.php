<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Worksheet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fields = Field::all(); // لجلب المجالات لاستخدامها في النموذج
        $worksheets = Worksheet::with('user', 'questions')->latest()->get(); // جلب أوراق العمل مع المستخدم والأسئلة
        
        return view('home', compact('fields', 'worksheets'));
    }
}


