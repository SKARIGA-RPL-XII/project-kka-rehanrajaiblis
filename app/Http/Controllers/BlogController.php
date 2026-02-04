<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->with('user')
            ->latest()
            ->paginate(9);

        return view('blog.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::published()
            ->with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('blog.show', compact('article'));
    }
}