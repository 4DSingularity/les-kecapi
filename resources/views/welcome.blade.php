<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Les Musik Tradisional</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=lora:700|poppins:400,500" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Poppins', sans-serif; }
            h1, h2, h3, .font-serif { font-family: 'Lora', serif; }
        </style>
    </head>
    <body class="antialiased bg-krem text-coklat-muda">
        
        <!-- Header & Navigasi -->
        <header class="bg-krem/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
            {{-- ... Kode header tidak berubah ... --}}
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold font-serif text-coklat-tua">Les Kecapi</a>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="hover:text-terakota transition-colors">Beranda</a>
                    <a href="#kelas" class="hover:text-terakota transition-colors">Daftar Kelas</a>
                    <a href="#tentang" class="hover:text-terakota transition-colors">Tentang Kami</a>
                </div>
                <div class="hidden md:flex items-center">
                    <a href="https://wa.me/6283808124863?text=Halo, saya tertarik untuk mendaftar les kecapi." target="_blank" class="bg-terakota text-white px-5 py-2 rounded-lg hover:bg-terakota-hover transition-colors">
                        Hubungi Kami
                    </a>
                    <a href="{{ route('login') }}" class="ml-4 text-sm text-coklat-muda hover:text-terakota transition-colors">
                        Login Guru
                    </a>
                </div>
                <div class="md:hidden">
                    <button>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="relative bg-krem py-20 md:py-24 overflow-hidden">
                {{-- ... Kode Hero Section tidak berubah ... --}}
                <div class="container mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
                    <div class="text-center md:text-left z-10">
                        <h1 class="text-4xl md:text-6xl font-bold text-coklat-tua mb-4 leading-tight">Belajar Memainkan Kecapi</h1>
                        <p class="text-lg md:text-xl text-coklat-muda mb-8 max-w-lg mx-auto md:mx-0">Jelajahi keindahan musik tradisional Sunda bersama kami. Materi lengkap dan mudah diikuti untuk semua tingkatan.</p>
                        <a href="https://wa.me/6283808124863?text=Halo, saya tertarik untuk mendaftar les kecapi." target="_blank" class="inline-block bg-terakota text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-terakota-hover transition-transform transform hover:scale-105">
                        Daftar Sekarang
                        </a>
                    </div>
                    <div class="relative w-full max-w-lg mx-auto h-80 md:h-96 mt-12 md:mt-0">
                        <div class="absolute inset-0 bg-[#EADBC8] rounded-full transform scale-110 blur-xl opacity-75"></div>
                        <div class="absolute inset-0" style="clip-path: ellipse(50% 40% at 50% 50%);">
                            <img src="{{ asset('images/kecapi.jpg') }}" alt="Foto kecapi" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Bagian "Kelas Unggulan" -->
            <section id="kelas" class="py-20">
                {{-- ... Kode Kelas Unggulan tidak berubah ... --}}
                <div class="container mx-auto px-6">
                    <h2 class="text-3xl font-bold text-center text-coklat-tua mb-12">Kelas yang Tersedia</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @forelse($kelasUnggulan as $kelas)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2 text-coklat-tua">{{ $kelas->nama_kelas }}</h3>
                                    <p class="text-sm text-terakota mb-4 font-semibold">Rp {{ number_format($kelas->biaya_per_pertemuan) }} / pertemuan</p>
                                    <p class="text-coklat-muda mb-6">{{ Str::limit($kelas->deskripsi, 100) }}</p>
                                    <a href="https://wa.me/6283808124863?text=Halo, saya tertarik untuk mendaftar kelas {{ urlencode($kelas->nama_kelas) }}" class="font-bold text-terakota hover:underline"> Daftar Kelas ini</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center col-span-3 text-coklat-muda">Kelas baru akan segera diumumkan.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="tentang" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="grid md:grid-cols-2 gap-12 items-center align-middle">
                        <div class="text-center md:text-left">
                            <h2 class="text-3xl font-bold text-coklat-tua mb-4">Tentang Kami</h2>
                            <p class="text-coklat-muda mb-4 leading-relaxed">
                               Website ini bertujuan untuk mempermudah proses pendaftaran
                               les kecapi bagi siapa saja yang ingin 
                               belajar dan mengenal lebih dalam seni musik tradisional Sunda.                           
                            </p>                           
                        </div>
                    </div>
                </div>
            </section>
            
        </main>
        
        <!-- Footer -->
        <footer class="bg-coklat-tua text-krem py-12 mt-16">
            {{-- ... Kode Footer tidak berubah ... --}}
            <div class="container mx-auto px-6 text-center">
                <p>© {{ date('Y') }} Semua Hak Cipta Dilindungi.</p>
                <a href="{{ route('login') }}" class="mt-4 inline-block text-sm text-krem/70 hover:text-krem">Admin Area</a>
            </div>
        </footer>
    </body>
</html>