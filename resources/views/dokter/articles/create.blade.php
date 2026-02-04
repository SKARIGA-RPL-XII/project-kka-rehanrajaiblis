@extends('layouts.dokter')

@section('title', 'Tambah Artikel')
@section('page-title', 'Tambah Artikel')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">Buat Artikel Baru</h2>
    </div>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror" 
                           placeholder="Masukkan judul artikel..." required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                    <textarea id="content" name="content" rows="15" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror" 
                              placeholder="Tulis konten artikel di sini..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" 
                               class="hidden @error('thumbnail') border-red-500 @enderror" 
                               onchange="previewImage(this)">
                        <div id="thumbnail-preview" class="hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-32 object-cover rounded-lg mb-2">
                            <button type="button" onclick="removeImage()" class="text-red-600 text-sm hover:underline">Hapus</button>
                        </div>
                        <div id="thumbnail-placeholder">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600">Klik untuk upload thumbnail</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                        <label for="thumbnail" class="cursor-pointer absolute inset-0"></label>
                    </div>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('articles.index') }}" class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('thumbnail-preview').classList.remove('hidden');
            document.getElementById('thumbnail-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('thumbnail').value = '';
    document.getElementById('thumbnail-preview').classList.add('hidden');
    document.getElementById('thumbnail-placeholder').classList.remove('hidden');
}
</script>
@endsection