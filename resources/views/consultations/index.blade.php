@extends('layouts.app')

@section('title', 'Konsultasi Saya')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Konsultasi Saya</h1>
                    <p class="text-gray-600">Riwayat konsultasi dengan dokter</p>
                </div>
                <a href="{{ route('consultations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Buat Konsultasi
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($consultations as $consultation)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $consultation->subject }}</h3>
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
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-green-900 mb-2">Balasan Dokter:</h4>
                            <p class="text-green-800">{{ $consultation->reply }}</p>
                            @if($consultation->doctor)
                                <p class="text-xs text-green-600 mt-2">- Dr. {{ $consultation->doctor->name }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <i class="fas fa-comments text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500 mb-4">Belum ada konsultasi</p>
                    <a href="{{ route('consultations.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Buat Konsultasi Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection