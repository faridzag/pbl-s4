<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $event = Event::get();
        return view('pages.events.index', ['event' => $event]);
    }

    public function tambah()
    {
        return view('pages.events.tambah-event');
    }

    public function simpan(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'date' => 'required|date',
        ]);

        // Menyimpan data event ke database
        Event::create($request->all());

        return redirect()->route('event');
    }

    public function edit($id)
    {
        $event = Event::find($id)->first();

        return view('pages.events.tambah-event', ['event'=>$event]);
    }

    public function update($id, Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'date' => 'required|date',
        ]);

        Event::find($id)->update($request->all());

        return redirect()->route('event');
    }

    public function hapus($id)
    {
        Event::find($id)->delete();

        return redirect()->route('event');
    }
}
