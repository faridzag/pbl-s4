<?php

namespace App\Http\Controllers\APPLICANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $applications = $user->applicant->applications()->with('vacancy.event');

        if ($request->has('search') && $request->search !== '') {
            $applications = $applications->where('status', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('vacancy', function ($query) use ($request) {
                    // Mencari berdasarkan posisi lowongan
                    $query->where('position', 'LIKE', '%' . $request->search . '%');
                })->orWhereHas('vacancy.event', function ($query) use ($request) {
                    // Mencari berdasarkan nama event (jika ada relasi event pada vacancy)
                    $query->where('name', 'LIKE', '%' . $request->search . '%');
                })->orWhereHas('vacancy.company', function ($query) use ($request) {
                    // Mencari berdasarkan deskripsi perusahaan
                    $query->where('description', 'LIKE', '%' . $request->search . '%');
                });
        }
        

        $applications = $applications->latest()->paginate(10); // Paginate for better performance

        return view('pages.applicant-job.list', compact('applications'));
    }

    public function destroy(string $id)
    {
        $application = Application::find($id);
        $application->delete();

        return redirect()->route('my-job-application')->with('message', 'Lamaran berhasil dihapus!');
    }
}
