<?php

namespace App\Http\Controllers\visitador\examResponder;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class ExamFreeResponder extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::where('status', 3)->whereIn('id', [13])->get();

        return view('visitador.examFreeResponder.index', [
            'courses' => $courses
        ]);
    }
}
