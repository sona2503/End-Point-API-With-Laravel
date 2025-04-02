# Cara Install Project API

## Persyaratan
- Pastikan **Composer** sudah terinstall di sistem.
- Pastikan **Database mysql atau sejenisnya** sudah terinstall di sistem.

## Langkah-langkah Instalasi
1. **Download code** dari repository ini.
2. **Install dependencies** dengan menjalankan perintah:
   ```sh
   composer install
3. **Import database**
4. **Jalankan server** dengan menjalankan perintah:
   ```sh
   php artisan serve

## Langkah-langkah menguji dengan Aplikasi Client API
1. **Tambah User baru** dengan Url ini:
   ```sh
   http://127.0.0.1:8000/api/register
2. **Untuk Menambah data gunakan struktur data** sebagai berikut dengan menggunakan Url di point 1:
   ```sh
   {
      "name": "userexample",
      "email": "user@example1.com",
      "password": "password1234",
      "password_confirmation": "password1234"
    } 
3. **Login dengan menggunakan email dan password** dengan URL berikut:
   ```sh
   http://127.0.0.1:8000/api/login
4. **Setelah mendapatkan token** tambahkan ke bagian auth menggunkan Bearer Token untuk menampilkan data, tambah data, edit data dan hapus data.
5. **Menambah data gunakan** url sebagai berikut:
   ```sh
   http://127.0.0.1:8000/api/store
6. **Menambah data gunakan struktur data** sebagai berikut:
   ```sh
   {
	"nama" : "Mobil",
	"jumlah" : 12
   }
7. **Menampilkan semua data gunakan** url sebagai berikut:
   ```sh
   http://127.0.0.1:8000/api/index
8. **Menampilkan data sesuai Id gunakan** url sebagai berikut:
   ```sh
   http://127.0.0.1:8000/api/show/id
9. **Mengedit data berdasarkan Id gunakan** url sebagai berikut:
    ```sh
    http://127.0.0.1:8000/api/update/id
10. **Menghapus data berdasarkan Id gunakan** url sebagai berikut:
    ```sh
    http://127.0.0.1:8000/api/delete/id



 
