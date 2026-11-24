{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Daftar Akun Pengguna</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola seluruh akun donatur dan penerima manfaat terdaftar di PojokBerbagi.</p>
        </div>
        <div class="flex items-center gap-2 text-sm">
            <span class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 font-semibold text-slate-600">
                Total: {{ $users->total() }} Pengguna
            </span>
        </div>
    </div>

    {{-- Search & Filter Bar --}}
    <form method="GET" action="{{ route('admin.users.index') }}"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4">
        <div class="flex flex-col md:flex-row md:items-end gap-3">
            {{-- Search --}}
            <div class="flex-1">
                <label for="search" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Cari Pengguna</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama atau email..."
                           class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder-slate-400">
                </div>
            </div>

            {{-- Filter: Role --}}
            <div class="w-full md:w-44">
                <label for="role" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Peran</label>
                <select id="role" name="role"
                        class="w-full py-2.5 px-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white">
                    <option value="">Semua Peran</option>
                    <option value="donor" {{ request('role') == 'donor' ? 'selected' : '' }}>Donatur</option>
                    <option value="beneficiary" {{ request('role') == 'beneficiary' ? 'selected' : '' }}>Penerima</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            {{-- Filter: Status --}}
            <div class="w-full md:w-44">
                <label for="status" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Status Akun</label>
                <select id="status" name="status"
                        class="w-full py-2.5 px-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm shadow-emerald-600/20 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
                @if (request()->hasAny(['search', 'role', 'status']))
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center gap-1 px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    {{-- Users Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if ($users->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <p class="text-sm text-slate-500">Tidak ada pengguna yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">No. Telepon</th>
                            <th class="px-6 py-4">Peran</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                {{-- Nama + Email --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0
                                            {{ $user->role === 'admin' ? 'bg-purple-600' : ($user->role === 'donor' ? 'bg-emerald-600' : 'bg-blue-600') }}">
                                            {{ strtoupper(substr($user->name ?? $user->nama_lengkap ?? '?', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-slate-900 truncate">{{ $user->name ?? $user->nama_lengkap ?? '-' }}</div>
                                            <div class="text-xs text-slate-400 truncate">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Telepon --}}
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $user->no_telepon ?? '-' }}</td>

                                {{-- Role Badge --}}
                                <td class="px-6 py-4">
                                    @if ($user->role === 'donor')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Donatur
                                        </span>
                                    @elseif ($user->role === 'beneficiary')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            Penerima
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                            Admin
                                        </span>
                                    @endif
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    @if ($user->status_akun === 'aktif')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Suspended
                                        </span>
                                    @endif
                                </td>

                                {{-- Tanggal Daftar --}}
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($user->role !== 'admin')
                                        @if ($user->status_akun === 'aktif')
                                            <button type="button"
                                                    onclick="openSuspendModal({{ $user->id ?? $user->user_id }}, '{{ e($user->name ?? $user->nama_lengkap) }}')"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                                Suspend
                                            </button>
                                        @else
                                            <form method="POST" action="{{ route('admin.users.activate', $user->id ?? $user->user_id) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-lg transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Aktifkan Kembali
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-xs text-slate-400 italic">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

{{-- ========== SUSPEND CONFIRMATION MODAL ========== --}}
<div id="suspend-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/50" onclick="closeSuspendModal()"></div>

    {{-- Modal Box --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 pt-6 pb-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Konfirmasi Suspend Akun</h3>
                    <p class="text-xs text-slate-500">Tindakan ini akan menonaktifkan akun pengguna</p>
                </div>
            </div>
            <p class="text-sm text-slate-600">
                Anda yakin ingin menonaktifkan (suspend) akun <strong id="suspend-user-name" class="text-slate-900"></strong>?
                Pengguna tidak akan bisa login dan melakukan transaksi.
            </p>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
            <button type="button" onclick="closeSuspendModal()"
                    class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-colors">
                Batal
            </button>
            <form id="suspend-form" method="POST" action="">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm shadow-red-600/20 transition-colors">
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
    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSuspendModal();
    });
</script>
@endpush
@endsection
