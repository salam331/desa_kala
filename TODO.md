# TODO: Update Admin Page for Profil Desa Management

## 1. Create Model and Migration for ProfilDesa
- Create migration for profil_desa table with fields: sejarah_desa, visi, misi, data_wilayah (json), peta_embed, created_at, updated_at
- Create ProfilDesa model with fillable fields and casts

## 2. Create Model and Migration for StrukturPemerintahan
- Create migration for struktur_pemerintahan table with fields: nama, jabatan, foto, urutan, is_active, created_at, updated_at
- Create StrukturPemerintahan model with fillable fields and casts

## 3. Update AdminController
- Add methods: editProfilDesa, updateProfilDesa
- Add CRUD methods for StrukturPemerintahan: indexStruktur, createStruktur, storeStruktur, editStruktur, updateStruktur, destroyStruktur

## 4. Add Routes
- Add routes for profil-desa edit and struktur-pemerintahan CRUD in web.php

## 5. Create Views
- Create resources/views/admin/profil-desa/edit.blade.php
- Create resources/views/admin/struktur-pemerintahan/index.blade.php, create.blade.php, edit.blade.php

## 6. Update Profil Desa Public Page
- Modify resources/views/profil-desa.blade.php to fetch data from database instead of static content
- Add support for map with coordinates

## 7. Update Admin Dashboard
- Add quick actions for managing profil desa and struktur pemerintahan

## 8. Seed Initial Data
- Create seeders for ProfilDesa and StrukturPemerintahan with sample data
