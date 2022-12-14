<?php

namespace App\Http\Controllers;

use App\Models\jenis_kontak;
use Illuminate\Http\Request;
use App\Models\kontak;
use App\Models\siswa;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = siswa::all();
        $kontaks = kontak::with('siswa')->get();
        return view('admin.MasterKontak', compact('kontaks', 'siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_siswa = request()->query('siswa');
        $siswas = siswa::find($id_siswa);
        $kontaks = jenis_kontak::all();
        return view('admin.TambahKontak', compact('siswas','kontaks'));
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
            'id_siswa' => 'required',
            'id_jenis' => 'required',
            'deskripsi' => 'required|max:255'
        ]);
        
        kontak::create($validatedData);
        return redirect('/masterkontak')->with('success', 'Berhasil Menambahkan Kontak');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontaks = siswa::find($id)->kontak;
        return view('admin.ShowKontak', compact('kontaks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        kontak::find($id);
        $kontaks = kontak::where('id', $id)->firstorfail();
        return view('admin.EditKontak', compact('kontaks'));
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
        $validatedData = $request->validate([
            'deskripsi' => 'required'
        ]);

        kontak::where('id', $id)
        ->update($validatedData);

        return redirect('/masterkontak')->with('success', 'Berhasil Mengubah Kontak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kontak::find($id)->delete();
        return redirect('/masterkontak')->with('success', 'Berhasil Menghapus Kontak');
    }
}