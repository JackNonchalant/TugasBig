{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6 border-b border-stone-200 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Manajemen Akun
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">
                Daftar akun <em class="text-ochre">pengguna.</em>
            </h1>
            <p class="text-sm text-warm mt-1.5">Kelola seluruh akun donatur dan penerima manfaat terdaftar di PojokBerbagi.</p>
        </div>
        <div class="flex items-center gap-2 text-xs">
            <span class="px-3.5 py-2 rounded-xl bg-white border border-stone-200 font-semibold text-warm">
                Total: <strong class="text-ink">{{ $users->total() }}</strong> Pengguna
            </span>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <form method="GET" action="{{ route('admin.users.index') }}"
          class="bg-white rounded-2xl border border-stone-200 p-4 sm:p-5">
        <div class="flex flex-col md:flex-row md:items-end gap-3">
            {{-- Search --}}
            <div class="flex-1">
                <label for="search" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">Cari Pengguna</label>
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama atau email..."
                           class="w-full pl-10 pr-4 py-2.5 bg-paper border border-stone-200 rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest placeholder:text-stone-400 transition-all">
                </div>
            </div>

            {{-- Filter: Role --}}
            <div class="w-full md:w-44">
                <label for="role" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">Peran</label>
                <select id="role" name="role"
                        class="w-full py-2.5 px-3 bg-paper border border-stone-200 rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all">
                    <option value="">Semua Peran</option>
                    <option value="donor" {{ request('role') == 'donor' ? 'selected' : '' }}>Donatur</option>
                    <option value="beneficiary" {{ request('role') == 'beneficiary' ? 'selected' : '' }}>Penerima</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Filter: Status --}}
            <div class="w-full md:w-44">
                <label for="status" class="block text-[11px] font-semibold text-warm uppercase tracking-[.14em] mb-1.5">Status Akun</label>
                <select id="status" name="status"
                        class="w-full py-2.5 px-3 bg-paper border border-stone-200 rounded-xl text-sm text-ink focus:bg-white focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest transition-all">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-forest hover:bg-forest-soft text-paper text-sm font-semibold rounded-xl transition duration-300 active:scale-95 cursor-pointer">
                    Filter
                </button>
                @if (request()->hasAny(['search', 'role', 'status']))
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center gap-1 px-4 py-2.5 text-sm font-medium text-warm bg-paper border border-stone-200 hover:bg-cream rounded-xl transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    {{-- Users Table --}}
    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
        @if ($users->isEmpty())
            <div class="p-14 text-center">
                <p class="font-display text-2xl text-ink">Tidak ada pengguna ditemukan.</p>
                <p class="text-xs text-warm mt-1">Coba ubah kata kunci pencarian atau reset filter di atas.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-warm">
                    <thead class="bg-paper text-warm uppercase text-[11px] font-semibold tracking-[.12em] border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">No. Telepon</th>
                            <th class="px-6 py-4">Peran</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-200/80">
                        @foreach ($users as $user)
                            <tr class="hover:bg-paper/70 transition-colors">
                                {{-- Nama + Email --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold text-paper shrink-0
                                            {{ $user->role === 'admin' ? 'bg-ochre' : ($user->role === 'donor' ? 'bg-forest' : 'bg-stone-700') }}">
                                            {{ strtoupper(substr($user->name ?? $user->nama_lengkap ?? '?', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-ink truncate">{{ $user->name ?? $user->nama_lengkap ?? '-' }}</div>
                                            <div class="text-xs text-stone-400 truncate">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Telepon --}}
                                <td class="px-6 py-4 text-sm text-warm">{{ $user->no_telepon ?? '-' }}</td>

                                {{-- Role Badge --}}
                                <td class="px-6 py-4">
                                    @if ($user->role === 'donor')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                            Donatur
                                        </span>
                                    @elseif ($user->role === 'beneficiary')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-cream text-ochre border border-stone-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ochre"></span>
                                            Penerima
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-stone-100 text-ink border border-stone-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ink"></span>
                                            Admin
                                        </span>
                                    @endif
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    @if ($user->status_akun === 'aktif')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-forest border border-forest/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-forest"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                            Suspended
                                        </span>
                                    @endif
                                </td>

                                {{-- Tanggal Daftar --}}
                                <td class="px-6 py-4 text-xs text-stone-400">
                                    {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($user->role !== 'admin')
                                        @if ($user->status_akun === 'aktif')
                                            <button type="button"
                                                    onclick="openSuspendModal({{ $user->id ?? $user->user_id }}, '{{ e($user->name ?? $user->nama_lengkap) }}')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-800 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors cursor-pointer active:scale-95">
                                                Suspend
                                            </button>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.activate', $user->id ?? $user->user_id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-forest bg-cream hover:bg-stone-200/80 border border-stone-200 rounded-lg transition-colors cursor-pointer active:scale-95">
                                                    Aktifkan Kembali
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-xs text-stone-400 italic">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="p-4 border-t border-stone-200">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

{{-- ========== SUSPEND CONFIRMATION MODAL ========== --}}
<div id="suspend-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-ink/40 backdrop-blur-xs" onclick="closeSuspendModal()"></div>

    <div class="relative bg-paper rounded-2xl border border-stone-200 shadow-[0_20px_50px_-15px_rgba(28,25,23,0.3)] w-full max-w-md mx-4 overflow-hidden">
        <div class="px-6 pt-6 pb-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-red-50 border border-red-200 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-display text-2xl text-ink leading-tight">Konfirmasi Suspend</h3>
                    <p class="text-xs text-warm">Tindakan ini menonaktifkan akses akun</p>
                </div>
            </div>
            <p class="text-sm text-warm leading-relaxed">
                Anda yakin ingin menonaktifkan akun <strong id="suspend-user-name" class="text-ink"></strong>?
                Pengguna tidak akan bisa masuk atau melakukan transaksi hingga diaktifkan kembali.
            </p>
        </div>

        <div class="px-6 py-4 bg-white border-t border-stone-200 flex justify-end gap-3">
            <button type="button" onclick="closeSuspendModal()"
                    class="px-4 py-2 text-sm font-medium text-warm bg-paper border border-stone-200 hover:bg-cream rounded-xl transition-colors cursor-pointer">
                Batal
            </button>
            <form id="suspend-form" method="POST" action="">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-red-700 hover:bg-red-800 rounded-xl transition-colors cursor-pointer active:scale-95">
                    Ya, Suspend Akun
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openSuspendModal(userId, userName) {
        document.getElementById('suspend-user-name').textContent = userName;
        document.getElementById('suspend-form').action = '{{ url("admin/users") }}/' + userId + '/suspend';
        document.getElementById('suspend-modal').classList.remove('hidden');
    }
    function closeSuspendModal() {
        document.getElementById('suspend-modal').classList.add('hidden');
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSuspendModal();
    });
</script>
@endpush
@endsection
