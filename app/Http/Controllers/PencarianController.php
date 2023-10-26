<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('uid', 'LIKE', "%$search%");
            });
        }

        $penduduks = $search ? $query->get() : null;

        return view('halaman-pencarian.index', compact('penduduks'));
    }

    public function detailPenduduk($nik) {
        $penduduk = Penduduk::findOrFail($nik);
        return view('halaman-pencarian.detail-penduduk', compact('penduduk'));
    }
}
