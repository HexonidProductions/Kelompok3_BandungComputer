<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Menampilkan daftar pesan/feedback dari user di dashboard admin.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = ContactMessage::with('user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $feedbacks = $query->latest()->paginate(8)->withQueryString();

        return view('dashboard.contact_messages.index', compact('feedbacks', 'search'));
    }

    /**
     * Menyimpan pesan baru yang dikirim dari halaman kontak sisi user.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login atau daftar akun terlebih dahulu untuk mengirim pesan.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.');
    }

    /**
     * Menghapus pesan feedback.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->back()->with('success', 'Feedback message deleted successfully!');
    }
}