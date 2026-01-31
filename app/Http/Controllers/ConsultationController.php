<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\User;
use App\Notifications\NewConsultationNotification;
use Illuminate\Support\Facades\Storage;

class ConsultationController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'pasien') {
            $consultations = Consultation::where('user_id', auth()->id())->latest()->get();
            return view('consultations.index', compact('consultations'));
        }
        
        if (auth()->user()->role === 'doktor') {
            $consultations = Consultation::with('user')->latest()->get();
            return view('consultations.create', compact('consultations'));
        }
        
        return redirect('/')->with('error', 'Akses ditolak.');
    }

    public function create()
    {
        return view('consultations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'complaint' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('consultations', 'public');
        }

        $consultation = Consultation::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'complaint' => $request->complaint,
            'attachment' => $attachmentPath,
            'status' => 'pending'
        ]);

        // Notify all doctors
        $doctors = User::where('role', 'doktor')->get();
        foreach ($doctors as $doctor) {
            $doctor->notify(new NewConsultationNotification($consultation));
        }

        return redirect()->route('consultations.index')->with('success', 'Konsultasi berhasil dikirim!');
    }

    public function show(Consultation $consultation)
    {
        if (auth()->user()->role === 'doktor' || $consultation->user_id === auth()->id()) {
            return view('consultations.show', compact('consultation'));
        }
        
        return redirect()->back()->with('error', 'Akses ditolak.');
    }

    public function reply(Request $request, Consultation $consultation)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $consultation->update([
            'reply' => $request->reply,
            'doctor_id' => auth()->id(),
            'status' => 'answered'
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function notifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications()->where('id', $id)->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
}
