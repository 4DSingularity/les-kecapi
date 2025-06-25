<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- [TAMBAHKAN INI] CSS Sederhana untuk Sidebar -->
        <style>
            .admin-wrapper {
                display: flex;
            }
            .sidebar {
                width: 250px;
                min-height: calc(100vh - 65px); /* Tinggi layar dikurangi tinggi header */
                background-color: #fff;
                border-right: 1px solid #e5e7eb;
            }
            .sidebar-content {
                padding: 1rem;
            }
            .sidebar-content h4 {
                font-size: 1.1rem;
                font-weight: 600;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid #e5e7eb;
                margin-bottom: 1rem;
            }
            .sidebar-content .nav-link {
                display: block;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                text-decoration: none;
                color: #374151;
                margin-bottom: 0.25rem;
            }
            .sidebar-content .nav-link:hover {
                background-color: #f3f4f6;
            }
            .sidebar-content .nav-link.active {
                background-color: #3b82f6;
                color: white;
            }
            .main-content {
                flex-grow: 1; /* Konten akan mengisi sisa ruang */
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- [EDIT DARI SINI] Bungkus Konten dengan div.admin-wrapper -->
            <div class="admin-wrapper">

                <!-- ========== START SIDEBAR ========== -->
                <aside class="sidebar">
                    <div class="sidebar-content">
                        <h4>Menu Utama</h4>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}" href="{{ route('admin.kelas.index') }}">
                                    Kelola Kelas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" href="{{ route('admin.siswa.index') }}">
                                    Kelola Siswa
                                </a>
                            </li>
                            <hr class="my-2">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.pertemuan.*') || request()->routeIs('admin.absensi.*') ? 'active' : '' }}" href="{{ route('admin.pertemuan.create') }}">
                                    Mulai Pertemuan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
                                    Laporan & Tagihan
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
                <!-- ========== END SIDEBAR ========== -->

                <!-- Bungkus konten utama -->
                <div class="main-content">
                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
                
            </div>
            <!-- [EDIT SAMPAI SINI] -->
        </div>
    </body>
</html>