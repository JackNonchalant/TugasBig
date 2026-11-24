<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar pengguna dengan search & filter.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by nama or email
        if ($request->filled('search')) {
            $term = $request->input('search');
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('nama_lengkap', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        // Filter by status_akun
        if ($request->filled('status')) {
            $query->where('status_akun', $request->input('status'));
        }

        $users = $query->orderBy('created_at', 'desc')
                       ->paginate(12)
                       ->appends($request->except('page'));

        return view('admin.users.index', compact('users'));
    }

    /**
     * Suspend (nonaktifkan) akun pengguna.
     */
    public function suspend(User $user)
    {
        // Tidak bisa suspend sesama admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menonaktifkan akun admin lain.');
        }

        // Sudah suspended
        if ($user->status_akun === 'suspended') {
            return back()->with('error', 'Akun ini sudah dalam status suspended.');
        }

        DB::transaction(function () use ($user) {
            $user->update(['status_akun' => 'suspended']);

            Notifikasi::create([
                'user_id'          => $user->id ?? $user->user_id,
                'judul_notifikasi' => 'Akun dinonaktifkan',
                'pesan'            => 'Akun Anda telah dinonaktifkan oleh tim admin karena pelanggaran ketentuan layanan.',
                'status_baca'      => 'belum',
                'created_at'       => now(),
            ]);
        });

        return back()->with('success', "Akun {$user->name} berhasil dinonaktifkan (suspended).");
    }

    /**
     * Aktifkan kembali (reactivate) akun pengguna.
     */
    public function activate(User $user)
    {
        // Hanya akun suspended yang bisa diaktifkan
        if ($user->status_akun === 'aktif') {
            return back()->with('error', 'Akun ini sudah dalam status aktif.');
        }

        DB::transaction(function () use ($user) {
            $user->update(['status_akun' => 'aktif']);

            Notifikasi::create([
                'user_id'          => $user->id ?? $user->user_id,
                'judul_notifikasi' => 'Akun diaktifkan kembali',
                'pesan'            => 'Akun Anda telah diaktifkan kembali oleh tim admin. Selamat datang kembali di PojokBerbagi!',
                'status_baca'      => 'belum',
                'created_at'       => now(),
            ]);
        });

        return back()->with('success', "Akun {$user->name} berhasil diaktifkan kembali.");
    }
}
