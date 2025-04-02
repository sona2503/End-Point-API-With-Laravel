<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toko;
use Illuminate\Support\Facades\DB; 

class TokoController extends Controller
{

    public function index()
    {
        // Mengambil data
        return response()->json([
            'Toko' => Toko::get()  
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        // Simpan data menggunakan model Toko
        $toko = Toko::create([
            'nama' => $validatedData['nama'],
            'jumlah' => $validatedData['jumlah'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $toko
        ], 201);
    }
    


    public function show(string $id)
    {
        // Mengambil data Toko berdasarkan id
        $toko = Toko::find($id); 
    
        // Jika data tidak ditemukan
        if (!$toko) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    
        // Jika data ditemukan, kembalikan respons JSON
        return response()->json([
            'success' => true,
            'Toko' => $toko,
        ], 200);
    }
    
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirim dari request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);
    
        // Cari data Toko berdasarkan id
        $toko = Toko::find($id);
    
        // Jika data tidak ditemukan
        if (!$toko) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    
        // Update data toko
        $toko->nama = $validatedData['nama'];
        $toko->jumlah = $validatedData['jumlah'];
        $toko->updated_at = now(); 
        $toko->save(); 
    
        // Return response JSON setelah update berhasil
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $toko,
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data Toko berdasarkan id
        $toko = Toko::find($id);
    
        // Jika data tidak ditemukan
        if (!$toko) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    
        // Hapus data Toko
        $toko->delete();
    
        // Kembalikan respons JSON setelah data dihapus
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
    
}
