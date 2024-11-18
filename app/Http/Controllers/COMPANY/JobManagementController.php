<?php

namespace App\Http\Controllers\COMPANY;

use DOMDocument;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Mail\ApplicationStatusUpdate;
use Illuminate\Support\Facades\Mail;

class JobManagementController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Vacancy::query();

        if ($request->has('search') && $request->search !== '') {
            $jobs = Vacancy::where('company_id', auth()->user()->company->id)  // filter hanya menampilkan data milik sendiri
                ->where(function($query) use ($request) {
                    $query->where('position', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                        ->orWhereHas('event', function ($eventQuery) use ($request) {
                            $eventQuery->where('name', 'LIKE', '%' . $request->search . '%');
                        });
                });
        }else{
            $jobs->where('company_id', auth()->user()->company->id);
        }
        // Event filter
        if ($request->has('event') && $request->event !== '') {
            $jobs->where('event_id', $request->event);
        }

        // Get events for filter dropdown
        $events = Event::whereHas('jobVacancies', function($query) {
            $query->where('company_id', auth()->user()->company->id);
        })->get();

        $jobs = $jobs->paginate(10);
        return view('pages.job-management.list', [
            'title' => 'Manajemen Lowongan',
            'jobs' => $jobs,
            'events' => $events,
        ]);
    }
    public function sendStatusEmails($id)
    {
        try {
            $vacancy = Vacancy::with(['applications.user', 'event', 'company'])->findOrFail($id);

            foreach ($vacancy->applications as $application) {
                $message = $application->status === 'accept'
                ? $vacancy->accept_message
                : $vacancy->reject_message;

                Mail::to($application->user->email)->send(
                    new ApplicationStatusUpdate(
                        $application->user,
                        $application,
                        $message
                    )
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Status emails sent successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error  emails: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $user = auth()->user();
        $availableEvents = $user->company->events()->where('status', 'open')->get();
        $jobs = Vacancy::paginate(10);
        return view('pages.job-management.create', compact('jobs', 'availableEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'accept_message' => 'required|string|max:1500',
            'reject_message' => 'string|max:1500',
            'status' => 'required|string|in:open,closed',
        ], [
                // Event ID
                'event_id.required' => 'Acara terkait wajib dipilih.',
                'event_id.exists' => 'Acara yang dipilih tidak valid.',

                // Position
                'position.required' => 'Posisi/jabatan wajib diisi.',
                'position.string' => 'Posisi harus berupa teks.',
                'position.max' => 'Posisi maksimal 255 karakter.',

                // Description
                'description.required' => 'Deskripsi lowongan wajib diisi.',
                'description.string' => 'Deskripsi harus berupa teks.',
                'description.max' => 'Deskripsi maksimal 1500 karakter.',

                // Message
                'accept_message.required' => 'Pesan diterima wajib diisi.',
                'accept_message.string' => 'Pesan diterima harus berupa teks.',
                'accept_message.max' => 'Pesan diterima maksimal 1500 karakter.',
                'reject_message.string' => 'Pesan diterima harus berupa teks.',
                'reject_message.max' => 'Pesan diterima maksimal 1500 karakter.',

                // Status
                'status.required' => 'Status lowongan wajib diisi.',
                'status.string' => 'Status harus berupa teks.',
                'status.in' => 'Status hanya boleh berisi "open" atau "closed".',
            ]);

        $job = new Vacancy();
        $job->event_id = $request->event_id;
        $job->position = $request->position;
        $job->description = $request->description;
        $job->accept_message = $request->accept_message;
        $job->reject_message = $request->reject_message;
        $job->status = $request->status;
        $job->user_id = auth()->user()->id;
        $job->company_id = auth()->user()->company->id;

        $dom = new DOMDocument();
        $dom->loadHTML($job->description,9);

        /*$images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }*/
        $job->description = $dom->saveHTML();

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function edit(string $id)
    {
        $user = auth()->user();
        $availableEvents = $user->company->events()->where('status', 'open')->get();
        $job = Vacancy::find($id);
        //dd($user->company->id);
        //dd($job->company_id);
        if (!Gate::allows('update-job', $job)) {
            return redirect()->route('job-management.index')->withErrors(['error' => 'Anda Tidak Memiliki Izin Untuk Mengupdate Kegiatan Tersebut.']);
        }
        return view('pages.job-management.edit', compact('job', 'availableEvents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'accept_message' => 'required|string|max:1500',
            'reject_message' => 'required|string|max:1500',
            'status' => 'required|string|in:open,closed',
        ], [
                // Position
                'position.required' => 'Posisi/jabatan wajib diisi.',
                'position.string' => 'Posisi harus berupa teks.',
                'position.max' => 'Posisi maksimal 255 karakter.',

                // Description
                'description.required' => 'Deskripsi lowongan wajib diisi.',
                'description.string' => 'Deskripsi harus berupa teks.',
                'description.max' => 'Deskripsi maksimal 1500 karakter.',

                // Message
                'accept_message.required' => 'Pesan diterima wajib diisi.',
                'accept_message.string' => 'Pesan diterima harus berupa teks.',
                'accept_message.max' => 'Pesan diterima maksimal 1500 karakter.',
                'reject_message.string' => 'Pesan diterima harus berupa teks.',
                'reject_message.max' => 'Pesan diterima maksimal 1500 karakter.',

                // Status
                'status.required' => 'Status lowongan wajib diisi.',
                'status.string' => 'Status harus berupa teks.',
                'status.in' => 'Status hanya boleh berisi "open" atau "closed".',
            ]);
        $job = Vacancy::find($id);

        $job->position = $request->position;
        $job->description = $request->description;
        $job->accept_message = $request->accept_message;
        $job->reject_message = $request->reject_message;
        $job->status = $request->status;

        $dom = new DOMDocument();
        $dom->loadHTML($job->description,9);
        $job->description = $dom->saveHTML();

        $job->save();

        return redirect()->route('job-management.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $job = Vacancy::find($id);
        $job->delete();
        return redirect()->route('job-management.index')->with('message', 'Lowongan berhasil dihapus!');
    }
}
