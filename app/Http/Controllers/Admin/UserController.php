<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roleUser.role')->get();

        return view('admin.user.index', compact('users'));
    }

    // 1) terima Request $request
    public function create()
    {
        return view('admin.user.create');
    }

    // 2) tambahkan Request $request parameter
    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request);

        $user = $this->createUser($validatedData);

        return redirect()->route('admin.user.index')
                        ->with('success', 'User berhasil ditambahkan');
    }

    // 3) perbaikan validate function: sintaks array dan unique rule
    protected function validateUser(Request $request, $id = null)
    {
        // jika $id ada (untuk update), tambahkan id exception pada unique rule
        $uniqueRule = $id
            ? 'unique:user,nama_user,' . $id . ',iduser'
            : 'unique:user,nama_user';

        return $request->validate([
            'nama_user' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
        ], [
            'nama_user.required' => 'Nama user hewan wajib diisi.',
            'nama_user.string' => 'Nama user harus berupa teks.',
            'nama_user.max' => 'Nama user maksimal 255 karakter.',
            'nama_user.min' => 'Nama user minimal 3 karakter.',
            'nama_user.unique' => 'Nama user sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    protected function createUser(array $data)
    {
        try {
            return User::create([
                'nama_user' => $this->formatNamaUser($data['nama_user']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data user: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    protected function formatNamaUser($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}
