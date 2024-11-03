<?php

namespace App\Http\Controllers\JPC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class EventManagementController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query();

        if ($request->has('search') && $request->search !== '') {
            $events = Event::where('name', 'LIKE', '%' .$request->search.'%')
            ->orWhere('location', 'LIKE', '%' .$request->search.'%')
            ->orWhere('description', 'LIKE', '%' .$request->search.'%');
        }

        $events = $events->paginate(10);
        return view('pages.event-management.list', [
            'title' => 'Manajemen Kegiatan CRUD',
            'events' => $events,
        ]);
    }


    public function create()
    {
        $event = new Event();
        $companies = Company::where('status', 1)->get();
        return view('pages.event-management.create', compact('event', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image|file|max:1024',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:open,closed,done',
            'companies' => 'required|array|min:1', // setidaknya 1 anggota
        ]);

        $image = $request->file('image')->store('public/events');
        $event = Event::create([
            'name' => $request->input('name'),
            'image' => $image,
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'event_type' => $request->input('event_type'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
            'companies' => $request->input('companies'),
        ]);


        $event->companies()->attach($request->input('companies'));
        return redirect()->route('event-management.index')->with('success', 'Kegiatan Berhasil Ditambahkan!');
    }

    public function edit(string $id)
    {
        $event = Event::with('companies')->findOrFail($id);
        $companies = Company::where('status', 1)->get();
        return view('pages.event-management.edit', compact('event', 'companies'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'image|file|max:1024',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'status' => 'required|in:open,closed,ongoing,done',
            'companies' => 'required|array',  // Setidaknya 1 item terpilih
        ]);

        if ($request->hasFile('image')) {
            if (isset($event->image)) {
                Storage::delete($event->image);
            }
            $image = $request->file('image')->store('public/events');
            $event->image = $image;
        }

        $event->name = $request->name;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->event_type = $request->event_type;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->status = $request->status;

        $event->save();

        // Sync update
        $event->companies()->sync($request->input('companies'));

        return redirect()->route('event-management.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->companies()->detach();

        $event->delete();

        return redirect()->route('event-management.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
