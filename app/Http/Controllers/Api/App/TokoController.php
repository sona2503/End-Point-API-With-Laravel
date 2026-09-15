<?php

namespace App\Http\Controllers\Api\App;

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
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,non aktif',
        ]);

        // Simpan data menggunakan model Toko
        $toko = Toko::create($validatedData);

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $toko
        ], 201);
    }
    

    //show toko's data by id
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
        // Cari data Toko berdasarkan id
        $toko = Toko::find($id);

        // Jika data tidak ditemukan
        if (!$toko) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Validasi data yang dikirim dari request
        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'status' => 'sometimes|required|in:aktif,non aktif',
        ]);

        // Update data toko
        $toko->update($validatedData);

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
