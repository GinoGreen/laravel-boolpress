<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {

        $posts = Post::with(['category', 'tags'])->paginate(3);

        $posts->each(function($post) {
            if ($post->cover) {
                $post->cover = url('storage/' . $post->cover);
            } else {
                $post->cover = url('img/img-placeholder.png');
            }
        });

        return response()->json($posts);
    }

    public function show($slug) {

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        if (!$post) {
            $post = [
                'title' => 'Post non trovato',
                'content' => '',
            ];
        }

        return response()->json($post);
    }
}
