<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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


    // ...

    public function store(Request $request)
    {
        $request->validate([
            'name_surat' => 'required',
        ]);

        JenisSurat::create([
            'name_surat' => $request->name_surat,
        ]);

        Alert::success('Berhasil', 'Data berhasil ditambahkan');

        return redirect('/jenis-surat');
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
    public function update(Request $request, $id)
    {
        $jenissurat = JenisSurat::findOrFail($id);
        $request->validate([
            'name_surat' => 'required', 
        ]);

        $jenissurat->update([
            'name_surat' => $request->input('name_surat')
        ]);

        Alert::success('Data Berhasil di Ubah');
        return redirect('/jenis-surat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $surat = JenisSurat::findOrFail($id);
            $surat->delete();
            return redirect('/jenis-surat');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
