<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-hospital text-2xl text-blue-300"></i>
                    <h1 class="text-xl font-bold">Rumah Sakit</h1>
                </div>
            </div>
            
            <nav class="mt-8">
                <a href="#" class="flex items-center px-6 py-3 bg-blue-700 border-r-4 border-blue-300">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('pasien.index') }}" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-users mr-3"></i>
                    Pasien
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-user-md mr-3"></i>
                    Dokter
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Jadwal
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition-colors">
                    <i class="fas fa-pills mr-3"></i>
                    Obat
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-500 text-xl cursor-pointer hover:text-blue-600"></i>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff" class="w-8 h-8 rounded-full">
                            <span class="text-gray-700">Admin</span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Total Pasien</p>
                                <p class="text-3xl font-bold text-gray-800">1,234</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Jumlah Dokter</p>
                                <p class="text-3xl font-bold text-gray-800">45</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-user-md text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Janji Hari Ini</p>
                                <p class="text-3xl font-bold text-gray-800">89</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Darurat</p>
                                <p class="text-3xl font-bold text-gray-800">12</p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <i class="fas fa-ambulance text-red-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Tables -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Patients -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pasien Terbaru</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">John Doe</p>
                                    <p class="text-sm text-gray-600">Pemeriksaan Umum</p>
                                </div>
                                <span class="text-sm text-gray-500">10:30</span>
                            </div>
                            <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg">
                                <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Jane Smith</p>
                                    <p class="text-sm text-gray-600">Konsultasi Jantung</p>
                                </div>
                                <span class="text-sm text-gray-500">11:15</span>
                            </div>
                            <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg">
                                <img src="https://ui-avatars.com/api/?name=Ahmad+Ali&background=random" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">Ahmad Ali</p>
                                    <p class="text-sm text-gray-600">Cek Lab</p>
                                </div>
                                <span class="text-sm text-gray-500">12:00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <button class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-user-plus text-blue-600 text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-blue-800">Daftar Pasien</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                <i class="fas fa-calendar-plus text-green-600 text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-green-800">Buat Janji</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                                <i class="fas fa-prescription-bottle text-yellow-600 text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-yellow-800">Resep Obat</span>
                            </button>
                            <button class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <i class="fas fa-chart-bar text-purple-600 text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-purple-800">Laporan</span>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>