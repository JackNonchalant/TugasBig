@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.admin' : 'layouts.app')
@section('page-title', 'Notifikasi')

@section('title', 'Notifikasi')

@section('content')
<div class="{{ auth()->check() && auth()->user()->isAdmin() ? 'max-w-4xl mx-auto' : 'max-w-4xl mx-auto px-5 sm:px-8 py-10' }}">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6 border-b border-stone-200 mb-6 rise">
        <div>
            <p class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-[.18em] text-ochre mb-2">
                <span class="h-px w-8 bg-ochre"></span>
                Pusat Pemberitahuan
            </p>
            <h1 class="font-display text-3xl sm:text-4xl tracking-tight text-ink">Notifikasi</h1>
            <p class="text-xs sm:text-sm text-warm mt-1">Pemberitahuan terkait verifikasi, penyaluran barang donasi, dan status akun Anda.</p>
        </div>
        @if ($notifications->where('read_at', null)->count() > 0)
            <form method="POST" action="{{ route('notifications.read-all') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold text-forest bg-white border border-stone-200 hover:border-forest hover:bg-cream transition-all cursor-pointer active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if ($notifications->isEmpty())
        <div class="bg-white rounded-2xl border border-dashed border-stone-300 p-14 text-center">
            <p class="font-display text-2xl text-ink">Belum ada notifikasi.</p>
            <p class="text-xs text-warm mt-1.5">Setiap pembaruan penyaluran dan status akun akan muncul di sini.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach ($notifications as $notif)
                <div class="bg-white rounded-xl border {{ $notif->read_at ? 'border-stone-200' : 'border-ochre/50 bg-cream/40' }} overflow-hidden transition-colors">
                    <div class="p-4 sm:p-5 flex items-start gap-4">
                        <!-- Icon -->
                        <div class="shrink-0 mt-0.5">
                            @if ($notif->type === 'success')
                                <div class="w-9 h-9 rounded-full bg-emerald-50 border border-forest/20 flex items-center justify-center text-forest">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            @elseif ($notif->type === 'warning')
                                <div class="w-9 h-9 rounded-full bg-amber-50 border border-amber-200 flex items-center justify-center text-ochre">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                            @else
                                <div class="w-9 h-9 rounded-full bg-cream border border-stone-200 flex items-center justify-center text-ink">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="text-sm font-semibold text-ink">{{ $notif->title }}</h3>
                                @if (!$notif->read_at)
                                    <span class="shrink-0 w-2 h-2 rounded-full bg-ochre mt-1.5"></span>
                                @endif
                            </div>
                            <p class="text-sm text-warm mt-0.5 leading-relaxed">{{ $notif->message }}</p>
                            <div class="flex items-center gap-3 mt-2.5">
                                <span class="text-[11px] text-stone-400">{{ $notif->created_at->diffForHumans() }}</span>
                                @if (!$notif->read_at)
                                    <form method="POST" action="{{ route('notifications.read', $notif->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-semibold text-forest hover:text-ochre transition-colors cursor-pointer">
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
            <div class="mt-6 bg-white rounded-xl border border-stone-200 px-5 py-3">
                {{ $notifications->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
