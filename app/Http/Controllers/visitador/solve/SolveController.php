<?php

namespace App\Http\Controllers\visitador\solve;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SolveController extends Controller
{
    //

    public function index(Post $post)
    {
        return view('visitador.solve.index', [
            'post' => $post,
        ]);
    }
}
