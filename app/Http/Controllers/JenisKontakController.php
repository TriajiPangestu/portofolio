<?php

namespace App\Http\Controllers;

use App\Models\jenis_kontak;
use Illuminate\Http\Request;

class JenisKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = jenis_kontak::all();
        return view('admin.TambahJenisKontak', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_kontak' => 'required|max:255'
        ],[
            'jenis_kontak.required' => 'Jenis Kontak Wajib diisi',
            'jenis_kontak.max' => 'Maksimal 255 Huruf'
        ]);

        jenis_kontak::create($validatedData);
        return redirect('/jeniskontak')->with('success', 'Berhasil Menambah Jenis Kontak');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jenis_kontak::find($id)->delete();
        
        return redirect('/jeniskontak')->with('success', 'Berhasil Menghapus Jenis Kontak');
    }
}