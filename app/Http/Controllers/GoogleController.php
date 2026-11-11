<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    // Redirect ke halaman login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes([
                'https://www.googleapis.com/auth/user.phonenumbers.read',
                'https://www.googleapis.com/auth/user.addresses.read',
            ])
            ->redirect();
    }

    // Callback dari Google setelah login
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();
            $peopleResponse = Http::withToken($googleUser->token)
                ->get('https://people.googleapis.com/v1/people/me', [
                    'personFields' => 'phoneNumbers,addresses',
                ]);

            $peopleData = $peopleResponse->successful()
                ? $peopleResponse->json()
                : [];

            $phoneNumber = data_get($peopleData, 'phoneNumbers.0.value');
            $address = data_get($peopleData, 'addresses.0.formattedValue');

            // Cek apakah user sudah terdaftar berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                // Jika user sudah terdaftar, perbarui data Google jika belum ada
                $user->update(array_filter([
                    'google_id'    => $googleUser->getId(),
                    'avatar'       => $googleUser->getAvatar(),
                    'phone_number' => $phoneNumber,
                    'address'      => $address,
                ], fn ($value) => filled($value)));
            } else {
                // Jika user belum terdaftar, buat user baru
                $user = User::create([
                    'name'         => $googleUser->getName(),
                    'email'        => $googleUser->getEmail(),
                    'google_id'    => $googleUser->getId(),
                    'password'     => bcrypt(str()->random(16)), // Password acak karena login menggunakan Google
                    'avatar'       => $googleUser->getAvatar(),
                    'phone_number' => $phoneNumber,
                    'address'      => $address,
                    'role'         => 'customer', // Set role default sebagai Customer
                ]);
            }

            // Login user
            Auth::login($user);

            // Admin langsung ke dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            // Customer: jika belum lengkap data, ke complete profile
            if (blank($user->phone_number) || blank($user->address)) {
                return redirect()->route('complete.profile');
            }
            // Customer dengan data lengkap ke homepage
            return redirect()->route('homepage');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login: ' . $e->getMessage());
        }
    }

    // Tampilkan form lengkapi data (phone & address) untuk customer Google
    public function showCompleteProfile()
    {
        return view('auth.complete-profile');
    }

    // Simpan phone & address manual, lalu arahkan ke homepage
    public function storeCompleteProfile(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required|numeric|digits_between:10,13',
            'address'      => 'required|string|max:500',
        ]);

        $request->user()->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('homepage'),
            ]);
        }

        return redirect()->route('homepage');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}