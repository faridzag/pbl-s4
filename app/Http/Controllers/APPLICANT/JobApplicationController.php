<?php

namespace App\Http\Controllers\APPLICANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $applications = $user->applicant->applications()->latest()->paginate(10); // Paginate for better performance with many applications
    
        return view('pages.applicant-job.list', compact('applications'));
    }
    public function destroy(string $id)
    {
        $application = Application::find($id);
        $application->delete();

        return redirect()->route('my-job-application')->with('message', 'Lamaran berhasil dihapus!');
    }
}
