<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuditorController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian
        $search = $request->input('search');

        // Query dengan filter pencarian (jika ada) dan pagination
        $auditors = Auditor::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_aktif', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6);

        // Append search query ke link pagination agar tidak hilang saat pindah halaman
        $auditors->appends(['search' => $search]);

        return view('auditors.index', compact('auditors'));
    }

    public function create()
    {
        return view('auditors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:auditors,email',
            'nomor_aktif' => 'required|string|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        Auditor::create($request->all());

        return redirect()->route('auditors.index')
                         ->with('success', 'Auditor berhasil ditambahkan.');
    }

    public function edit(Auditor $auditor)
    {
        return view('auditors.edit', compact('auditor'));
    }

    public function update(Request $request, Auditor $auditor)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Ignore ID saat validasi unique email agar tidak error saat update diri sendiri
            'email' => ['required', 'email', Rule::unique('auditors')->ignore($auditor->id)],
            'nomor_aktif' => 'required|string|max:20',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $auditor->update($request->all());

        return redirect()->route('auditors.index')
                         ->with('success', 'Data auditor berhasil diperbarui.');
    }

    public function destroy(Auditor $auditor)
    {
        // Karena pakai SoftDeletes, perintah ini aman.
        // Data tidak hilang permanen, tapi "hidden".
        // Relasi dengan audit lama tetap aman.
        $auditor->delete();

        return redirect()->route('auditors.index')
                         ->with('success', 'Auditor berhasil dihapus.');
    }
}