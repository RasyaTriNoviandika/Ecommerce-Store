# Setup Ecommerce Store dengan MySQL Laragon

## Persyaratan
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL (via Laragon)
- Node.js & NPM

## Langkah-langkah Setup

### 1. Setup Database MySQL di Laragon

1. Buka Laragon
2. Pastikan MySQL sudah berjalan (klik "Start All" jika belum)
3. Buka phpMyAdmin atau HeidiSQL untuk membuat database baru
4. Buat database baru dengan nama: `ecommerce_store`

### 2. Konfigurasi Environment

1. Copy file `.env.example` menjadi `.env` (jika belum ada, buat file `.env` baru)
2. Atau buat file `.env` di root project dengan konfigurasi berikut:

```env
APP_NAME="Ecommerce Store"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_store
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

3. Generate application key:
```bash
php artisan key:generate
```

### 3. Install Dependencies

```bash
composer install
npm install
```

### 4. Run Migrations & Seeders

```bash
php artisan migrate
php artisan db:seed
```

Ini akan membuat semua tabel dan mengisi data sample (categories dan products).

### 5. Setup Storage Link (untuk gambar produk)

```bash
php artisan storage:link
```

### 6. Build Assets

```bash
npm run build
```

Atau untuk development dengan hot reload:
```bash
npm run dev
```

### 7. Jalankan Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Data Test

Setelah menjalankan seeder, Anda akan mendapatkan:

### User Test
- Email: `test@example.com`
- Password: `password`

### Categories
- Electronics
- Clothing
- Books
- Home & Garden
- Sports
- Toys

### Products
10 produk sample yang sudah terhubung dengan kategori

## Fitur Aplikasi

✅ Home page dengan daftar produk
✅ Filter produk berdasarkan kategori
✅ Search produk
✅ Detail produk
✅ Shopping cart (session-based)
✅ Checkout (requires authentication)
✅ Login & Register
✅ Order management

## Catatan

- Cart menggunakan session storage, jadi data cart akan hilang jika session expired
- Upload gambar produk belum diimplementasikan, tapi struktur sudah siap
- Pastikan folder `storage/app/public` memiliki permission yang tepat untuk upload file

## Troubleshooting

### Error: SQLSTATE[HY000] [2002] Connection refused
- Pastikan MySQL di Laragon sudah running
- Cek konfigurasi DB_HOST di .env (gunakan 127.0.0.1)

### Error: Access denied for user
- Cek username dan password MySQL di .env
- Default Laragon biasanya username: root, password: (kosong)

### Error: Database doesn't exist
- Pastikan database `ecommerce_store` sudah dibuat di MySQL

### Tailwind CSS tidak muncul
- Jalankan `npm run build` atau `npm run dev`
- Pastikan Vite sudah running

