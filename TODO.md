# TODO: Implementasi CRUD untuk Potensi Desa

## Status: Dalam Proses

### Langkah-langkah yang perlu dilakukan:

1. **Buat migration untuk tabel potensis**
   - File: `database/migrations/create_potensis_table.php`
   - Fields: nama, kategori, deskripsi, detail, gambar, kontak, telepon, lokasi, is_active

2. **Buat model Potensi**
   - File: `app/Models/Potensi.php`
   - Fillable fields, casts, dan scopes

3. **Buat seeder untuk data awal**
   - File: `database/seeders/PotensiSeeder.php`
   - Populate data dari dummy data yang ada

4. **Update PotensiController**
   - File: `app/Http/Controllers/PotensiController.php`
   - Ganti dari dummy data ke database

5. **Tambahkan routes admin untuk potensi**
   - File: `routes/web.php`
   - Routes CRUD untuk admin potensi

6. **Tambahkan methods CRUD di AdminController**
   - File: `app/Http/Controllers/AdminController.php`
   - Methods: potensiIndex, potensiCreate, potensiStore, potensiEdit, potensiUpdate, potensiDestroy

7. **Buat views admin untuk potensi**
   - File: `resources/views/admin/potensi/index.blade.php`
   - File: `resources/views/admin/potensi/create.blade.php`
   - File: `resources/views/admin/potensi/edit.blade.php`

8. **Buat request classes untuk validasi**
   - File: `app/Http/Requests/StorePotensiRequest.php`
   - File: `app/Http/Requests/UpdatePotensiRequest.php`

### Langkah selanjutnya:
- Jalankan migration dan seeder
- Test fungsionalitas CRUD
