# Cara Install Project API

## Persyaratan
- Pastikan **Node.js** sudah terinstal di sistem.

## Langkah-langkah Instalasi
1. **Download code** dari repository ini.
2. **Install dependencies** dengan menjalankan perintah:
   ```sh
   npm install
3. **import database**
4. **Jalankan server** dengan menjalankan perintah:
   ```sh
   node server.js run

## Langkah-langkah menguji dengan Aplikasi Client API
1. **Akses semua data yang ada di tabel** dengan Url ini:
   ```sh
   http://localhost:3000/api/employees
2. **Untuk menambah data tambahkan code** sebagai berikut dengan menggunakan Url di point 1:
   ```sh
   {"nama": "ex name",
    "usia": "ex age",
    "alamat": "ex addres"} 
3. **Lakukan edit, hapus, dan lihat berdasarkan ID** dengan URL berikut:
   ```sh
   http://localhost:3000/api/employees/{Id}

 
