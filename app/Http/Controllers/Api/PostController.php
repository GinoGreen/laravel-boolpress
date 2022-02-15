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
            $post->cover = $this->getImgPath($post->cover);
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

        $post->cover = $this->getImgPath($post->cover);

        return response()->json($post);
    }

    public function getImgPath($cover) {
        if ($cover) {
            $cover = url('storage/' . $cover);
        } else {
            $cover = url('img/img-placeholder.png');
        }
        return $cover;
    }
}
