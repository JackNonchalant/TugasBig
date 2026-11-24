<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="web_blank" name="shell-type"/>
    <title>Masuk ke Akun - PojokBerbagi</title>

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
            <div class="w-full max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-stretch">
                
                <!-- Left Visual Hero Column -->
                <div class="lg:col-span-6 bg-secondary-container rounded-2xl p-space-lg lg:p-space-xl flex flex-col justify-between relative overflow-hidden shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-secondary-fixed-variant bg-surface-container-lowest/80 px-3 py-1 rounded-full font-semibold">
                            Komunitas Pendidikan
                        </span>
                        <span class="material-symbols-outlined text-primary text-[24px]">auto_stories</span>
                    </div>

                    <div class="my-space-lg flex items-center justify-center">
                        <img class="w-full max-w-sm h-auto rounded-xl object-cover shadow-sm"
                             src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80"
                             alt="Buku dan Perlengkapan Belajar"/>
                    </div>

                    <div class="bg-surface-container-lowest/90 backdrop-blur-sm rounded-xl p-space-md border border-outline-variant/30">
                        <p class="font-body-md text-body-md text-on-surface italic">
                            “Satu buku dan seperangkat alat tulis yang kamu bagikan hari ini dapat membuka jendela masa depan bagi anak-anak di pelosok negeri.”
                        </p>
                        <div class="mt-space-sm flex items-center gap-space-sm">
                            <span class="w-6 h-0.5 bg-primary rounded-full"></span>
                            <span class="font-label-md text-label-md text-on-surface-variant font-medium">Gerakan Berbagi Perlengkapan Pendidikan</span>
                        </div>
                    </div>
                </div>

                <!-- Right Form Card Column -->
                <div class="lg:col-span-6 bg-surface-container-lowest rounded-2xl p-space-lg lg:p-space-xl shadow-md border border-outline-variant/30 flex flex-col justify-center">
                    <div class="flex items-center gap-space-sm mb-space-lg">
                        <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary">
                            <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                        </div>
                        <span class="font-headline-sm text-headline-sm text-primary font-bold">PojokBerbagi</span>
                    </div>

                    <div class="mb-space-lg">
                        <h1 class="font-headline-md text-headline-md text-on-surface mb-space-xs font-bold">
                            Selamat Datang Kembali!
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Masuk untuk melanjutkan kegiatan berbagi dan membantu sesama.
                        </p>
                    </div>

                    <!-- Flash & Validation Error Alerts -->
                    @if ($errors->any())
                        <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 mb-space-md text-sm text-red-800 flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-red-600 text-xl shrink-0 mt-0.5">error</span>
                            <div class="flex-1">
                                <span class="font-semibold block">Gagal masuk:</span>
                                <ul class="list-disc list-inside text-xs mt-1 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form class="flex flex-col gap-space-md" method="POST" action="{{ route('login.post') }}" id="login-form">
                        @csrf

                        <!-- Email Input -->
                        <div class="flex flex-col gap-space-xs">
                            <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="identifier">
                                Email
                            </label>
                            <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg px-3.5 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('email') border-error @enderror"
                                   id="identifier"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   required=""
                                   autofocus=""
                                   type="email"/>
                        </div>

                        <!-- Password Input -->
                        <div class="flex flex-col gap-space-xs">
                            <label class="font-label-lg text-label-lg text-on-surface font-semibold" for="password">
                                Password
                            </label>
                            <div class="relative flex items-center">
                                <input class="w-full bg-surface-container-low text-on-surface placeholder:text-outline font-body-md text-body-md rounded-lg pl-3.5 pr-11 py-2.5 border border-outline-variant/30 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-surface-container transition-colors @error('password') border-error @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Masukkan password Anda"
                                       required=""
                                       type="password"/>
                                <button aria-label="Tampilkan atau sembunyikan password"
                                        class="absolute right-3 text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center cursor-pointer"
                                        id="toggle-password"
                                        type="button">
                                    <span class="material-symbols-outlined text-[20px]" id="eye-icon">visibility</span>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between pt-space-xs">
                            <label class="inline-flex items-center gap-space-sm cursor-pointer select-none">
                                <input class="w-4 h-4 rounded accent-primary cursor-pointer"
                                       type="checkbox"
                                       name="remember"
                                       id="remember"/>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Ingat Saya</span>
                            </label>
                            <span class="font-label-md text-label-md text-on-surface-variant text-xs">
                                Butuh bantuan? Hubungi posko
                            </span>
                        </div>

                        <!-- Submit Button -->
                        <button class="w-full bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg font-semibold rounded-lg py-3 px-4 transition-colors cursor-pointer mt-space-xs shadow-sm flex items-center justify-center gap-2"
                                type="submit">
                            <span class="material-symbols-outlined text-lg">login</span>
                            Masuk
                        </button>

                        <div class="flex items-center gap-space-md my-space-xs">
                            <div class="flex-1 h-px bg-surface-container-high"></div>
                            <span class="font-body-sm text-body-sm text-outline">PojokBerbagi</span>
                            <div class="flex-1 h-px bg-surface-container-high"></div>
                        </div>
                    </form>

                    <p class="mt-space-md text-center font-body-sm text-body-sm text-on-surface-variant">
                        Belum punya akun?
                        <a class="font-label-lg text-label-lg text-primary font-bold hover:underline ml-1" href="{{ route('register') }}">
                            Daftar Sekarang
                        </a>
                    </p>

                    <!-- Testing Helper Credentials -->
                    <div class="mt-space-lg pt-space-md border-t border-outline-variant/20">
                        <p class="text-xs font-semibold text-on-surface-variant mb-2">Akun Pengujian Demo (Seeder):</p>
                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                            <button type="button" onclick="fillLogin('donatur@pojokberbagi.id', 'password123')" class="p-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary font-medium border border-outline-variant/30 transition-colors">
                                <span class="font-bold block text-primary">Donatur</span>
                                <span class="text-[10px] text-on-surface-variant">Klik Isi</span>
                            </button>
                            <button type="button" onclick="fillLogin('penerima@pojokberbagi.id', 'password123')" class="p-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary font-medium border border-outline-variant/30 transition-colors">
                                <span class="font-bold block text-primary">Penerima</span>
                                <span class="text-[10px] text-on-surface-variant">Klik Isi</span>
                            </button>
                            <button type="button" onclick="fillLogin('admin@pojokberbagi.id', 'password123')" class="p-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-primary font-medium border border-outline-variant/30 transition-colors">
                                <span class="font-bold block text-primary">Admin</span>
                                <span class="text-[10px] text-on-surface-variant">Klik Isi</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Password Visibility Toggle & Quick Fill Script -->
    <script>
        (function () {
            const toggleBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (toggleBtn && passwordInput && eyeIcon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
                });
            }
        })();

        function fillLogin(email, password) {
            document.getElementById('identifier').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</body>
</html>
