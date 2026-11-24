<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_blank" name="shell-type"/>
    <title>Daftar Akun Baru - PojokBerbagi</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <style>
        @layer base {
            html, body { margin:0; padding:0; }
            body { overscroll-behavior:none; }
            main > :first-child { margin-top:0 !important; }
            main > :last-child { margin-bottom:0 !important; }
        }
        ::-webkit-scrollbar { display:none; }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-high": "#e5e9e4",
                        "surface-container-lowest": "#ffffff",
                        "background": "#f6faf5",
                        "surface-container-highest": "#dfe4df",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#404944",
                        "tertiary": "#5a3100",
                        "surface-bright": "#f6faf5",
                        "tertiary-fixed": "#ffdcbf",
                        "on-surface": "#181d1a",
                        "on-secondary-container": "#5e6661",
                        "surface-variant": "#dfe4df",
                        "primary-container": "#245c46",
                        "on-primary-fixed": "#002115",
                        "outline": "#707973",
                        "tertiary-container": "#794605",
                        "primary-fixed": "#b5efd2",
                        "error-container": "#ffdad6",
                        "surface": "#f6faf5",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#99d3b7",
                        "surface-container": "#ebefea",
                        "surface-tint": "#316852",
                        "secondary-container": "#dce5de",
                        "primary-fixed-dim": "#99d3b7",
                        "tertiary-fixed-dim": "#ffb872",
                        "inverse-on-surface": "#edf2ed",
                        "outline-variant": "#c0c9c2",
                        "secondary-fixed-dim": "#c0c9c2",
                        "on-secondary-fixed": "#151d19",
                        "on-tertiary-container": "#ffb770",
                        "surface-dim": "#d7dbd6",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#404944",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#dce5de",
                        "on-error": "#ffffff",
                        "on-tertiary-fixed-variant": "#6a3b00",
                        "surface-container-low": "#f0f5f0",
                        "on-primary-fixed-variant": "#16503b",
                        "secondary": "#58605b",
                        "on-primary-container": "#99d2b6",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#2d1600",
                        "primary": "#044430",
                        "on-background": "#181d1a",
                        "inverse-surface": "#2d322e"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter": "1.5rem",
                        "space-xl": "2.5rem",
                        "space-lg": "1.5rem",
                        "margin": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-md": "1rem",
                        "space-sm": "0.5rem"
                    },
                    fontFamily: {
                        "body-md": ["Inter"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Inter"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "title-md": ["Plus Jakarta Sans"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-sm": ["Inter"]
                    },
                    fontSize: {
                        "body-md": ["15px", { lineHeight: "24px", letterSpacing: "0em", fontWeight: "400" }],
                        "headline-sm": ["20px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }],
                        "label-lg": ["14px", { lineHeight: "20px", letterSpacing: "0em", fontWeight: "500" }],
                        "headline-lg-mobile": ["30px", { lineHeight: "38px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "title-md": ["16px", { lineHeight: "24px", letterSpacing: "0em", fontWeight: "600" }],
                        "label-sm": ["11px", { lineHeight: "16px", letterSpacing: "0.04em", fontWeight: "600" }],
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "500" }],
                        "headline-md": ["28px", { lineHeight: "36px", letterSpacing: "-0.015em", fontWeight: "600" }],
                        "body-lg": ["18px", { lineHeight: "28px", letterSpacing: "0em", fontWeight: "400" }],
                        "headline-lg": ["40px", { lineHeight: "48px", letterSpacing: "-0.02em", fontWeight: "700" }],
                        "body-sm": ["13px", { lineHeight: "20px", letterSpacing: "0em", fontWeight: "400" }]
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface min-h-screen flex flex-col">

    <!-- Top Logo Navigation -->
    <div class="w-full max-w-7xl mx-auto px-margin pt-space-lg">
        <a class="inline-flex items-center gap-space-sm font-headline-sm text-headline-sm text-primary hover:text-primary-container transition-colors" href="{{ route('home') }}">
            <span class="material-symbols-outlined text-[24px]">volunteer_activism</span>
            <span class="font-bold tracking-tight">PojokBerbagi</span>
        </a>
    </div>

    <main class="flex-1 w-full flex items-center justify-center px-margin py-space-xl bg-surface">
        <div class="flex flex-col w-full">
            <div class="w-full max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-stretch">
                
                <!-- Left Column: Illustration & Role Info (5 cols) -->
                <div class="lg:col-span-5 bg-secondary-container rounded-2xl p-space-xl flex flex-col justify-between relative overflow-hidden shadow-sm">
                    <div class="relative z-10 flex flex-col gap-space-md">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary bg-surface-container-lowest/80 px-space-md py-space-xs rounded-full self-start font-semibold">
                            Komunitas Berbagi Pendidikan
                        </span>
                        <h2 class="font-headline-sm text-headline-sm text-on-secondary-fixed font-bold leading-snug">
                            Satu Langkah Kecil untuk Masa Depan Pendidikan Indonesia
                        </h2>
                    </div>

                    <div class="my-space-lg flex items-center justify-center relative z-10">
                        <img class="w-full max-w-xs rounded-xl object-cover shadow-sm"
                             src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80"
                             alt="Komunitas Berbagi PojokBerbagi"/>
                    </div>

                    <div class="relative z-10 grid grid-cols-1 gap-space-md">
                        <div class="bg-surface-container-lowest/90 backdrop-blur-sm rounded-xl p-space-md flex items-start gap-space-md border border-outline-variant/30">
                            <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center shrink-0 text-primary">
                                <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-label-lg text-label-lg text-on-surface font-semibold">Peran Donatur</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Salurkan buku, seragam, atau alat tulis layak pakai langsung ke posko transit.</p>
                            </div>
                        </div>

                        <div class="bg-surface-container-lowest/90 backdrop-blur-sm rounded-xl p-space-md flex items-start gap-space-md border border-outline-variant/30">
                            <div class="w-10 h-10 rounded-lg bg-tertiary-fixed flex items-center justify-center shrink-0 text-tertiary">
                                <span class="material-symbols-outlined text-[20px]">school</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-label-lg text-label-lg text-on-surface font-semibold">Peran Penerima</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Ajukan kebutuhan perlengkapan belajar untuk siswa, sekolah, atau taman bacaan secara transparan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Registration Form (7 cols) -->
                <div class="lg:col-span-7 bg-surface-container-lowest rounded-2xl p-space-lg sm:p-space-xl shadow-md border border-outline-variant/30 flex flex-col justify-center">
                    
                    <!-- Form Header: Logo & Title -->
                    <div class="mb-space-lg">
                        <div class="inline-flex items-center gap-space-sm text-primary mb-space-md">
                            <span class="material-symbols-outlined text-[24px]">volunteer_activism</span>
                            <span class="font-headline-sm text-headline-sm font-bold">PojokBerbagi</span>
                        </div>
                        <h1 class="font-headline-md text-headline-md text-on-surface mb-space-xs font-bold">
                            Buat Akun Baru
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Bergabunglah dan mulai berbagi kebaikan bersama PojokBerbagi.
                        </p>
                    </div>

                    <!-- Flash & Validation Errors -->
                    @if ($errors->any())
                        <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 mb-space-md text-sm text-red-800 flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-red-600 text-xl shrink-0 mt-0.5">error</span>
                            <div class="flex-1">
                                <span class="font-semibold block">Mohon periksa data pendaftaran:</span>
                                <ul class="list-disc list-inside text-xs mt-1 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form class="flex flex-col gap-space-md" method="POST" action="{{ route('register.post') }}" id="registerForm">
                        @csrf

                        <!-- Account Type / Role Selection -->
                        <div class="flex flex-col gap-space-sm">
                            <label class="font-label-lg text-label-lg text-on-surface font-semibold">Pilih Jenis Akun</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                                
                                <!-- Donatur Card Option -->
                                <label class="role-card cursor-pointer relative rounded-xl p-space-md bg-primary-fixed/40 transition-all flex items-start gap-space-md border border-primary/30" data-role="donor">
                                    <input type="radio" name="role" value="donor" class="sr-only" {{ old('role', 'donor') === 'donor' ? 'checked' : '' }} required/>
                                    <div class="w-9 h-9 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0 mt-0.5">
                                        <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-space-xs">
                                            <span class="font-title-md text-title-md text-on-surface font-semibold">Donatur</span>
                                            <span class="role-check material-symbols-outlined text-[18px] text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Ingin menyalurkan barang</p>
                                    </div>
                                </label>

                                <!-- Penerima Card Option -->
                                <label class="role-card cursor-pointer relative rounded-xl p-space-md bg-surface-container-low hover:bg-surface-container transition-all flex items-start gap-space-md border border-outline-variant/30" data-role="beneficiary">
                                    <input type="radio" name="role" value="beneficiary" class="sr-only" {{ old('role') === 'beneficiary' ? 'checked' : '' }} required/>
                                    <div class="w-9 h-9 rounded-lg bg-surface-container-high text-on-surface-variant flex items-center justify-center shrink-0 mt-0.5">
                                        <span class="material-symbols-outlined text-[20px]">menu_book</span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-space-xs">
                                            <span class="font-title-md text-title-md text-on-surface font-semibold">Penerima</span>
                                            <span class="role-check material-symbols-outlined text-[18px] text-outline opacity-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Membutuhkan bantuan pendidikan</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="flex flex-col gap-space-xs">
                            <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="fullName">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined text-[20px] text-outline absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">person</span>
                                <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-10 pr-4 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('name') border-error @enderror"
                                       id="fullName"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama lengkap Anda"
                                       required=""
                                       type="text"/>
                            </div>
                        </div>

                        <!-- Email & Nomor Telepon (2 columns on desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                            <div class="flex flex-col gap-space-xs">
                                <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="email">Email</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined text-[20px] text-outline absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">mail</span>
                                    <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-10 pr-4 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('email') border-error @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="nama@email.com"
                                           required=""
                                           type="email"/>
                                </div>
                            </div>
                            <div class="flex flex-col gap-space-xs">
                                <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="phone">Nomor Telepon</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined text-[20px] text-outline absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">call</span>
                                    <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-10 pr-4 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="0812 3456 7890"
                                           type="tel"/>
                                </div>
                            </div>
                        </div>

                        <!-- Password & Konfirmasi Password (2 columns on desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                            <div class="flex flex-col gap-space-xs">
                                <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="password">Password</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined text-[20px] text-outline absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">lock</span>
                                    <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-10 pr-10 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('password') border-error @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Minimal 8 karakter"
                                           required=""
                                           type="password"/>
                                    <button aria-label="Lihat atau sembunyikan password"
                                            class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors cursor-pointer"
                                            data-target="password"
                                            type="button">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-col gap-space-xs">
                                <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="confirmPassword">Konfirmasi Password</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined text-[20px] text-outline absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none">lock_reset</span>
                                    <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-10 pr-10 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('password_confirmation') border-error @enderror"
                                           id="confirmPassword"
                                           name="password_confirmation"
                                           placeholder="Ulangi password"
                                           required=""
                                           type="password"/>
                                    <button aria-label="Lihat atau sembunyikan konfirmasi password"
                                            class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors cursor-pointer"
                                            data-target="confirmPassword"
                                            type="button">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions Checkbox -->
                        <label class="flex items-start gap-space-sm cursor-pointer mt-space-xs select-none">
                            <input class="mt-1 w-4 h-4 accent-primary rounded cursor-pointer shrink-0"
                                   id="terms"
                                   required=""
                                   type="checkbox"/>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">
                                Saya menyetujui <span class="text-primary font-semibold">Syarat &amp; Ketentuan</span> serta <span class="text-primary font-semibold">Kebijakan Privasi</span> PojokBerbagi.
                            </span>
                        </label>

                        <!-- Submit Button -->
                        <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg font-semibold py-3 px-space-lg rounded-lg transition-colors flex items-center justify-center gap-space-sm mt-space-xs shadow-sm cursor-pointer"
                                type="submit">
                            <span>Daftar Sekarang</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </form>

                    <!-- Bottom Login Link -->
                    <div class="mt-space-lg text-center pt-space-md border-t border-outline-variant/20">
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Sudah punya akun? 
                            <a class="font-label-lg text-label-lg text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">
                                Masuk
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Client-Side Scripts for Role Cards & Password Toggles -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Role card selection
            const roleCards = document.querySelectorAll('.role-card');
            roleCards.forEach(card => {
                card.addEventListener('click', () => {
                    roleCards.forEach(c => {
                        c.classList.remove('bg-primary-fixed/40', 'border-primary/30');
                        c.classList.add('bg-surface-container-low', 'hover:bg-surface-container', 'border-outline-variant/30');
                        const check = c.querySelector('.role-check');
                        if (check) {
                            check.classList.add('opacity-0');
                            check.classList.remove('text-primary');
                            check.classList.add('text-outline');
                        }
                        const radio = c.querySelector('input[type="radio"]');
                        if (radio) radio.checked = false;
                    });

                    card.classList.remove('bg-surface-container-low', 'hover:bg-surface-container', 'border-outline-variant/30');
                    card.classList.add('bg-primary-fixed/40', 'border-primary/30');
                    const activeCheck = card.querySelector('.role-check');
                    if (activeCheck) {
                        activeCheck.classList.remove('opacity-0', 'text-outline');
                        activeCheck.classList.add('text-primary');
                    }
                    const activeRadio = card.querySelector('input[type="radio"]');
                    if (activeRadio) activeRadio.checked = true;
                });
            });

            // Password visibility toggle
            const toggleButtons = document.querySelectorAll('.toggle-password');
            toggleButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const targetId = btn.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = btn.querySelector('.material-symbols-outlined');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.textContent = 'visibility_off';
                    } else {
                        input.type = 'password';
                        icon.textContent = 'visibility';
                    }
                });
            });
        });
    </script>
</body>
</html>
