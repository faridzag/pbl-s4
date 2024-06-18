<?php

namespace App\Http\Controllers\APPLICANT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('pages.event-management.list', [
            'title' => 'Manajemen Kegiatan CRUD',
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::paginate(10);
        return view('pages.company-account.create', [
            'title' => 'Kegiatan Baru',
            'events' => $events,
        ]);
        return view('pages.event-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::with('companies')->findOrFail($id);
        return view('pages.event-management.edit', [
            'title' => 'Edit Kegiatan',
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->companies()->detach();

        $event->delete();
    }
}
