<?php

namespace App\Http\Controllers\JPC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use DOMDocument;
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
            'name' => 'required|string|unique:events|min:6|max:100',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:open,closed',
            'companies' => 'required|array|min:1',
        ], [
                'name.required' => 'Nama kegiatan wajib diisi.',
                'name.string' => 'Nama kegiatan harus berupa string.',
                'name.unique' => 'Nama kegiatan sudah terdaftar.',
                'name.min' => 'Nama kegiatan minimal terdiri dari 6 karakter.',
                'name.max' => 'Nama kegiatan maksimal terdiri dari 100 karakter.',

                'image.required' => 'Gambar kegiatan wajib diunggah.',
                'image.image' => 'File yang diunggah harus berupa gambar.',
                'image.max' => 'Ukuran gambar maksimal 2 MB.',
                'image.mimes' => 'Format gambar harus berupa jpg, jpeg, atau png.',

                'location.required' => 'Lokasi kegiatan wajib diisi.',
                'location.string' => 'Lokasi kegiatan harus berupa string.',
                'location.max' => 'Lokasi kegiatan maksimal terdiri dari 255 karakter.',

                'description.required' => 'Deskripsi kegiatan wajib diisi.',
                'description.string' => 'Deskripsi kegiatan harus berupa string.',
                'description.max' => 'Deskripsi kegiatan maksimal terdiri dari 1500 karakter.',

                'event_type.required' => 'Jenis kegiatan wajib diisi.',
                'event_type.in' => 'Jenis kegiatan harus berupa Job Fair atau Campus Hiring.',

                'start_date.required' => 'Tanggal mulai kegiatan wajib diisi.',
                'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
                'start_date.after_or_equal' => 'Tanggal mulai harus hari ini atau tanggal yang akan datang.',

                'end_date.required' => 'Tanggal berakhir kegiatan wajib diisi.',
                'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
                'end_date.after_or_equal' => 'Tanggal berakhir harus sama atau setelah tanggal mulai.',

                'status.required' => 'Status kegiatan wajib diisi.',
                'status.in' => 'Status kegiatan harus berupa open atau closed.',

                'companies.required' => 'Setidaknya satu perusahaan harus dipilih.',
                'companies.array' => 'Daftar perusahaan harus berupa array.',
                'companies.min' => 'Setidaknya satu perusahaan harus dipilih.',
            ]);

        $event = new Event();
        $event->description = $request->input('description');

        $dom = new DOMDocument();
        $dom->loadHTML($event->description,9);
        $event->description = $dom->saveHTML();

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
            'name' => 'required|string|min:6|max:100|unique:events,name,'.$event->id,
            'image' => 'image|max:2048|mimes:jpg,jpeg,png',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'event_type' => 'required|in:Job Fair,Campus Hiring',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'required|in:open,closed',
            'companies' => 'required|array|min:1',
        ], [
                'name.required' => 'Nama kegiatan wajib diisi.',
                'name.string' => 'Nama kegiatan harus berupa string.',
                'name.unique' => 'Nama kegiatan sudah terdaftar.',
                'name.min' => 'Nama kegiatan minimal terdiri dari 6 karakter.',
                'name.max' => 'Nama kegiatan maksimal terdiri dari 100 karakter.',

                'image.image' => 'File yang diunggah harus berupa gambar.',
                'image.max' => 'Ukuran gambar maksimal 2 MB.',
                'image.mimes' => 'Format gambar harus berupa jpg, jpeg, atau png.',

                'location.required' => 'Lokasi kegiatan wajib diisi.',
                'location.string' => 'Lokasi kegiatan harus berupa string.',
                'location.max' => 'Lokasi kegiatan maksimal terdiri dari 255 karakter.',

                'description.required' => 'Deskripsi kegiatan wajib diisi.',
                'description.string' => 'Deskripsi kegiatan harus berupa string.',
                'description.max' => 'Deskripsi kegiatan maksimal terdiri dari 1500 karakter.',

                'event_type.required' => 'Jenis kegiatan wajib diisi.',
                'event_type.in' => 'Jenis kegiatan harus berupa Job Fair atau Campus Hiring.',

                'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',

                'end_date.date' => 'Tanggal berakhir harus berupa tanggal yang valid.',
                'end_date.after_or_equal' => 'Tanggal berakhir harus sama atau setelah tanggal mulai.',

                'status.required' => 'Status kegiatan wajib diisi.',
                'status.in' => 'Status kegiatan harus berupa open atau closed.',

                'companies.required' => 'Setidaknya satu perusahaan harus dipilih.',
                'companies.array' => 'Daftar perusahaan harus berupa array.',
                'companies.min' => 'Setidaknya satu perusahaan harus dipilih.',
            ]);

        if ($request->hasFile('image')) {
            if (isset($event->image)) {
                Storage::delete($event->image);
            }
            $image = $request->file('image')->store('public/events');
            $event->image = $image;
        }

        $event->description = $request->input('description');

        $dom = new DOMDocument();
        $dom->loadHTML($event->description,9);
        $event->description = $dom->saveHTML();

        $event->name = $request->name;
        $event->location = $request->location;
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
