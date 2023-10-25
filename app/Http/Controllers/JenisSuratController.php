<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisSurats = JenisSurat::all();
        return view('jenis-surat.index', [
            'jenissurat' => $jenisSurats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_surat' => 'required',
        ]);

        JenisSurat::create([
            'name_surat' => $request->name_surat,
        ]);

        return redirect('/jenis-surat')->with('success', 'Jenis Surat Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSurat $jenisSurat)
    {
        //
    }
}
