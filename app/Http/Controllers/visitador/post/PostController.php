<?php

namespace App\Http\Controllers\visitador\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //lista de publicaciones y que le den linke o dislike
    public function index()
    {
        return view('visitador.post.index');
    }

    //para ver cada publicacion y poder comentar
    public function comment(Post $post)
    {
        //dd($post);
        $randomPosts = Post::inRandomOrder()->limit(4)->get();
        return view('visitador.post.comment', [
            'post' => $post,
            'randomPosts' => $randomPosts
        ]);
    }
}
