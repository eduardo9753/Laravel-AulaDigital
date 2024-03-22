<?php

namespace App\Http\Controllers\visitador\read;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::all();
        return view('visitador.read.index', [
            'courses' => $courses
        ]);
    }

    public function show(Archive $archive)
    {
                   
        $course = Course::find($archive->course_id);
       
        return view('visitador.read.show', [
            'archive' => $archive,
            'course' => $course
        ]);
    }
}
