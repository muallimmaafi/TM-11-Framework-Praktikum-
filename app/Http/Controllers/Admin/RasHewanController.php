<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();

        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.ras-hewan.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validateRasHewan($request);

        $rasHewan = $this->createRasHewan($validatedData);

        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Ras hewan berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validateRasHewan(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:ras_hewan,nama_ras_hewan,' . $id . ',idras_hewan'
            : 'unique:ras_hewan,nama_ras_hewan';

        return $request->validate([
            'nama_ras_hewan' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_ras_hewan.required' => 'Nama ras hewan wajib diisi.',
            'nama_ras_hewan.string' => 'Nama ras hewan harus berupa teks.',
            'nama_ras_hewan.max' => 'Nama ras hewan maksimal 255 karakter.',
            'nama_ras_hewan.min' => 'Nama ras hewan minimal 3 karakter.',
            'nama_ras_hewan.unique' => 'Nama ras hewan sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createRasHewan(array $data)
    {
        try {
            return RasHewan::create([
                'nama_ras_hewan' => $this->formatNamaRasHewan($data['nama_ras_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaRasHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
