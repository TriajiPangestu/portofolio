<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\project;
use App\Models\siswa;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = siswa::all();
        $projects = project::with('siswa')->get();
        return view('admin.MasterProject', compact('projects', 'siswas'));
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
        return view('admin.TambahProject', compact('siswas'));
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
            'nama_project' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'foto' => 'image|mimes:jpg,png,jpeg,svg',
            'tanggal' => 'required'
        ],[
            'nama_project.required' => 'Nama Project Wajib Diisi',
            'nama_project.max' => 'Maksimal 255 Huruf',
            'deskripsi.required' => 'Deskripsi Project Wajib Diisi',
            'deskripsi.max' => 'Makimal 255 Huruf',
            'foto.image' => 'Foto Harus Berupa Gambar',
            'foto.mimes' => 'Format Yang Diperbolehkan jpg, png, jpeg, svg',
        ]);

        // ambil info file yang diupload
        $file = $request->file('foto');
        // rename + ambil nama file
        $nama_file = time()."_".$file->getClientOriginalName();
        // proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);
        // Proses insert database
        project::create([
            'id_siswa' => $request->id_siswa,
            'nama_project'=> $request->nama_project,
            'deskripsi'=> $request->deskripsi,
            'tanggal'=> $request->tanggal,
            'foto' => $nama_file,            
        ]);
        return redirect('/masterproject');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeks = siswa::find($id)->projeks;
        return view('admin.ShowProject', compact('projeks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        project::find($id);
        $siswas = siswa::all();
        $projects = project::where('id',$id)->firstorfail();
        return view('admin.EditProject', compact('projects'), compact('siswas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $masterproject)
    {

        $validatedData = $request->validate([
            'id_siswa' => 'required',
            'nama_project' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'foto' => 'image|mimes:jpg,png,jpeg,svg',
            'tanggal' => 'required',
        ],[
            'nama_project.required' => 'Nama Project Wajib Diisi',
            'nama_project.max' => 'Maksimal 255 Huruf',
            'deskripsi.required' => 'Deskripsi Project Wajib Diisi',
            'deskripsi.max' => 'Makimal 255 Huruf',
            'foto.image' => 'Foto Harus Berupa Gambar',
            'foto.mimes' => 'Format Yang Diperbolehkan jpg, png, jpeg, svg',
        ]);
    
        if($request->foto !=''){
            // Dengan ganti foto

            //1. hapus foto lama
            file::delete('./template/img/'.$projects->foto);

            //2. ambil info file yang diupload
            $file = $request->file('foto');

            //3. rename + ambil nama file
            $nama_file = time()."_".$file->getClientOriginalName();

            //4. proses upload
            $tujuan_upload = './template/img';
            $file->move($tujuan_upload, $nama_file);

            //5. Menyimpan ke database
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->foto = $nama_file;
            $siswa->save();
            return redirect ('/masterproject')->with('success', 'Berhasil Mengubah Data');

        } else {
            // Tanpa ganti foto
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->save();
            return redirect ('/masterproject')->with('success', 'Berhasil Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projects = project::where('id', $id)->firstorfail();
        if($request->foto !=''){
            $old_foto = public_path('./template/img/' . $projects->foto);
            if(file_exists($old_foto)) unlink($old_foto);
        }

        $projects=project::find($id)
            ->delete();
            
        return redirect('/masterproject')->with('error', 'Berhasil Menghapus Data !');
    }
}