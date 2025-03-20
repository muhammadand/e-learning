<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use Illuminate\Http\Request;

class CplController extends Controller
{
    public function index()
    {
        $cpls = Cpl::all();
        return view('cpls.index', compact('cpls'));
    }

    public function create()
    {
        return view('cpls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:cpls,code|max:50',
            'description' => 'required|string',
        ]);

        Cpl::create($request->all());
        return redirect()->route('cpls.index')->with('success', 'CPL berhasil ditambahkan!');
    }

    public function show(Cpl $cpl)
    {
        return view('cpls.show', compact('cpl'));
    }

    public function edit(Cpl $cpl)
    {
        return view('cpls.edit', compact('cpl'));
    }

    public function update(Request $request, Cpl $cpl)
    {
        $request->validate([
            'code' => 'required|max:50|unique:cpls,code,' . $cpl->id,
            'description' => 'required|string',
        ]);

        $cpl->update($request->all());
        return redirect()->route('cpls.index')->with('success', 'CPL berhasil diperbarui!');
    }

    public function destroy(Cpl $cpl)
    {
        $cpl->delete();
        return redirect()->route('cpls.index')->with('success', 'CPL berhasil dihapus!');
    }
}
