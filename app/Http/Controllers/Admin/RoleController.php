<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::select('idrole', 'nama_role')->get();

        return view('admin.role.index', compact('role'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.role.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validateRole($request);

        $role = $this->createRole($validatedData);

        return redirect()->route('admin.role.index')
                        ->with('success', 'Role berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validateRole(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:role,nama_role,' . $id . ',idrole'
            : 'unique:role,nama_role';

        return $request->validate([
            'nama_role' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_role.required' => 'Nama role hewan wajib diisi.',
            'nama_role.string' => 'Nama role harus berupa teks.',
            'nama_role.max' => 'Nama role maksimal 255 karakter.',
            'nama_role.min' => 'Nama role minimal 3 karakter.',
            'nama_role.unique' => 'Nama role sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createRole(array $data)
    {
        try {
            return Role::create([
                'nama_role' => $this->formatNamaRole($data['nama_role']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data role: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaRole($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
