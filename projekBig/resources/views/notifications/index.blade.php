@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Notifikasi</h1>
            <p class="text-xs text-slate-500 mt-1">Pemberitahuan terkait aktivitas penyaluran barang donasi</p>
        </div>
        @if ($notifications->where('read_at', null)->count() > 0)
            <form method="POST" action="{{ route('notifications.read-all') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if ($notifications->isEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-12 text-center">
            <svg class="w-12 h-12 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <p class="text-sm text-slate-400">Belum ada notifikasi.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach ($notifications as $notif)
                <div class="bg-white rounded-xl border {{ $notif->read_at ? 'border-slate-200' : 'border-emerald-300 bg-emerald-50/30' }} shadow-sm overflow-hidden transition-colors">
                    <div class="p-4 flex items-start gap-4">
                        <!-- Icon -->
                        <div class="shrink-0 mt-0.5">
                            @if ($notif->type === 'success')
                                <div class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @elseif ($notif->type === 'warning')
                                <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                            @else
                                <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="text-sm font-bold text-slate-900">{{ $notif->title }}</h3>
                                @if (!$notif->read_at)
                                    <span class="shrink-0 w-2 h-2 rounded-full bg-emerald-500 mt-1.5"></span>
                                @endif
                            </div>
                            <p class="text-sm text-slate-600 mt-0.5">{{ $notif->message }}</p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="text-[11px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                @if (!$notif->read_at)
                                    <form method="POST" action="{{ route('notifications.read', $notif->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-semibold text-emerald-600 hover:text-emerald-700">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($notifications->hasPages())
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
