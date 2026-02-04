@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="pt-20 pb-16">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('blog.index') }}" class="hover:text-blue-600">Blog</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li class="text-gray-900">{{ Str::limit($article->title, 50) }}</li>
            </ol>
        </nav>

        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $article->title }}
            </h1>
            
            <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-6">
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=3b82f6&color=fff" 
                         alt="{{ $article->user->name }}" 
                         class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <p class="font-medium text-gray-900">Dr. {{ $article->user->name }}</p>
                        <p class="text-sm text-gray-500">Dokter</p>
                    </div>
                </div>
                
                <div class="flex items-center text-sm">
                    <i class="fas fa-calendar mr-2"></i>
                    {{ $article->created_at->format('d F Y') }}
                </div>
                
                <div class="flex items-center text-sm">
                    <i class="fas fa-clock mr-2"></i>
                    {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit baca
                </div>
            </div>

            @if($article->thumbnail)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                </div>
            @endif
        </header>

        <!-- Article Content -->
        <article class="prose prose-lg max-w-none">
            <div class="bg-white rounded-xl shadow-sm p-8">
                {!! nl2br(e($article->content)) !!}
            </div>
        </article>

        <!-- Article Footer -->
        <footer class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <!-- Author Info -->
                <div class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->name) }}&background=3b82f6&color=fff" 
                         alt="{{ $article->user->name }}" 
                         class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h3 class="font-bold text-gray-900">Dr. {{ $article->user->name }}</h3>
                        <p class="text-gray-600">Dokter Profesional</p>
                        <p class="text-sm text-gray-500">Artikel dipublikasikan {{ $article->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Back to Blog -->
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Blog
                </a>
            </div>
        </footer>

        <!-- Related Articles -->
        @php
            $relatedArticles = App\Models\Article::published()
                ->where('id', '!=', $article->id)
                ->latest()
                ->take(3)
                ->get();
        @endphp

        @if($relatedArticles->count() > 0)
            <section class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Artikel Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                     alt="{{ $related->title }}" 
                                     class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-2xl text-blue-400"></i>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-blue-600">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ Str::limit(strip_tags($related->content), 80) }}
                                </p>
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $related->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose p {
    margin-bottom: 1.25em;
}

.prose h1, .prose h2, .prose h3, .prose h4 {
    color: #111827;
    font-weight: 700;
    margin-top: 2em;
    margin-bottom: 1em;
}

.prose h1 { font-size: 2.25em; }
.prose h2 { font-size: 1.875em; }
.prose h3 { font-size: 1.5em; }
.prose h4 { font-size: 1.25em; }
</style>
@endsection