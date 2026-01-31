@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex items-center space-x-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b82f6&color=fff&size=100" 
                     alt="{{ $user->name }}" 
                     class="w-24 h-24 rounded-full">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full mt-2
                        @if($user->role == 'admin') bg-red-100 text-red-800
                        @elseif($user->role == 'doktor') bg-green-100 text-green-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pribadi</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <p class="mt-1 text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 text-gray-900">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Akun</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                        <p class="mt-1 text-gray-900">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Diperbarui</label>
                        <p class="mt-1 text-gray-900">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Akun</label>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-edit text-blue-600 text-xl mr-3"></i>
                    <span class="font-medium text-blue-800">Edit Profil</span>
                </a>
                <a href="{{ route('dashboard') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <i class="fas fa-tachometer-alt text-green-600 text-xl mr-3"></i>
                    <span class="font-medium text-green-800">Dashboard</span>
                </a>
                @if($user->role == 'admin')
                    <a href="{{ route('pasien.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <i class="fas fa-users text-purple-600 text-xl mr-3"></i>
                        <span class="font-medium text-purple-800">Kelola User</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection