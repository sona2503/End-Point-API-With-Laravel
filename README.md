# Store API (Laravel)

REST API for managing stores, products, and transactions. Authentication uses Laravel Sanctum (Bearer Token).

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL (or a compatible database)

## Installation

1. Clone or download this repository, then open the project folder:

   ```sh
   git clone <repository-url>
   cd <project-folder>
   ```

2. Install dependencies:

   ```sh
   composer install
   ```

3. Create the environment file and generate the app key:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. Create an empty database, then set the connection in `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Create the tables:

   ```sh
   php artisan migrate
   ```

   If you prefer to import a `.sql` file instead, import it into your database and skip this step.

6. Start the server:

   ```sh
   php artisan serve
   ```

   The API is available at `http://127.0.0.1:8000/api`.

## Testing with an API Client (Postman)

For every request, set these headers:

```
Accept: application/json
Content-Type: application/json
```

### 1. Register a user

`POST http://127.0.0.1:8000/api/register`

```json
{
  "name": "userexample",
  "email": "user@example.com",
  "password": "password1234",
  "password_confirmation": "password1234"
}
```

### 2. Log in

`POST http://127.0.0.1:8000/api/login`

```json
{
  "email": "user@example.com",
  "password": "password1234"
}
```

Copy the token from the response. For all requests below, open the **Authorization** tab, choose **Bearer Token**, and paste the token.

## API Endpoints

All endpoints below require a Bearer Token.

| Resource    | Method | URL                        | Description             |
|-------------|--------|----------------------------|-------------------------|
| Store       | GET    | `/api/toko/index`          | Get all stores          |
| Store       | POST   | `/api/toko/store`          | Create a store          |
| Store       | GET    | `/api/toko/show/{id}`      | Get a store by ID       |
| Store       | PUT    | `/api/toko/update/{id}`    | Update a store          |
| Store       | DELETE | `/api/toko/delete/{id}`    | Delete a store          |
| Product     | GET    | `/api/produk/index`        | Get all products        |
| Product     | POST   | `/api/produk/store`        | Create a product        |
| Product     | GET    | `/api/produk/show/{id}`    | Get a product by ID     |
| Product     | PUT    | `/api/produk/update/{id}`  | Update a product        |
| Product     | DELETE | `/api/produk/delete/{id}`  | Delete a product        |
| Transaction | GET    | `/api/transaksi/index`     | Get all transactions    |
| Transaction | POST   | `/api/transaksi/store`     | Create a transaction    |
| Transaction | GET    | `/api/transaksi/show/{id}` | Get transaction details |
| Transaction | DELETE | `/api/transaksi/delete/{id}` | Delete a transaction  |

Transactions cannot be updated.

## Request Body Examples

### Create a store

`POST /api/toko/store`

```json
{
  "nama": "Toko Berkah",
  "alamat": "Jl. Malioboro No. 10, Yogyakarta",
  "email": "berkah@example.com",
  "no_telepon": "081234567890",
  "status": "aktif"
}
```

### Create a product

`POST /api/produk/store`

```json
{
  "toko_id": 1,
  "kode_produk": "PRD-001",
  "nama": "Beras 5kg",
  "deskripsi": "Premium rice",
  "harga": 65000,
  "stok": 50,
  "jenis": "sembako"
}
```

Allowed values for `jenis`: `sembako`, `elektronik`, `alat mandi`, `sayur`, `buah`, `snack`, `minuman`.

### Create a transaction

`POST /api/transaksi/store`

```json
{
  "toko_id": 1,
  "metode_pembayaran": "tunai",
  "bayar": 150000,
  "catatan": "Optional note",
  "items": [
    { "produk_id": 1, "jumlah": 2 },
    { "produk_id": 2, "jumlah": 3 }
  ]
}
```

Allowed values for `metode_pembayaran`: `tunai`, `transfer`, `qris`.

### Transaction list filters (optional)

```
GET /api/transaksi/index?toko_id=1&tanggal_dari=2026-09-01&tanggal_sampai=2026-09-30&per_page=10
```

## Transaction Rules

- Prices and totals are calculated by the server. The client only sends product IDs and quantities.
- A transaction fails if stock is not enough or the payment is less than the total.
- Creating a transaction reduces product stock.
- Deleting a transaction returns the stock.
- A user can only access transactions from their own stores.

## Troubleshooting

- **Validation errors return a redirect instead of JSON:** add the header `Accept: application/json`.
- **401 Unauthenticated:** the Bearer Token is missing or invalid. Log in again.
- **500 error:** check `storage/logs/laravel.log`.