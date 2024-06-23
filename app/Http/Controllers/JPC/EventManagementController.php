<?php

namespace App\Http\Controllers\JPC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Company;

class EventManagementController extends Controller
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
        $event = new Event();  // Create a new empty event object
        $companies = Company::all();
        return view('pages.event-management.create', compact('event', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        $event->companies()->attach($request->input('companies'));
        return redirect()->route('event-management.index')->with('success', 'Kegiatan Berhasil Ditambahkan!');
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
        $companies = Company::all();
        return view('pages.event-management.edit', compact('event', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'event_type' => 'required|string',
            'start_date' => 'required|date',
            'status' => 'required|string',
            'companies' => 'required|array',  // Setidaknya 1 item terpilih
        ]);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->event_type = $request->event_type;
        $event->start_date = $request->start_date;
        $event->status = $request->status;

        $event->save();

        // Sync update
        $event->companies()->sync($request->input('companies'));

        return redirect()->route('event-management.index')->with('success', 'Kegiatan berhasil diperbarui!');
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
