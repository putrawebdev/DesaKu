<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = Resident::all();
        return view('pages.resident.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.resident.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required',
            'name' => 'required|max:100',
            'gender' => 'required',
            'birth_date' => 'required|string',
            'birth_place' => 'required|max:100',
            'address' => 'required|max:700',
            'religion' => 'nullable|max:50',
            'marital_status' => 'required',
            'occupation' => 'nullable|max:100',
            'phone' => 'nullable|max:15',
            'status' => 'required',
        ]);
        
        Resident::create($validatedData);
        return redirect()->route('resident.index')->with('success', 'Data Penduduk Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $residents = Resident::all();
        $residentFind = Resident::findOrFail($id);
        return view('pages.resident.add', compact('residents', 'residentFind'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nik' => 'required',
            'name' => 'required|max:100',
            'gender' => 'required',
            'birth_date' => 'required|string',
            'birth_place' => 'required|max:100',
            'address' => 'required|max:700',
            'religion' => 'nullable|max:50',
            'marital_status' => 'required',
            'occupation' => 'nullable|max:100',
            'phone' => 'nullable|max:15',
            'status' => 'required',
        ]);
        Resident::where('id', $id)->update($validatedData);
        return redirect('/resident')->with('success', 'update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $residentFind = Resident::findOrFail($id);
        $residentFind->delete();
        return redirect('/resident')->with('success', 'deleted successfully');
    }
}
