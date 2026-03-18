Oke, stack-nya **Laragon + Laravel + MySQL**. Berikut implementation plan lengkapnya:

---

# 📋 Implementation Plan: Aplikasi Sekretaris Zakat Fitrah
**Stack: Laragon · Laravel · MySQL · Blade + Tailwind CDN**

---

## Phase 1 — Project Setup

```
1. Buka Laragon → Start All
2. Buka terminal Laragon:
   composer create-project laravel/laravel zakat-fitrah
3. Buka phpMyAdmin → buat database: zakat_fitrah
4. Edit .env:
   DB_DATABASE=zakat_fitrah
   DB_USERNAME=root
   DB_PASSWORD=        ← (kosong, default Laragon)
5. php artisan key:generate
```

---

## Phase 2 — Database Migration

Buat 2 migration:

**`wajib_zakat`** — pemberi zakat
```php
Schema::create('wajib_zakat', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kk');
    $table->string('rt');               // '13' atau '14'
    $table->unsignedTinyInteger('jumlah_jiwa')->default(0);
    $table->decimal('zakat_liter', 8, 2)->default(0);
    $table->decimal('zakat_kg', 8, 2)->default(0);
    $table->decimal('konv_kg', 8, 2)->default(0);  // liter × 0.72
    $table->decimal('jml_kg', 8, 2)->default(0);   // total kg
    $table->boolean('sudah_bayar')->default(false);
    $table->timestamp('waktu_bayar')->nullable();
    $table->text('catatan')->nullable();
    $table->timestamps();
});
```

**`mustahiq`** — penerima zakat
```php
Schema::create('mustahiq', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->enum('kategori', ['fakir', 'miskin']);
    $table->decimal('jml_kg_diterima', 8, 2)->default(0);
    $table->boolean('sudah_terima')->default(false);
    $table->timestamp('waktu_terima')->nullable();
    $table->timestamps();
});
```

---

## Phase 3 — Seeder

Buat `WajibZakatSeeder` dan `MustahiqSeeder` dengan data langsung dari `zakat.md`:

- **34 nama** RT 13
- **37 nama** RT 14
- **13 Fakir** + **16 Miskin**

```
php artisan db:seed
```

---

## Phase 4 — Routes & Controllers

```
php artisan make:controller ZakatController
php artisan make:controller MustahiqController
php artisan make:controller RekapController
```

**`routes/web.php`**
```php
Route::get('/', [ZakatController::class, 'index']);               // dashboard

// Penerimaan
Route::get('/penerimaan', [ZakatController::class, 'index']);
Route::put('/penerimaan/{id}', [ZakatController::class, 'update']);
Route::patch('/penerimaan/{id}/bayar', [ZakatController::class, 'toggleBayar']);

// Pembagian
Route::get('/pembagian', [MustahiqController::class, 'index']);
Route::put('/pembagian/{id}', [MustahiqController::class, 'update']);
Route::patch('/pembagian/{id}/terima', [MustahiqController::class, 'toggleTerima']);

// Rekap
Route::get('/rekap', [RekapController::class, 'index']);
Route::get('/rekap/export-csv', [RekapController::class, 'exportCsv']);
```

---

## Phase 5 — UI (Blade + Tailwind CDN)

**Layout**: `layouts/app.blade.php`
- Navbar dengan 3 tab: **Penerimaan · Pembagian · Rekap**
- Mobile-friendly (pakai di HP sambil berdiri)

**Halaman Penerimaan** (`/penerimaan`)
```
[🔍 Cari nama...] [Filter: Semua | RT13 | RT14 | Belum Bayar]

Tabel:
NO | Nama KK | RT | Jiwa | Liter | KG | Status | Aksi
                                          ✅/❌    [Edit]
```
- Klik **Edit** → modal input: jumlah jiwa, liter/kg, catatan
- Auto-hitung: `konv_kg = liter × 0.72`, `jml_kg = kg + konv_kg`

**Halaman Pembagian** (`/pembagian`)
```
[🔍 Cari nama...] [Filter: Semua | Fakir | Miskin]

Tabel:
NO | Nama | Kategori | KG Diterima | Status | Aksi
```

**Halaman Rekap** (`/rekap`)
```
┌─────────────────┬──────────────────┬───────────┐
│ Total Terkumpul │ Total Dibagikan  │   Sisa    │
│    ___ kg       │     ___ kg       │  ___ kg   │
└─────────────────┴──────────────────┴───────────┘

Progress RT 13: ██████░░░░ 20/34 KK
Progress RT 14: ████░░░░░░ 15/37 KK

[🖨️ Print]  [📥 Export CSV]
```

---

## Phase 6 — Logic Penting

| Hal | Detail |
|-----|--------|
| Konversi | `1 liter = 0.72 kg` (bisa diubah di `.env` → `KONVERSI_LITER_KG=0.72`) |
| Auto-rekap | Computed di `RekapController` pakai `DB::sum()`, tidak disimpan |
| Print | `window.print()` + CSS `@media print` sembunyikan tombol |
| Export CSV | Laravel response download, looping koleksi |
| Validasi | `jumlah_jiwa` min:1, `zakat_liter/kg` min:0 |

---

## Phase 7 — Urutan Build untuk Agentic AI

Gunakan prompt bertahap ini:

```
Tahap 1:
"Buatkan migration, model, dan seeder Laravel untuk aplikasi 
zakat fitrah dengan tabel wajib_zakat dan mustahiq. 
Seed data: [paste zakat.md]. Konversi 1 liter = 0.72 kg."

Tahap 2:
"Buatkan ZakatController dengan method index (+ search & filter RT), 
update (input jiwa + liter/kg, auto-hitung konversi), 
dan toggleBayar. Gunakan Blade view."

Tahap 3:
"Buatkan MustahiqController dengan index (+ search & filter kategori) 
dan toggleTerima."

Tahap 4:
"Buatkan RekapController: hitung total terkumpul, dibagikan, sisa. 
Tambahkan exportCsv() yang download file."

Tahap 5:
"Buatkan Blade views: layouts/app.blade.php dengan navbar 3 tab, 
penerimaan/index.blade.php dengan tabel + modal edit, 
pembagian/index.blade.php, rekap/index.blade.php. 
Gunakan Tailwind CDN. Mobile-friendly."
```

---

Mau langsung aku generate kode lengkapnya sekarang (migration + seeder + controller + blade), atau pakai plan ini dulu ke agentic AI?
