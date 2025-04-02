# Cara Install Project API

## Persyaratan
- Pastikan **Composer** sudah terinstall di sistem.
- Pastikan **Database mysql atau sejenisnya** sudah terinstall di sistem.

## Langkah-langkah Instalasi
1. **Download code** dari repository ini.
2. **Install dependencies** dengan menjalankan perintah:
   ```sh
   composer install
3. **import database**
4. **Jalankan server** dengan menjalankan perintah:
   ```sh
   php artisan serve

## Langkah-langkah menguji dengan Aplikasi Client API
1. **Tambah User baru** dengan Url ini:
   ```sh
   http://127.0.0.1:8000/api/register
2. **Untuk menambah data tambahkan code** sebagai berikut dengan menggunakan Url di point 1:
   ```sh
   {"nama": "ex name",
    "usia": "ex age",
    "alamat": "ex addres"} 
3. **Lakukan edit, hapus, dan lihat berdasarkan ID** dengan URL berikut:
   ```sh
   http://localhost:3000/api/employees/{Id}

 
