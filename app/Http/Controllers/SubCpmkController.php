<?php

namespace App\Http\Controllers;

use App\Models\SubCpmk;
use App\Models\Cpmk;
use Illuminate\Http\Request;

class SubCpmkController extends Controller
{
    /**
     * Tampilkan daftar Sub CPMK.
     */
    public function index()
    {
        $subCpmks = SubCpmk::with('cpmk')->get();
        return view('sub_cpmks.index', compact('subCpmks'));
    }

    /**
     * Tampilkan form tambah Sub CPMK.
     */
    public function create()
    {
        $cpmks = Cpmk::all(); // Ambil semua CPMK untuk dropdown
        return view('sub_cpmks.create', compact('cpmks'));
    }

    /**
     * Simpan Sub CPMK baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cpmk_id' => 'required|exists:cpmks,id',
            'code' => 'required|string|unique:sub_cpmks,code',
            'description' => 'required|string',
        ]);

        SubCpmk::create($request->all());

        return redirect()->route('courses.enrol')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail Sub CPMK.
     */
    public function show(SubCpmk $subCpmk)
    {
        return view('sub_cpmks.show', compact('subCpmk'));
    }

    /**
     * Tampilkan form edit Sub CPMK.
     */
    public function edit(SubCpmk $subCpmk)
    {
        $cpmks = Cpmk::all(); // Ambil semua CPMK untuk dropdown
        return view('sub_cpmks.edit', compact('subCpmk', 'cpmks'));
    }

    /**
     * Update Sub CPMK.
     */
    public function update(Request $request, SubCpmk $subCpmk)
    {
        $request->validate([
            'cpmk_id' => 'required|exists:cpmks,id',
            'code' => 'required|string|unique:sub_cpmks,code,' . $subCpmk->id,
            'description' => 'required|string',
        ]);

        $subCpmk->update($request->all());

        return redirect()->route('sub_cpmks.index')->with('success', 'Sub CPMK berhasil diperbarui.');
    }

    /**
     * Hapus Sub CPMK.
     */
    public function destroy(SubCpmk $subCpmk)
    {
        $subCpmk->delete();
        return redirect()->route('sub_cpmks.index')->with('success', 'Sub CPMK berhasil dihapus.');
    }
}
