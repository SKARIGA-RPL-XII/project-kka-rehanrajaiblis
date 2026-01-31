@extends('layouts.app')

@section('title', 'Klinik Kesehatan - Pelayanan Terbaik')

@section('content')

    <section class="bg-gradient-to-br from-blue-50 to-sky-100 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="space-y-8">
                    
                    <div class="flex flex-wrap gap-4 mb-6">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <i class="fas fa-shield-check text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium">Terakreditasi</span>
                        </div>

                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <i class="fas fa-clock text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium">24/7 Darurat</span>
                        </div>

                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <i class="fas fa-star text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium">Rating 4.9/5</span>
                        </div>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Akses kesehatan <span class="text-blue-600">Lebih mudah</span> Perawatan tetap sepenuh hati.
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed">
                        Kami menyediakan konsultasi tanpa harus datang kerumah sakit, dengan dokter berpengalaman sedia untuk membantu anda kapan saja.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button @click="loginModal = true" class="bg-blue-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-blue-700 transition-all transform hover:scale-105 text-center shadow-lg">
                            Buat Janji Temu
                        </button>
                    </div>

                    <div class="flex items-center bg-red-50 p-4 rounded-xl border-l-4 border-red-500">
                        <div class="bg-red-100 p-3 rounded-full mr-4">
                            <i class="fas fa-phone text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Hotline Darurat</p>
                            <p class="text-lg font-bold text-red-600">+62895360591982</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-blue-600 rounded-3xl p-8 transform rotate-3 shadow-2xl">
                        <img src="{{ asset('image/rumah sakit hero.png') }}" alt="Fasilitas Kesehatan Modern" class="rounded-2xl w-full h-96 object-cover transform -rotate-3">
                    </div>
                    
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Janji Temu Online</p>
                                <p class="text-gray-600 text-sm">Mudah & Cepat</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold text-gray-900">
                        Tentang <span class="text-blue-600">Klinik Kami</span>
                    </h2>
                    
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Dengan lebih dari 15 tahun keunggulan dalam pelayanan kesehatan, kami berkomitmen menyediakan layanan medis komprehensif dengan pendekatan yang berpusat pada pasien.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-600"></i>
                            <span class="text-gray-700">Teknologi Medis Canggih</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-600"></i>
                            <span class="text-gray-700">Tim Medis Berpengalaman</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-blue-600"></i>
                            <span class="text-gray-700">Layanan Darurat 24/7</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="{{ asset('assets/img/health/staff-10.webp') }}" alt="Rumah Sakit" class="rounded-2xl shadow-2xl">
                </div>

            </div>
        </div>
    </section>


    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Layanan <span class="text-blue-600">Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami menawarkan layanan kesehatan komprehensif yang dirancang untuk memenuhi semua kebutuhan medis Anda dengan keunggulan dan kasih sayang.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                    <div class="bg-blue-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Konsultasi Umum</h3>
                    <p class="text-gray-600">Layanan perawatan primer komprehensif untuk semua kebutuhan kesehatan umum Anda dengan dokter berpengalaman.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                    <div class="bg-green-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-heartbeat text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Kardiologi</h3>
                    <p class="text-gray-600">Perawatan jantung canggih dengan peralatan mutakhir dan kardiolog spesialis.</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-2">
                    <div class="bg-red-100 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-ambulance text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Layanan Darurat</h3>
                    <p class="text-gray-600">Layanan darurat 24/7 dengan tim respons cepat untuk situasi medis kritis.</p>
                </div>

            </div>
        </div>
    </section>


    <section class="py-20 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-4xl font-bold mb-8">Siap Memulai?</h2>
            <p class="text-xl mb-8 opacity-90">Bergabunglah dengan ribuan pasien yang mempercayai kesehatan mereka kepada kami.</p>
            
            <button @click="loginModal = true" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105 inline-block shadow-lg">
                Buat Janji Sekarang
            </button>
        </div>
    </section>

@endsection