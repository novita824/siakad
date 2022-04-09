<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
 public function index()
 {
    //yang semula Mahasiswa:all, diubah menjadi with() yang menyatakan relasi
    $mahasiswa = Mahasiswa::with('kelas')->get();
    $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
    return view('mahasiswa.index', ['mahasiswa' => $mahasiswa, 'paginate' =>$paginate]);
 }
 public function create()
 {
    return view('mahasiswa.create');
 }
 public function store(Request $request)
 {
    //melakukan validasi data
    $request->validate([
    'Nim' => 'required',
    'Nama' => 'required',
    'Kelas' => 'required',
    'Jurusan' => 'required',
    'No_Handphone' => 'required',
    'TanggalLahir' => 'required',
    'Email' => 'required',
 ]);

    //fungsi eloquent untuk menambah data
    Mahasiswa::create($request->all());
    //jika data berhasil ditambahkan, akan kembali ke halaman utama
    return redirect()->route('mahasiswa.index')
    ->with('success', 'Mahasiswa Berhasil Ditambahkan');
 }
 
 public function cari(Request $request)
 {
   $search = Mahasiswa::where('Nim','like',"%".$request->search."%")->paginate(5);
   return view('mahasiswa.index',['Mahasisw'=>$search]);
 }

 public function show($Nim)
 {
    //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
    $Mahasiswa = Mahasiswa::find($Nim);
    return view('mahasiswa.detail', compact('Mahasiswa'));
 }
 public function edit($Nim)
 {
    //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
    $Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();;
    return view('mahasiswa.edit', compact('Mahasiswa'));
 }
    public function update(Request $request, $Nim)
 {
    //melakukan validasi data
    $request->validate([
    'Nim' => 'required',
    'Nama' => 'required',
    'Kelas' => 'required',
    'Jurusan' => 'required',
    'No_Handphone' => 'required',
    'TanggalLahir' => 'required',
    'Email' => 'required',
 ]);
    //fungsi eloquent untuk mengupdate data inputan kita
    Mahasiswa::find($Nim)->update($request->all());
    //jika data berhasil diupdate, akan kembali ke halaman utama
    return redirect()->route('mahasiswa.index')
    ->with('success', 'Mahasiswa Berhasil Diupdate');
 }
 public function destroy( $Nim)
 {
    //fungsi eloquent untuk menghapus data
    Mahasiswa::find($Nim)->delete();
    return redirect()->route('mahasiswa.index')
    -> with('success', 'Mahasiswa Berhasil Dihapus');
 }
};