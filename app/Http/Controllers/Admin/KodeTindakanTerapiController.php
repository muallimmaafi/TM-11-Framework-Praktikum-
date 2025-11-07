<?php

namespace App\Http\Controllers\Admin;

use App\Models\KodeTindakanTerapi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->select('idkode_tindakan_terapi', 'kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis')
            ->get();

        return view('admin.kode-tindakan-terapi.index', compact('tindakan'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.kode-tindakan-terapi.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validateKodeTindakanTerapi($request);

        $kodeTindakanTerapi = $this->createKodeTindakanTerapi($validatedData);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Kode tindakan terapi berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validateKodeTindakanTerapi(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:kode_tindakan_terapi,nama_kode_tindakan_terapi,' . $id . ',idkode_tindakan_terapi'
            : 'unique:kode_tindakan_terapi,nama_kode_tindakan_terapi';

        return $request->validate([
            'nama_kode_tindakan_terapi' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_kode_tindakan_terapi.required' => 'Nama kode tindakan terapi wajib diisi.',
            'nama_kode_tindakan_terapi.string' => 'Nama kode tindakan terapi harus berupa teks.',
            'nama_kode_tindakan_terapi.max' => 'Nama kode tindakan terapi maksimal 255 karakter.',
            'nama_kode_tindakan_terapi.min' => 'Nama kode tindakan terapi minimal 3 karakter.',
            'nama_kode_tindakan_terapi.unique' => 'Nama kode tindakan terapi sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createKodeTindakanTerapi(array $data)
    {
        try {
            return KodeTindakanTerapi::create([
                'nama_kode_tindakan_terapi' => $this->formatNamaKodeTindakanTerapi($data['nama_kode tindakan terapi']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kode tindakan terapi: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaKodeTindakanTerapi($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
