<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klinik Kesehatan')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50" x-data="{ loginModal: false, registerModal: false }">
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-white shadow-sm">
    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-700">
                        <i class="fas fa-heartbeat mr-2"></i>Klinik
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium">Tentang</a>
                    <a href="#services" class="text-gray-700 hover:text-blue-600 font-medium">Layanan</a>
                    <a href="#doctors" class="text-gray-700 hover:text-blue-600 font-medium">Dokter</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium">Kontak</a>
                    
                    @auth
                        <div class="flex items-center" x-data="{ userDropdown: false, notificationDropdown: false }">
                            
                            @if(auth()->user()->role === 'doktor')
                                <div class="relative mr-4" x-data="{ notifications: [], unreadCount: 0 }" x-init="
                                    fetch('/notifications')
                                        .then(response => response.json())
                                        .then(data => {
                                            notifications = data;
                                            unreadCount = data.length;
                                        });
                                ">
                                    <button @click="notificationDropdown = !notificationDropdown" class="relative p-2 text-gray-700 hover:text-blue-600 focus:outline-none">
                                        <i class="fas fa-bell text-xl"></i>
                                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                                    </button>
                                    
                                    <div x-show="notificationDropdown" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         @click.away="notificationDropdown = false"
                                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50"
                                         style="display: none;">
                                        <div class="px-4 py-2 border-b">
                                            <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                        </div>
                                        <div class="max-h-64 overflow-y-auto">
                                            <template x-for="notification in notifications" :key="notification.id">
                                                <div class="px-4 py-3 hover:bg-gray-50 border-b cursor-pointer" 
                                                     @click="
                                                        fetch(`/notifications/${notification.id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
                                                        window.location.href = `/consultations/${notification.data.consultation_id}`;
                                                     ">
                                                    <p class="text-sm font-medium text-gray-900" x-text="notification.data.message"></p>
                                                    <p class="text-xs text-gray-500" x-text="notification.data.subject"></p>
                                                </div>
                                            </template>
                                            <div x-show="notifications.length === 0" class="px-4 py-3 text-center text-gray-500">
                                                Tidak ada notifikasi baru
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="relative">
                                <button @click="userDropdown = !userDropdown" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 focus:outline-none">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="w-8 h-8 rounded-full">
                                    <span class="font-medium">{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </button>
                                
                                <div x-show="userDropdown" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     @click.away="userDropdown = false"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                                     style="display: none;">
                                    <div class="px-4 py-2 border-b">
                                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mt-1
                                            @if(auth()->user()->role == 'admin') bg-red-100 text-red-800
                                            @elseif(auth()->user()->role == 'doktor') bg-green-100 text-green-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst(auth()->user()->role) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i>Profil Saya
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('pasien.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-users mr-2"></i>Kelola User
                                        </a>
                                    @elseif(auth()->user()->role == 'doktor')
                                        <a href="{{ route('consultations.doctor') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-stethoscope mr-2"></i>Konsultasi
                                        </a>
                                    @elseif(auth()->user()->role == 'pasien')
                                        <a href="{{ route('consultations.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-comments mr-2"></i>Konsultasi Saya
                                        </a>
                                        <a href="{{ route('consultations.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-plus mr-2"></i>Buat Konsultasi
                                        </a>
                                    @endif
                                    <div class="border-t mt-2 pt-2">
                                        <form method="POST" action="{{ route('logout') }}" class="block">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    @else
                        <button @click="loginModal = true" class="text-blue-600 hover:text-blue-800 px-4 py-2 rounded-lg border border-blue-600 hover:bg-blue-50 transition-colors">
                            Login
                        </button>
                        <button @click="registerModal = true" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Register
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

    <!-- Login Modal -->
    <div x-show="loginModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="loginModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="loginModal = false"></div>
            
            <div x-show="loginModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Login</h3>
                    <button @click="loginModal = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                        Login
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <button @click="loginModal = false; registerModal = true" class="text-blue-600 hover:text-blue-800 font-medium">
                            Daftar sekarang
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div x-show="registerModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="registerModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="registerModal = false"></div>
            
            <div x-show="registerModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Register</h3>
                    <button @click="registerModal = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Pilih Role</option>
                            <option value="pasien" {{ old('role') == 'pasien' ? 'selected' : '' }}>Pasien</option>
                            <option value="doktor" {{ old('role') == 'doktor' ? 'selected' : '' }}>Doktor</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                        Register
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <button @click="registerModal = false; loginModal = true" class="text-blue-600 hover:text-blue-800 font-medium">
                            Login sekarang
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="pt-24">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-4">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-heartbeat text-blue-400 text-2xl mr-3"></i>
                        <h3 class="text-xl font-bold">Klinik</h3>
                    </div>
                    <p class="text-gray-400">Memberikan pelayanan kesehatan terbaik dengan teknologi modern dan tenaga medis berpengalaman.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-blue-400">Layanan</h4>
                    <div class="space-y-2 text-gray-400">
                        <p>Konsultasi Umum</p>
                        <p>Pemeriksaan Kesehatan</p>
                        <p>Layanan Darurat</p>
                        <p>Rawat Jalan</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-blue-400">Jam Operasional</h4>
                    <div class="space-y-2 text-gray-400">
                        <p>Senin - Jumat: 08:00 - 20:00</p>
                        <p>Sabtu: 08:00 - 16:00</p>
                        <p>Minggu: 08:00 - 12:00</p>
                        <p class="text-red-400">Darurat: 24/7</p>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4 text-blue-400">Kontak</h4>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fas fa-phone mr-2"></i> +62 21 5589 55488</p>
                        <p><i class="fas fa-envelope mr-2"></i> contact@klinik.com</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Klinik. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if($errors->has('email') && !$errors->has('name'))
                    // Login errors
                    document.querySelector('[x-data]').__x.$data.loginModal = true;
                @elseif($errors->has('name') || $errors->has('role'))
                    // Register errors
                    document.querySelector('[x-data]').__x.$data.registerModal = true;
                @endif
            });
        </script>
    @endif
</body>
</html>