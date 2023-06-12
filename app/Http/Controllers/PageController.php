<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class PageController extends Controller
{
    public function home(){
        return view('home' , ['key' => 'home'] );
    }

    public function profile(){
        return view('profile', ['key' => 'profile']);
    }

    public function mahasiswa(){
        $mhs = Mahasiswa::orderBy('id' , 'desc')->paginate(10);
        return view('mahasiswa', ['key' => 'mahasiswa' , 'mhs' => $mhs]);
    }

    public function pencarian(Request $req){
        $cari = $req->q;
        $mhs = Mahasiswa::where('nama', 'like' , '%'.$cari.'%')->paginate(10);
        $mhs->appends($req -> all());
        return view('mahasiswa' , ['key' => 'mahasiswa' , 'mhs'=> $mhs]);
        //return redirect()->back();
    }

    public function tambah(){
        return view('formtambah' , ['key' => 'mahasiswa']);
    }

    public function simpan(Request $req){
        $minat = implode(',' , $req->get('minat'));
        Mahasiswa::create([
            'nim' => $req -> nim,
            'nama' => $req -> nama,
            'gender' => $req -> gender,
            'prodi' => $req -> prodi,
            'minat' => $minat
        ]);
        return redirect('mahasiswa')->with('flash','Hoki Kesimpan');
    }

    public function edit($id){
        $mhs = Mahasiswa::find($id);
        return view('formedit' , ['key'=>'mahasiswa' ,'mhs' => $mhs]);
    }

    public function update($id , Request $req){
        $minat = implode(',' , $req->get('minat'));
        $mhs = Mahasiswa::find($id);
        $mhs -> nim = $req -> nim;
        $mhs -> nama = $req -> nama;
        $mhs -> gender = $req -> gender;
        $mhs -> prodi = $req -> prodi;
        $mhs -> minat = $minat;
        $mhs -> save();

        return redirect('mahasiswa')->with('flash','Sip Berubah');
    }

    public function delete($id){
        $mhs = Mahasiswa::find($id);
        $mhs -> delete();
        return redirect('mahasiswa')->with('flash','Sip Kehapus');
    }

    public function contact(){
        return view('contact' , ['key' => 'contact']);
    }
}