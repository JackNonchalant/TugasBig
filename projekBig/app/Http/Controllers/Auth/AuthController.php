<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            /** @var User $user */
            $user = Auth::user();

            // Blokir login jika akun suspended
            if ($user->status_akun === 'suspended') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        'email' => 'Akun Anda telah dinonaktifkan karena pelanggaran ketentuan layanan. Silakan hubungi tim admin untuk informasi lebih lanjut.',
                    ]);
            }

            $request->session()->regenerate();

            return $this->redirectBasedOnRole($user)
                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Email atau password yang Anda masukkan tidak sesuai dengan data kami.',
            ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.register');
    }

    /**
     * Handle user registration.
     * Note: Only 'donor' and 'beneficiary' roles can be registered publicly.
     */
    public function register(Request $request): RedirectResponse
    {
        if ($request->has('fullName') && !$request->filled('name')) {
            $request->merge(['name' => $request->input('fullName')]);
        }
        if ($request->has('account_type') && !$request->filled('role')) {
            $request->merge(['role' => $request->input('account_type')]);
        }
        if ($request->input('role') === 'donatur') {
            $request->merge(['role' => 'donor']);
        }
        if ($request->input('role') === 'penerima') {
            $request->merge(['role' => 'beneficiary']);
        }
        if ($request->has('confirmPassword') && !$request->filled('password_confirmation')) {
            $request->merge(['password_confirmation' => $request->input('confirmPassword')]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:donor,beneficiary'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar di sistem kami.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Silakan pilih peran (role) Anda.',
            'role.in' => 'Peran yang dipilih tidak valid. Registrasi publik hanya untuk Donatur dan Penerima Manfaat.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectBasedOnRole($user)
            ->with('success', 'Pendaftaran akun berhasil! Selamat datang di PojokBerbagi.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari akun.');
    }

    /**
     * Helper to redirect user to their role-specific dashboard.
     */
    protected function redirectBasedOnRole(User $user): RedirectResponse
    {
        return match ($user->role) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'beneficiary' => redirect()->intended(route('beneficiary.dashboard')),
            default => redirect()->intended(route('donor.dashboard')),
        };
    }
}
