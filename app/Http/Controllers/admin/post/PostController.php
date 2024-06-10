<?php

namespace App\Http\Controllers\admin\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        return view('admin.post.index');
    }

    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'title' => 'required|string|max:60',
            'content' => 'required|string'
        ]);

        // Mostrar los datos enviados desde el formulario
        //dd($request->all());

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1, //activo
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }
}
