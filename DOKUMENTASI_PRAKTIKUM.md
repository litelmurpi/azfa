# Dokumentasi Praktikum: DompetKu

## Implementasi Kategori, Search Optimization & AI Insights

**Nama Project:** DompetKu - Personal Finance App  
**Framework:** Laravel 11  
**Tanggal:** 28 Desember 2024

---

## Daftar Isi

1. [Optimasi Fitur Search](#1-optimasi-fitur-search)
2. [Implementasi Relasi Kategori](#2-implementasi-relasi-kategori)
3. [AI Insight Dinamis](#3-ai-insight-dinamis)
4. [Penjelasan Soal Praktikum](#4-penjelasan-soal-praktikum)

---

## 1. Optimasi Fitur Search

### Permasalahan Awal

-   Input search tidak terhubung dengan backend
-   Saldo dihitung dari hasil paginasi (bug)
-   Tidak ada filter berdasarkan tipe atau tanggal

### Solusi yang Diimplementasikan

#### Controller: Multi-Filter Support

```php
public function index(Request $request) {
    $search = $request->input('search');
    $kategori_id = $request->input('kategori_id');
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    $query = Transaksi::query();

    if ($search) {
        $query->where('keterangan', 'like', '%' . $search . '%');
    }
    if ($kategori_id) {
        $query->where('kategori_id', $kategori_id);
    }
    if ($tanggalMulai) {
        $query->whereDate('tanggal', '>=', $tanggalMulai);
    }
    if ($tanggalAkhir) {
        $query->whereDate('tanggal', '<=', $tanggalAkhir);
    }

    $transaksi = $query->orderBy('tanggal', 'desc')
                       ->paginate(10)
                       ->withQueryString();
}
```

#### View: Live Search dengan Debounce

```javascript
// Debounce 800ms, trigger setelah 5 karakter
searchInput.addEventListener("input", function () {
    if (this.value.length >= 5 || this.value.length === 0) {
        debounce(() => searchForm.submit(), 800)();
    }
});
```

#### Fitur yang Ditambahkan

| Fitur           | Deskripsi                                                    |
| --------------- | ------------------------------------------------------------ |
| Live Search     | Auto-submit setelah 5 karakter dengan delay 800ms            |
| Filter Kategori | Dropdown dari tabel kategoris                                |
| Filter Tanggal  | Date picker untuk rentang tanggal                            |
| Reset Filter    | Tombol untuk menghapus semua filter                          |
| Loading State   | Spinner saat submit                                          |
| Empty State     | Pesan berbeda untuk "tidak ada data" vs "tidak cocok filter" |

---

## 2. Implementasi Relasi Kategori

### Skenario

**One to Many**: Satu Kategori memiliki banyak Transaksi

```
┌─────────────────┐         ┌──────────────────┐
│    kategoris    │         │    transaksis    │
├─────────────────┤         ├──────────────────┤
│ id (PK)         │◄───────┐│ id (PK)          │
│ nama_kategori   │        ││ keterangan       │
│ deskripsi       │        └┤ kategori_id (FK) │
│ created_at      │         │ tanggal          │
│ updated_at      │         │ nominal          │
└─────────────────┘         └──────────────────┘
```

### File yang Dibuat/Dimodifikasi

#### Model Kategori

```php
// app/Models/Kategori.php
class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'kategori_id');
    }
}
```

#### Model Transaksi

```php
// app/Models/Transaksi.php
class Transaksi extends Model
{
    protected $fillable = ['keterangan', 'tanggal', 'nominal', 'kategori_id'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
```

#### Migration: Tabel Kategoris

```php
Schema::create('kategoris', function (Blueprint $table) {
    $table->id();
    $table->string('nama_kategori', 100);
    $table->text('deskripsi')->nullable();
    $table->timestamps();
});
```

#### Migration: Modifikasi Transaksis

```php
Schema::table('transaksis', function (Blueprint $table) {
    $table->dropColumn('jenis');
    $table->foreignId('kategori_id')
          ->constrained('kategoris')
          ->onDelete('cascade');
});
```

#### Seeder: KategoriSeeder

```php
Kategori::insert([
    ['nama_kategori' => 'Gaji', 'deskripsi' => 'Pemasukan dari gaji'],
    ['nama_kategori' => 'Makanan', 'deskripsi' => 'Pengeluaran untuk makanan'],
    ['nama_kategori' => 'Transportasi', 'deskripsi' => 'Biaya transportasi'],
    ['nama_kategori' => 'Hiburan', 'deskripsi' => 'Pengeluaran untuk hiburan'],
    ['nama_kategori' => 'Tagihan', 'deskripsi' => 'Pembayaran tagihan rutin'],
]);
```

### Perubahan di View

#### Dropdown Kategori (Form)

```blade
<select name="kategori_id">
    @foreach($kategoris as $kat)
        <option value="{{ $kat->id }}"
            {{ $dataTransaksi->kategori_id == $kat->id ? 'selected' : '' }}>
            {{ $kat->nama_kategori }}
        </option>
    @endforeach
</select>
```

#### Tampilkan Nama Kategori (Tabel)

```blade
{{-- Sebelum: $item->jenis --}}
{{-- Sesudah: --}}
{{ $item->kategori->nama_kategori ?? '-' }}
```

---

## 3. AI Insight Dinamis

### Data yang Dihitung

| Variabel         | Rumus                                          |
| ---------------- | ---------------------------------------------- |
| Top Kategori     | Kategori dengan pengeluaran terbesar bulan ini |
| Top Percentage   | (Top Amount / Total Pengeluaran) × 100%        |
| Perbandingan     | Selisih pengeluaran bulan ini vs bulan lalu    |
| Potential Saving | Top Amount × 20%                               |

### Implementasi Controller

```php
// Pengeluaran per kategori bulan ini
$pengeluaranPerKategori = [];
foreach (['Makanan', 'Transportasi', 'Hiburan', 'Tagihan'] as $kat) {
    $total = Transaksi::whereHas('kategori', fn($q) => $q->where('nama_kategori', $kat))
        ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
        ->sum('nominal');
    $pengeluaranPerKategori[$kat] = $total;
}

// Cari kategori terbesar
$topKategori = array_keys($pengeluaranPerKategori, max($pengeluaranPerKategori))[0];
$topPercentage = round(($topAmount / $totalPengeluaran) * 100);

$insight = [
    'topKategori' => $topKategori,
    'topPercentage' => $topPercentage,
    'isIncrease' => $selisih > 0,
    'persentasePerubahan' => $persentasePerubahan,
    'potentialSaving' => round($topAmount * 0.2),
];
```

### Tampilan View

```blade
@if($insight['isIncrease'])
    Pengeluaran Anda <span class="text-accent">meningkat {{ $insight['persentasePerubahan'] }}%</span>
@else
    Pengeluaran Anda <span class="text-emerald-600">turun {{ $insight['persentasePerubahan'] }}%</span> 🎉
@endif

Porsi terbesar: {{ $insight['topKategori'] }} ({{ $insight['topPercentage'] }}%)

💡 Hemat hingga Rp{{ number_format($insight['potentialSaving']) }} bulan depan
```

---

## 4. Penjelasan Soal Praktikum

### Soal 1: CRUD (Edit & Delete)

| Komponen    | Sintaks                      | Fungsi                         |
| ----------- | ---------------------------- | ------------------------------ |
| Route Edit  | `Route::get('/edit/{id}')`   | URL dengan parameter ID        |
| findOrFail  | `Transaksi::findOrFail($id)` | Cari by ID, 404 jika tidak ada |
| Form Method | `@method('PUT')`             | Spoof HTTP PUT                 |
| CSRF Token  | `@csrf`                      | Keamanan anti CSRF attack      |
| Delete      | `$model->delete()`           | Hapus record                   |

---

### Soal 2: Search & Pagination

| Komponen       | Sintaks                        | Fungsi                              |
| -------------- | ------------------------------ | ----------------------------------- |
| Get Input      | `$request->input('search')`    | Ambil dari query string             |
| Like Query     | `where('col', 'like', '%..%')` | Partial match search                |
| Pagination     | `->paginate(10)`               | 10 item per halaman                 |
| Preserve Query | `->withQueryString()`          | Pertahankan filter saat pindah page |
| Render Links   | `{{ $data->links() }}`         | Tombol navigasi halaman             |

---

### Soal 3: Relasi One to Many

| Komponen           | Sintaks                        | Fungsi                   |
| ------------------ | ------------------------------ | ------------------------ |
| Parent Relation    | `hasMany(Child::class)`        | Satu punya banyak        |
| Child Relation     | `belongsTo(Parent::class)`     | Milik satu parent        |
| Foreign Key        | `foreignId()->constrained()`   | FK dengan constraint     |
| Access Relation    | `$item->kategori->nama`        | Akses via relasi         |
| Filter by Relation | `whereHas('relasi', callback)` | Query berdasarkan relasi |

---

### Soal 4: Chart.js Integration

| Komponen   | Sintaks                          | Fungsi                   |
| ---------- | -------------------------------- | ------------------------ |
| Sum Query  | `->sum('nominal')`               | Total nilai kolom        |
| Date Range | `whereBetween('tanggal', [...])` | Filter by range          |
| PHP to JS  | `@json($variable)`               | Convert PHP → JavaScript |
| Chart Init | `new Chart(ctx, config)`         | Inisialisasi chart       |

---

## 5. Fitur Tambahan

### Sidebar Active State

```blade
<a class="{{ request()->is('laporan*') ? 'bg-ink text-paper' : 'text-muted' }}">
    Laporan
</a>
```

### Format Tanggal Indonesia

```blade
{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
{{-- Output: Sabtu, 28 Desember 2024 --}}
```

### Dummy Data Realistis

20 transaksi dengan:

-   Gaji bulanan (Rp8.5jt)
-   Makanan (kopi, groceries, makan luar)
-   Transportasi (Grab, bensin, parkir)
-   Hiburan (Netflix, Spotify, bioskop)
-   Tagihan (listrik, WiFi, PDAM)

---

## Command Reference

```bash
# Fresh migration dengan seeder
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve

# Buat model + migration
php artisan make:model NamaModel -m

# Buat seeder
php artisan make:seeder NamaSeeder
```

---
```
graph TD
    subgraph ESP32
        VCC[Pin 3.3V atau 5V]
        D4[Pin D4 / GPIO 4]
    end

    subgraph SENSOR_DS18B20
        Red[Kabel Merah]
        Yellow[Kabel Kuning]
    end

    Resistor[RESISTOR 4.7k Ohm]

    VCC ---|Jalur Daya Positif| Red
    D4 ---|Jalur Data| Yellow

    %% Inilah "Jembatan" Resistornya
    Red -.->|Kaki 1 Resistor Nempel Disini| Resistor
    Resistor -.->|Kaki 2 Resistor Nempel Disini| Yellow

    style Resistor fill:#f9f,stroke:#333,stroke-width:2px,color:black
    style VCC fill:#ffcccc,stroke:red
    style Red fill:#ffcccc,stroke:red
    style D4 fill:#ffffcc,stroke:#e6e600
    style Yellow fill:#ffffcc,stroke:#e6e600
```

## Struktur File yang Dimodifikasi

```
dompetku/
├── app/
│   ├── Http/Controllers/
│   │   └── TransaksiController.php    ✅ Updated
│   └── Models/
│       ├── Kategori.php               ✅ Created
│       └── Transaksi.php              ✅ Updated
├── database/
│   ├── migrations/
│   │   ├── create_kategoris_table     ✅ Created
│   │   └── add_kategori_id_to_transaksis ✅ Created
│   └── seeders/
│       ├── DatabaseSeeder.php         ✅ Updated
│       ├── KategoriSeeder.php         ✅ Created
│       └── TransaksiSeeder.php        ✅ Updated
└── resources/views/
    ├── layout/
    │   └── master.blade.php           ✅ Updated (sidebar, @stack)
    └── transaksi/
        ├── index.blade.php            ✅ Updated (search, filter, table)
        ├── create.blade.php           ✅ Updated (dropdown kategori)
        ├── edit.blade.php             ✅ Updated (dropdown kategori)
        ├── details.blade.php          ✅ Updated (nama kategori)
        └── laporan.blade.php          ✅ Updated (AI insight)
```

---

**Dibuat oleh:** Antigravity AI  
**Tanggal pembuatan:** 28 Desember 2024

