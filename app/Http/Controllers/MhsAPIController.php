<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MhsAPIController extends Controller
{
    public function read()
    {
        $mhs = Mahasiswa::all();
        return response()->json([
            'success' => true,
            'message' => 'HOKI ANDA DIPAKAI UNTUK KESUKSESAN',
            'data' => $mhs
        ], 200);
    }

    public function create(Request $request)
    {
        $mhs = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'prodi' => $request->prodi,
            'minat' => $request->minat

        ]);

        if ($mhs) {
            return response()->json([
                'success' => true,
                'message' => 'HOKI ANDA DIPAKAI UNTUK KESUKSESAN',
                'data' => $mhs
            ], 200, );
        }else{
            return response()->json([
                'success' => false,
                'message' => 'HOKI ANDA SUDAH HABIS , COBA LAGI',
                'data' => $mhs
            ], 400, );
        }
    }

    public function update($id , Request $request){
        $mhs = Mahasiswa::find($id)->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'gender' => $request->gender,
            'prodi' => $request->prodi,
            'minat' => $request->minat
        ]);

        if ($mhs) {
            return response()->json([
                'success' => true,
                'message' => 'HOKI ANDA DIPAKAI UNTUK MENGUBAH'
            ], 200, );
        }else{
            return response()->json([
                'success' => false,
                'message' => 'HOKI ANDA HABIS , COBA UBAH LAGI'
            ], 400, );
        }
    }

    public function delete($id){
        $mhs = Mahasiswa::find($id)->delete();

        if ($mhs) {
            return response()->json([
                'success' => true,
                'message' => 'HOKI ANDA DIPAKAI UNTUK MENGHAPUS'
            ], 200, );
        }else{
            return response()->json([
                'success' => false,
                'message' => 'HOKI ANDA HABIS , COBA HAPUS LAGI'
            ], 400, );
        }
    }
}