<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Simple Header -->
    <div class="flex justify-between items-center p-6">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-sm">RS</span>
            </div>
            <span class="font-semibold text-slate-800">Rumah Sakit</span>
        </div>
        @auth
            <a href="{{ url('/dashboard') }}" class="text-emerald-600 hover:text-emerald-700">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-emerald-600 hover:text-emerald-700">Masuk</a>
        @endauth
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-6 py-20">
        <!-- Hero -->
        <div class="text-center mb-20">
            <h1 class="text-6xl font-light text-slate-800 mb-6 leading-tight">
                Kesehatan<br>
                <span class="text-emerald-500 font-medium">Adalah Prioritas</span>
            </h1>
            <p class="text-xl text-slate-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Kami hadir untuk memberikan pelayanan kesehatan terbaik dengan pendekatan yang personal dan teknologi modern.
            </p>
            <a href="{{ route('login') }}" class="inline-block bg-emerald-500 text-white px-8 py-3 rounded-full hover:bg-emerald-600 transition-colors">
                Mulai Sekarang
            </a>
        </div>

        <!-- Simple Stats -->
        <div class="grid grid-cols-3 gap-8 mb-20 text-center">
            <div>
                <div class="text-3xl font-bold text-emerald-500 mb-2">1000+</div>
                <div class="text-slate-600">Pasien</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-emerald-500 mb-2">50+</div>
                <div class="text-slate-600">Dokter</div>
            </div>
            <div>
                <div class="text-3xl font-bold text-emerald-500 mb-2">24/7</div>
                <div class="text-slate-600">Siaga</div>
            </div>
        </div>

        <!-- Services -->
        <div class="mb-20">
            <h2 class="text-3xl font-light text-center text-slate-800 mb-12">Layanan Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-emerald-600 text-xl">👨‍⚕️</span>
                    </div>
                    <h3 class="font-medium text-slate-800 mb-2">Konsultasi</h3>
                    <p class="text-slate-600 text-sm">Konsultasi dengan dokter ahli</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-emerald-600 text-xl">🏥</span>
                    </div>
                    <h3 class="font-medium text-slate-800 mb-2">Rawat Inap</h3>
                    <p class="text-slate-600 text-sm">Fasilitas rawat inap terbaik</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-emerald-600 text-xl">🚑</span>
                    </div>
                    <h3 class="font-medium text-slate-800 mb-2">Darurat</h3>
                    <p class="text-slate-600 text-sm">Layanan darurat 24 jam</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center bg-emerald-50 rounded-2xl p-12">
            <h2 class="text-2xl font-light text-slate-800 mb-4">Siap Memulai?</h2>
            <p class="text-slate-600 mb-6">Bergabunglah dengan ribuan pasien yang mempercayai kami</p>
            <a href="{{ route('login') }}" class="inline-block bg-emerald-500 text-white px-6 py-2 rounded-full hover:bg-emerald-600 transition-colors">
                Daftar Sekarang
            </a>
        </div>
    </div>

    <!-- Simple Footer -->
    <div class="text-center py-8 text-slate-500 text-sm border-t">
        <p>&copy; 2024 Rumah Sakit. Melayani dengan hati.</p>
    </div>
</body>
</html>