@extends('layouts.app')

@section('title', 'Konsultasi Dokter')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Konsultasi Pasien</h1>
            <p class="text-gray-600">Kelola konsultasi dari pasien</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6">
            @forelse($consultations as $consultation)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $consultation->subject }}</h3>
                            <p class="text-sm text-gray-600">Dari: {{ $consultation->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $consultation->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($consultation->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($consultation->status == 'answered') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($consultation->status) }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">Keluhan:</h4>
                        <p class="text-gray-700">{{ $consultation->complaint }}</p>
                    </div>

                    @if($consultation->reply)
                        <div class="bg-blue-50 p-4 rounded-lg mb-4">
                            <h4 class="font-medium text-blue-900 mb-2">Balasan Anda:</h4>
                            <p class="text-blue-800">{{ $consultation->reply }}</p>
                        </div>
                    @endif

                    @if($consultation->status == 'pending')
                        <form method="POST" action="{{ route('consultations.reply', $consultation) }}" class="mt-4">
                            @csrf
                            <textarea name="reply" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis balasan Anda..." required></textarea>
                            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                <i class="fas fa-reply mr-2"></i>Balas
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <i class="fas fa-comments text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">Belum ada konsultasi</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection