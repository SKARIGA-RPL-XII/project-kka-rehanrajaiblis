@extends('layouts.app')

@section('title', 'Blog Kesehatan')

@section('content')
<div class="pt-20 pb-16">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog Kesehatan</h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">Artikel kesehatan terpercaya dari dokter profesional untuk menjaga kesehatan Anda dan keluarga</p>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-blue-400"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-user-md mr-1"></i>{{ $article->user->name }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $article->created_at->format('d M Y') }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-clock mr-2"></i>
                            {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min baca
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        
                        <a href="{{ route('blog.show', $article->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-newspaper text-6xl text-gray-300 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Artikel</h3>
                    <p class="text-gray-600 mb-8">Artikel kesehatan akan segera hadir. Silakan kembali lagi nanti untuk membaca artikel terbaru dari dokter kami.</p>
                    <a href="{{ url('/') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
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

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection