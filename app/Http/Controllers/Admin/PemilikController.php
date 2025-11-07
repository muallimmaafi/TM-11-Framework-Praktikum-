<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.pemilik.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validatePemilik($request);

        $pemilik = $this->createPemilik($validatedData);

        return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Pemilik berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validatePemilik(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:pemilik,nama_pemilik,' . $id . ',idpemilik'
            : 'unique:pemilik,nama_pemilik';

        return $request->validate([
            'nama_pemilik' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'nama_pemilik.string' => 'Nama pemilik harus berupa teks.',
            'nama_pemilik.max' => 'Nama pemilik maksimal 255 karakter.',
            'nama_pemilik.min' => 'Nama pemilik minimal 3 karakter.',
            'nama_pemilik.unique' => 'Nama pemilik sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createPemilik(array $data)
    {
        try {
            return Pemilik::create([
                'nama_pemilik' => $this->formatNamaPemilik($data['nama_pemilik']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data pemilik: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaPemilik($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
