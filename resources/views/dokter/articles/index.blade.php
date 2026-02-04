@extends('layouts.dokter')

@section('title', 'Kelola Artikel')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Artikel</h2>
            <a href="{{ route('articles.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Artikel
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($articles as $article)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-12 h-12 rounded-lg object-cover mr-4">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit(strip_tags($article->content), 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($article->status === 'published')
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Published
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $article->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        <div class="flex space-x-2">
                            @if($article->status === 'draft')
                                <form method="POST" action="{{ route('articles.publish', $article) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:text-green-900" title="Publish">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('articles.destroy', $article) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-newspaper text-4xl mb-4"></i>
                        <p>Belum ada artikel. <a href="{{ route('articles.create') }}" class="text-blue-600 hover:underline">Buat artikel pertama</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection