# Panduan Asisten Praktikum: Pertemuan 1 & 2
## Sistem Manajemen Basis Data Lanjut (SI167)
### Program Studi Sistem Informasi - Universitas AMIKOM Yogyakarta

Panduan ini disusun sebagai rujukan teknis dan instruksional bagi Asisten Praktikum (Asprak) dalam mendampingi mahasiswa pada dua pertemuan awal semester.

---

## 1. Ikhtisar Pembelajaran

| Pertemuan | Pokok Bahasan | Sub-CPMK Terkait | Metode Evaluasi | Bobot |
| :--- | :--- | :--- | :--- | :---: |
| **Pertemuan 1** | Konsep Tipe Database & Siklus Hidup Aplikasi Basis Data | Sub-CPMK01, Sub-CPMK02 | Kuis dan Tanya Jawab | 2% |
| **Pertemuan 2** | Implementasi Perancangan, DDL, DML, dan Constraints | Sub-CPMK03 | Latihan Praktikum | 5% |

---

## 2. Materi Pertemuan 1: Konsep & Siklus Hidup Basis Data

Pertemuan pertama berfokus pada fondasi teoritis dan pemahaman alur rekayasa basis data sebelum mahasiswa mulai menulis kode SQL di laboratorium.

### 2.1. Klasifikasi Basis Data

Asprak perlu menjelaskan alasan pemilihan tipe basis data berdasarkan karakteristik beban kerja data:

#### A. Relational Database Management System (RDBMS)
* **Karakteristik**: Menyimpan data dalam format tabel dua dimensi (baris dan kolom), menerapkan skema kaku (*strict schema*), dan mematuhi prinsip ACID (*Atomicity, Consistency, Isolation, Durability*).
* **Contoh Engine**: MySQL, MariaDB, PostgreSQL, Oracle, Microsoft SQL Server.
* **Penggunaan**: Transaksi keuangan, sistem kasir (POS), Enterprise Resource Planning (ERP), dan sistem akademik.

#### B. Non-Relational Database (NoSQL)
* **Document Store**: Menyimpan data dalam format JSON/BSON dengan skema fleksibel. Contoh: MongoDB, CouchDB. Cocok untuk katalog produk e-commerce dan manajemen konten.
* **Key-Value Store**: Menyimpan pasangan kunci dan nilai langsung di memori (*in-memory*). Contoh: Redis, Memcached. Cocok untuk session login, caching, dan antrean pesan.
* **Column-Family**: Menyimpan data per kolom untuk agregasi data berskala sangat besar. Contoh: Apache Cassandra, ScyllaDB. Cocok untuk time-series data dan analitik IoT.
* **Graph Database**: Berfokus pada simpul (*nodes*) dan relasi (*edges*). Contoh: Neo4j. Cocok untuk pemetaan jejaring sosial dan sistem deteksi penipuan perbankan.

#### C. Karakteristik Beban Kerja: OLTP vs OLAP
* **OLTP (Online Transaction Processing)**: Berfokus pada kecepatan transaksi harian (baca dan tulis baris tunggal secara cepat). Normalisasi tinggi (3NF). Contoh: database operasional penjualan.
* **OLAP (Online Analytical Processing)**: Berfokus pada query analitik kompleks untuk membaca jutaan data histori. Menggunakan skema denormalisasi (*Star Schema* / *Snowflake Schema*). Contoh: Data Warehouse.

---

### 2.2. Arsitektur Aplikasi Basis Data

1. **Single-Tier**: Aplikasi UI, logika pemrosesan, dan database berada di satu komputer lokal yang sama. Contoh: Microsoft Access, SQLite lokal.
2. **Two-Tier (Client-Server)**: Aplikasi antarmuka langsung menghubungi database server melalui jaringan lokal via driver ODBC/JDBC.
3. **Three-Tier / N-Tier**:
   * *Presentation Tier*: Web frontend, aplikasi mobile, atau desktop client.
   * *Application Logic Tier*: Backend API (Node.js, PHP, Python, Java) yang memproses aturan bisnis.
   * *Database Tier*: Server MySQL/MariaDB yang mengelola penyimpanan dan integritas data.

---

### 2.3. Siklus Hidup Aplikasi Basis Data (Database Life Cycle - DBLC)

DBLC mencakup seluruh siklus hidup sistem basis data dari tahap perencanaan hingga pemeliharaan berkala:

1. **Database Planning (Perencanaan)**: Menentukan tujuan, batasan anggaran, kebutuhan hardware, dan standar pengembangan.
2. **System Definition (Definisi Sistem)**: Menetapkan ruang lingkup sistem, antarmuka pengguna, dan batas batasan aplikasi.
3. **Requirements Collection & Analysis (Analisis Kebutuhan)**: Mengumpulkan data operasional melalui wawancara dan observasi alur dokumen bisnis.
4. **Database Design (Perancangan Basis Data)**:
   * *Conceptual Design*: Pembuatan Entity Relationship Diagram (ERD) tanpa bergantung pada software DBMS tertentu.
   * *Logical Design*: Normalisasi (1NF, 2NF, 3NF), eliminasi anomali, penentuan Primary Key dan Foreign Key.
   * *Physical Design*: Penentuan struktur tabel nyata di DBMS, tipe data kolom, indeks, dan batasan integritas fisik.
5. **DBMS Selection (Pemilihan DBMS)**: Evaluasi kebutuhan teknis dan lisensi untuk memilih DBMS yang sesuai (misalnya memilih MySQL).
6. **Application Design (Desain Aplikasi)**: Merancang antarmuka transaksi dan alur logika software.
7. **Prototyping**: Membangun model kerja sistem skala kecil untuk validasi kebutuhan pengguna.
8. **Implementation (Implementasi)**: Pembuatan basis data fisik via script DDL, DML, Views, Stored Procedures, dan Triggers.
9. **Data Conversion & Loading (Migrasi Data)**: Memindahkan data dari sistem lama atau file spreadsheet ke basis data baru.
10. **Testing (Pengujian)**: Menguji integritas relasi, performa query, keamanan hak akses, dan ketahanan terhadap beban data.
11. **Operational Maintenance (Pemeliharaan)**: Backup berkala, pemulihan data (recovery), tuning performa indeks, dan penyesuaian skema saat ada kebutuhan baru.

---

### 2.4. Panduan Evaluasi Kuis & Tanya Jawab Pertemuan 1

Pertanyaan yang dapat diajukan kepada mahasiswa di akhir sesi teori:

* **Soal**: Apa konsekuensi jika tabel transaksi penjualan dirancang tanpa proses normalisasi 3NF?
  * **Jawaban**: Terjadi redundansi data (pemborosan memori) dan muncul anomali saat manipulasi data (insert anomaly, update anomaly, dan delete anomaly).
* **Soal**: Mengapa MySQL menggunakan storage engine InnoDB secara default alih-alih MyISAM?
  * **Jawaban**: InnoDB mendukung integritas relasional (Foreign Key constraints), transaksi ACID (Commit dan Rollback), serta penguncian baris (row-level locking) yang aman untuk sistem konkuren multi-user.

---

## 3. Materi Pertemuan 2: Implementasi DDL, DML, & Constraints

Pertemuan kedua adalah implementasi praktikum di laboratorium komputer. Seluruh latihan menggunakan **Studi Kasus Penjualan Retail**.

### 3.1. Skema Relasi Database Penjualan

Studi kasus terdiri dari 5 entitas yang saling berelasi:
* `kategori`: Menyimpan kelompok kategori barang.
* `pelanggan`: Menyimpan profil data pembeli.
* `barang`: Menyimpan data produk, harga, stok, dan merujuk ke `kategori`.
* `penjualan`: Header transaksi penjualan yang mencatat tanggal dan pembeli.
* `detail_penjualan`: Detail item barang yang dibeli pada setiap transaksi penjualan.

---

### 3.2. Script DDL Lengkap (Data Definition Language)

Asprak perlu mengarahkan mahasiswa untuk menulis script SQL secara berurutan dan terstruktur:

```sql
-- 1. Inisialisasi Database
CREATE DATABASE IF NOT EXISTS db_penjualan;
USE db_penjualan;

-- 2. Tabel Master: Kategori
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori INT AUTO_INCREMENT,
    nama_kategori VARCHAR(50) NOT NULL,
    CONSTRAINT pk_kategori PRIMARY KEY (id_kategori),
    CONSTRAINT uq_nama_kategori UNIQUE (nama_kategori)
) ENGINE = InnoDB;

-- 3. Tabel Master: Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan INT AUTO_INCREMENT,
    nama_pelanggan VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_pelanggan PRIMARY KEY (id_pelanggan),
    CONSTRAINT uq_pelanggan_nohp UNIQUE (no_hp)
) ENGINE = InnoDB;

-- 4. Tabel Master: Barang
CREATE TABLE IF NOT EXISTS barang (
    id_barang INT AUTO_INCREMENT,
    id_kategori INT NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    stok INT NOT NULL DEFAULT 0,
    CONSTRAINT pk_barang PRIMARY KEY (id_barang),
    CONSTRAINT chk_barang_stok CHECK (stok >= 0),
    CONSTRAINT chk_barang_harga CHECK (harga >= 0),
    CONSTRAINT fk_barang_kategori 
        FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
        ON UPDATE CASCADE 
        ON DELETE RESTRICT
) ENGINE = InnoDB;

-- 5. Tabel Transaksi Header: Penjualan
CREATE TABLE IF NOT EXISTS penjualan (
    id_penjualan VARCHAR(20),
    tgl_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_pelanggan INT NOT NULL,
    total_bayar DECIMAL(12, 2) DEFAULT 0.00,
    CONSTRAINT pk_penjualan PRIMARY KEY (id_penjualan),
    CONSTRAINT fk_penjualan_pelanggan 
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
        ON UPDATE CASCADE 
        ON DELETE RESTRICT
) ENGINE = InnoDB;

-- 6. Tabel Transaksi Detail: Detail Penjualan (Composite Primary Key)
CREATE TABLE IF NOT EXISTS detail_penjualan (
    id_penjualan VARCHAR(20) NOT NULL,
    id_barang INT NOT NULL,
    qty INT NOT NULL,
    harga_satuan DECIMAL(12, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    CONSTRAINT pk_detail_penjualan PRIMARY KEY (id_penjualan, id_barang),
    CONSTRAINT chk_detail_qty CHECK (qty > 0),
    CONSTRAINT fk_detail_penjualan_header 
        FOREIGN KEY (id_penjualan) REFERENCES penjualan(id_penjualan)
        ON UPDATE CASCADE 
        ON DELETE CASCADE,
    CONSTRAINT fk_detail_penjualan_barang 
        FOREIGN KEY (id_barang) REFERENCES barang(id_barang)
        ON UPDATE CASCADE 
        ON DELETE RESTRICT
) ENGINE = InnoDB;
```

---

### 3.3. Penjelasan Aturan Referential Integrity

Jelaskan 4 opsi relasi `FOREIGN KEY` dengan logika operasional berikut:

1. **`RESTRICT` / `NO ACTION`**:
   * Menolak proses penghapusan atau perubahan data di tabel induk jika ID tersebut masih dirujuk oleh tabel anak.
   * Contoh: Kategori tidak boleh dihapus selama masih ada barang yang terdaftar di kategori tersebut.
2. **`CASCADE`**:
   * Perubahan atau penghapusan data induk akan otomatis diteruskan ke seluruh baris terkait di tabel anak.
   * Contoh: Jika data penjualan dihapus, seluruh rincian barang pada `detail_penjualan` terkait ikut terhapus.
3. **`SET NULL`**:
   * Jika data induk dihapus, nilai foreign key pada tabel anak diubah menjadi `NULL` (kolom tidak boleh memiliki constraint `NOT NULL`).
4. **`SET DEFAULT`**:
   * Nilai foreign key pada tabel anak diubah kembali ke nilai default yang sudah dideklarasikan.

---

### 3.4. Modifikasi Struktur Tabel (ALTER TABLE)

Ajarkan mahasiswa cara memodifikasi tabel tanpa menghapus database:

```sql
-- Menambah kolom baru
ALTER TABLE barang ADD COLUMN barcode VARCHAR(30) AFTER id_barang;

-- Menambah indeks unik pada kolom baru
ALTER TABLE barang ADD CONSTRAINT uq_barang_barcode UNIQUE (barcode);

-- Mengubah tipe data kolom
ALTER TABLE pelanggan MODIFY COLUMN no_hp VARCHAR(20) NOT NULL;

-- Menghapus foreign key constraint
ALTER TABLE barang DROP FOREIGN KEY fk_barang_kategori;

-- Menambahkan kembali foreign key constraint
ALTER TABLE barang ADD CONSTRAINT fk_barang_kategori 
FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) 
ON UPDATE CASCADE 
ON DELETE RESTRICT;

-- Menghapus kolom
ALTER TABLE barang DROP COLUMN barcode;
```

---

### 3.5. Operasi DML (Data Manipulation Language)

#### A. Penyisipan Data (INSERT)
```sql
-- Insert multi-row tabel kategori
INSERT INTO kategori (nama_kategori) VALUES 
('Elektronik'),
('Aksesoris Komputer'),
('Perangkat Jaringan');

-- Insert multi-row tabel pelanggan
INSERT INTO pelanggan (nama_pelanggan, no_hp, alamat) VALUES 
('Ahmad Dahlan', '081234567890', 'Yogyakarta'),
('Siti Nurhaliza', '081298765432', 'Sleman'),
('Budi Wicaksono', '085643219876', 'Bantul');

-- Insert multi-row tabel barang
INSERT INTO barang (id_kategori, nama_barang, harga, stok) VALUES 
(1, 'Monitor LED 24 Inch', 1450000.00, 15),
(2, 'Keyboard Mechanical RGB', 450000.00, 20),
(2, 'Mouse Wireless Silent', 125000.00, 30),
(3, 'Router WiFi Gigabit', 380000.00, 10);
```

#### B. Pembaruan Data (UPDATE)
Ingatkan mahasiswa untuk selalu menggunakan klausa `WHERE` agar tidak memperbarui seluruh baris tabel:

```sql
-- Update stok dan harga barang tertentu
UPDATE barang 
SET stok = stok + 10, harga = 1400000.00 
WHERE id_barang = 1;
```

#### C. Penghapusan Data (DELETE vs TRUNCATE)
```sql
-- Menghapus baris tertentu
DELETE FROM pelanggan WHERE id_pelanggan = 3;

-- Perbedaan TRUNCATE vs DELETE:
-- DELETE: Operasi DML, menghapus baris per baris, mencatat log transaksi, mempertahankan pointer AUTO_INCREMENT.
-- TRUNCATE: Operasi DDL, mengosongkan tabel dengan mereset alokasi ruang penyimpanan, dan mereset nilai AUTO_INCREMENT ke 1.
```

---

### 3.6. Query Pengambilan Data (SELECT Sederhana)

```sql
-- 1. Filter numerik dan teks
SELECT nama_barang, harga, stok 
FROM barang 
WHERE harga >= 200000 AND stok > 0;

-- 2. Pencarian pola karakter (LIKE)
SELECT id_pelanggan, nama_pelanggan, no_hp 
FROM pelanggan 
WHERE nama_pelanggan LIKE '%Ahmad%';

-- 3. Filter rentang nilai (BETWEEN) dan daftar nilai (IN)
SELECT id_barang, nama_barang, harga 
FROM barang 
WHERE harga BETWEEN 100000 AND 500000
  AND id_kategori IN (1, 2);

-- 4. Pengurutan data dan pembatasan baris (ORDER BY & LIMIT)
SELECT nama_barang, harga 
FROM barang 
ORDER BY harga DESC 
LIMIT 3;
```

---

## 4. Panduan Troubleshooting Laboratorium untuk Asprak

Tabel kendala teknis yang umum dihadapi mahasiswa di laboratorium:

| Kode Error / Gejala | Penyebab Teknis | Langkah Penanganan oleh Asprak |
| :--- | :--- | :--- |
| **Error 1215 (HY000): Cannot add foreign key constraint** | 1. Tipe data kolom PK dan FK tidak identik (contoh: `INT` vs `BIGINT` atau signed vs unsigned).<br>2. Storage engine tabel bukan InnoDB.<br>3. Tabel induk belum dibuat saat tabel anak dieksekusi. | 1. Periksa `DESCRIBE tabel_induk;` dan `DESCRIBE tabel_anak;` untuk menyamakan tipe data.<br>2. Pastikan tabel induk dieksekusi terlebih dahulu. |
| **Error 1452 (23000): Cannot add or update a child row** | Mahasiswa mengisi nilai FK di tabel anak dengan ID yang belum terdaftar di tabel induk. | Periksa data tabel induk. Pastikan data master sudah terisi sebelum mengisi data relasi. |
| **Error 1451 (23000): Cannot delete or update a parent row** | Mencoba menghapus baris tabel induk yang masih memiliki relasi aktif di tabel anak berstatus `RESTRICT`. | Hapus data di tabel anak terlebih dahulu, atau ubah constraint menjadi `ON DELETE CASCADE` bila diizinkan skenario. |
| **Gagal Menghapus Tabel (DROP TABLE)** | Menjalankan `DROP TABLE kategori;` sebelum menghapus `DROP TABLE barang;`. | Arahkan mahasiswa menghapus tabel dengan urutan: tabel anak (detail) terlebih dahulu, baru tabel induk. |
| **Nilai AUTO_INCREMENT Meloncat** | Terjadi kegagalan saat proses INSERT (misalnya terkena constraint unique atau foreign key), lalu dicoba kembali. | Jelaskan bahwa sistem MySQL tidak mendaur ulang ID yang gagal disisipkan untuk menjamin integritas urutan transaksi. |
| **Koneksi Port 3306 Merah / Blocked di XAMPP** | Service MySQL bentrok dengan service lokal Windows atau instance MySQL lain. | Buka `Task Manager` atau `services.msc`, hentikan service MySQL pihak ketiga, atau ganti port di `my.ini` ke `3307`. |

---

## 5. Checklist Kesiapan Asisten Praktikum

Sebelum kelas dimulai, pastikan kamu telah memeriksa hal berikut:

* [ ] Memverifikasi seluruh script DDL dan DML di atas berjalan tanpa error pada MariaDB/MySQL laboratorium.
* [ ] Menyiapkan skenario studi kasus alternatif untuk mahasiswa yang menyelesaikan latihan lebih cepat.
* [ ] Memastikan pemahaman konsep DBLC dan normalisasi sudah matang untuk memfasilitasi sesi tanya jawab.
* [ ] Memeriksa ketersediaan koneksi LMS / pengumpulan tugas di NetSupport lab.
