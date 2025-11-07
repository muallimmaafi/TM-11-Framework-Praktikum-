<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::select('idkategori', 'nama_kategori')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.kategori.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validateKategori($request);

        $kategori = $this->createKategori($validatedData);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validateKategori(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:kategori,nama_kategori,' . $id . ',idkategori'
            : 'unique:kategori,nama_kategori';

        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createKategori(array $data)
    {
        try {
            return Kategori::create([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
