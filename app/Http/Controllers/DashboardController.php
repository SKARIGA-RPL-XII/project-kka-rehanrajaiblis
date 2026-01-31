<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses dashboard.');
        }
        
        $stats = [
            'total_users' => User::count(),
            'total_doctors' => User::where('role', 'doktor')->count(),
            'total_patients' => User::where('role', 'pasien')->count(),
            'total_consultations' => Consultation::count(),
            'pending_consultations' => Consultation::where('status', 'pending')->count(),
        ];
        
        return view('dashboard', compact('stats'));
    }
}
