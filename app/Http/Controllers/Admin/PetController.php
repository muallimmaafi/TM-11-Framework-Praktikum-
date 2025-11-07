<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['rasHewan', 'pemilik'])
            ->select('idpet', 'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan')
            ->get();

        return view('admin.pet.index', compact('pet'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.pet.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);

        $pet = $this->createPet($validatedData);

        return redirect()->route('admin.pet.index')
                        ->with('success', 'Pet berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validatePet(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:pet,nama_pet,' . $id . ',idpet'
            : 'unique:pet,nama_pet';

        return $request->validate([
            'nama_pet' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_pet.required' => 'Nama pet wajib diisi.',
            'nama_pet.string' => 'Nama pet harus berupa teks.',
            'nama_pet.max' => 'Nama pet maksimal 255 karakter.',
            'nama_pet.min' => 'Nama pet minimal 3 karakter.',
            'nama_pet.unique' => 'Nama pet sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createPet(array $data)
    {
        try {
            return Pet::create([
                'nama_pet' => $this->formatNamaPet($data['nama_pet']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data pet: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
