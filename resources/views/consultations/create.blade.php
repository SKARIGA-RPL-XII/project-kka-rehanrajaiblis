@extends('layouts.app')

@section('title', 'Buat Konsultasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Buat Konsultasi Baru</h1>
                <p class="text-gray-600">Sampaikan keluhan Anda kepada dokter</p>
            </div>

            <form method="POST" action="{{ route('consultations.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           value="{{ old('subject') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan subjek konsultasi"
                           required>
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="complaint" class="block text-sm font-medium text-gray-700 mb-2">Keluhan</label>
                    <textarea id="complaint" 
                              name="complaint" 
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Jelaskan keluhan Anda secara detail"
                              required>{{ old('complaint') }}</textarea>
                    @error('complaint')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">Lampiran (Opsional)</label>
                    <input type="file" 
                           id="attachment" 
                           name="attachment"
                           accept=".jpg,.jpeg,.png,.pdf"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, PDF. Maksimal 2MB</p>
                    @error('attachment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('consultations.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Konsultasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection