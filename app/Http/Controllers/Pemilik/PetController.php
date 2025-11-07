<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['rasHewan', 'pemilik'])
            ->select('idpet', 'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan')
            ->get();

        return view('admin.pet.index', compact('pet'));
    }
}