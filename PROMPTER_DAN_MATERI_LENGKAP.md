# Panduan Micro Teaching & Prompter Lengkap: MySQL Trigger
**Mata Kuliah:** Sistem Manajemen Basis Data Lanjut (SI167)  
**Program Studi:** Sistem Informasi — Universitas Amikom Yogyakarta  
**Durasi Simulasi:** 10 – 12 Menit  
**Target Pembelajaran:** Sub-CPMK 06 (Mampu mengolah user define function, stored procedure, dan trigger)

---

## ⏱️ Strategi Manajemen Waktu (Time Allocation)

| Menit | Slide | Fokus Aktivitas | Sasaran Psikologis Audiens |
|---|---|---|---|
| **00:00 - 01:30** | Slide 1 | Pembukaan & *Problem Hook* (Kasus Penjualan) | Memikat perhatian, membangun urgensi masalah. |
| **01:30 - 03:00** | Slide 2 | Paradigma ECA & Matriks `OLD`/`NEW` | Menanamkan konsep fundamental. |
| **03:00 - 04:30** | Slide 3 | Anatomi Sintaks & Urgensi `DELIMITER` | Membedah aturan teknis penulisan query. |
| **04:30 - 05:30** | Slide 4 | Skema Basis Data Relasional | Memvisualisasikan relasi tabel master-transaksi. |
| **05:30 - 08:00** | Slide 5 | Live Code Bedah Query Trigger | Inti pembelajaran (*core execution*). |
| **08:00 - 09:30** | Slide 6 | Live Proof Simulator Stok | Pembuktian visual (*Aha moment*). |
| **09:30 - 10:30** | Slide 7 | 3 Jebakan Praktikan (*Common Pitfalls*) | Menunjukkan kompetensi problem-solving asisten. |
| **10:30 - 12:00** | Slide 8 | Rangkuman & Sesi Tanya Jawab | Penutup profesional & diskusi terbuka. |

---

## 🎙️ Naskah Prompter Kata-Demi-Kata (Word-for-Word Script)

### Slide 01: Problem Hook & Cover
> *"Selamat pagi/siang bapak/ibu dosen penguji serta rekan-rekan mahasiswa. Pada sesi micro teaching hari ini, kita akan membahas modul inti dari Sistem Manajemen Basis Data Lanjut, yaitu **Otomasi Integritas Data dengan MySQL Trigger** melalui studi kasus penjualan.*
> 
> *Sebelum kita masuk ke kode, mari kita lihat masalah klasik ini: Bayangkan pelanggan baru saja checkout 3 unit laptop. Data nota penjualan berhasil tersimpan di database, tetapi stok di gudang tidak berkurang karena server aplikasi backend tiba-tiba mengalami crash atau putus koneksi tepat sebelum query update dikirim.*
> 
> *Akibatnya sangat fatal: terjadi **overselling**, stok menjadi minus, dan data laporan keuangan tidak sinkron. Mengapa ini terjadi? Karena kita menyerahkan integritas data sepenuhnya pada layer aplikasi luar yang rentan error. Solusinya, kita harus memindahkan aturan bisnis ini ke dalam **Database Engine** menggunakan Trigger."*

---

### Slide 02: Paradigma ECA & Pseudo-Record
> *"Trigger bekerja dengan konsep **ECA: Event, Condition, dan Action**. Analoginya seperti sensor alarm kebakaran—ada asap (Event), suhu di atas batas aman (Condition), maka semprotan air menyala otomatis (Action).*
> 
> *Ada dua hal penting yang harus dipahami:*
> 1. *Kapan kita gunakan **BEFORE** dan kapan **AFTER**? BEFORE dipakai jika kita ingin memvalidasi atau mencegah data salah sebelum ditulis ke disk. Sedangkan AFTER kita gunakan saat ingin menyinkronkan tabel lain setelah transaksi utama sah tersimpan.*
> 2. *Tabel Pseudo-record **OLD** dan **NEW**: Pada operasi `INSERT`, nilai `OLD` bernilai `NULL` karena data baru dimasukkan belum punya masa lalu. Variabel `NEW` berisi data yang baru saja diinput kasir. Sebaliknya, pada operasi `DELETE`, `NEW` bernilai `NULL` dan `OLD` menyimpan nilai lama sebelum dihapus."*

---

### Slide 03: Anatomi Sintaks & Urgensi DELIMITER
> *"Sekarang perhatikan struktur sintaks baku di layar. Komponen pembuatannya terstruktur: `CREATE TRIGGER`, tentukan timing dan event-nya, sebutkan tabel target, wajib sertakan `FOR EACH ROW`, lalu blok logika di dalam `BEGIN ... END`.*
> 
> *Pertanyaan penting yang sering muncul: **Mengapa baris 1 kita harus mengubah `DELIMITER //`?***
> *Secara bawaan, MySQL membaca karakter titik-koma (`;`) sebagai tanda query selesai. Di dalam blok `BEGIN...END`, kita memiliki baris perintah SQL yang masing-masing harus ditutup titik-koma. Jika delimiter tidak diubah sementara menjadi ganda (`//`), MySQL akan memotong proses sebelum mencapai baris `END`, menghasilkan error sintaks.*
> 
> *Ingat, jangan lupa kembalikan ke `DELIMITER ;` di baris paling akhir."*

---

### Slide 04: Skema Studi Kasus Penjualan (SI167)
> *"Sesuai dengan RPS praktikum SI167, kita menggunakan skema penjualan sederhana dengan relasi One-to-Many antara tabel master `produk` dan tabel transaksi `detail_penjualan`.*
> 
> *Perhatikan dua kolom target kita: kolom `stok` pada tabel `produk`, dan kolom `jumlah` pada tabel `detail_penjualan`.*
> 
> *Aturan bisnis kita sangat jelas: **Setiap kali baris baru masuk ke `detail_penjualan`, nilai `produk.stok` harus berkurang sebesar kuantitas yang dibeli**."*

---

### Slide 05: Implementasi Query Trigger
> *"Mari kita bedah implementasi query SQL-nya:*
> 1. *Kita pasang `AFTER INSERT ON detail_penjualan`. Mengapa `AFTER INSERT`? Agar nota transaksi dipastikan valid dulu sebelum stok dipotong.*
> 2. *Kita gunakan `FOR EACH ROW` agar jika pelanggan membeli 3 macam item sekaligus, trigger berjalan untuk setiap item secara konsisten.*
> 3. *Perhatikan baris intinya: `UPDATE produk SET stok = stok - NEW.jumlah WHERE id_produk = NEW.id_produk;`*
> *Klausa `WHERE` ini mutlak wajib ditulis agar pemotongan stok hanya mengenai barang yang dibeli, bukan seluruh produk di gudang."*

---

### Slide 06: Pembuktian & Live Simulator
> *"Sekarang mari kita buktikan. Pada slide ini kita memiliki simulator live data tabel produk. Stok awal laptop Asus Zenbook saat ini adalah 15 unit.*
> 
> *(Klik tombol 'Simulasikan INSERT Penjualan')*
> 
> *Perhatikan: kasir hanya menjalankan satu query `INSERT` ke tabel `detail_penjualan` dengan kuantitas 3. Namun dalam hitungan 0.01 detik, trigger langsung terpicu dan stok di tabel produk otomatis berkurang dari **15 menjadi 12**. Semua berjalan secara otomatis di layer database tanpa intervensi manual aplikasi."*

---

### Slide 07: Jebakan Umum Praktikan (Common Pitfalls)
> *"Sebagai asisten praktikum, keahlian kita bukan hanya bisa menulis kode, tetapi mampu mendeteksi dan menyelesaikan error praktikan dengan cepat di lab. Ada 3 kesalahan klasik mahasiswa:*
> 1. * **Error 1064 (Delimiter Bug):** Lupa mereset `DELIMITER ;` di akhir script sehingga query berikutnya gagal dieksekusi.*
> 2. * **Error 1442 (Mutating Table Conflict):** Praktikan mencoba melakukan `UPDATE` pada tabel yang sedang memicu trigger itu sendiri, menyebabkan recursive deadlock.*
> 3. * **Logic Bug (NULL Reference):** Menggunakan variabel `OLD` pada event `INSERT`. Karena `OLD` bernilai `NULL`, maka perhitungan stok menghasilkan `NULL`.*"

---

### Slide 08: Rangkuman & Sesi Tanya Jawab
> *"Sebagai kesimpulan sesi hari ini, ingatlah 3 prinsip emas:*
> *Pertama, gunakan trigger untuk menjaga integritas data dan audit trail, bukan menimbun seluruh logika bisnis yang kompleks di database.*
> *Kedua, pilih timing BEFORE untuk validasi, dan AFTER untuk mutasi tabel relasi.*
> *Ketiga, transaksi trigger bersifat atomik—jika ada kesalahan di dalam trigger, seluruh transaksi DML akan di-rollback otomatis.*
> 
> *Materi ini menggenapi capaian pembelajaran Sub-CPMK 06. Terima kasih atas perhatian bapak/ibu penguji dan rekan-rekan sekalian. Sekarang saya persilakan jika ada pertanyaan atau tanggapan teknis."*

---

## 🛠️ Script SQL Lengkap untuk Praktikum Lab

Jika Anda ingin mendemonstrasikan live query langsung di MySQL Workbench, DBeaver, atau phpMyAdmin, gunakan script siap pakai berikut:

```sql
-- 1. Buat Database Praktikum
CREATE DATABASE IF NOT EXISTS db_praktikum_smbdl;
USE db_praktikum_smbdl;

-- 2. Buat Tabel Master Produk
CREATE TABLE IF NOT EXISTS produk (
    id_produk VARCHAR(10) PRIMARY KEY,
    nama_produk VARCHAR(50) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    harga DECIMAL(12, 2) NOT NULL
);

-- 3. Buat Tabel Transaksi Detail Penjualan
CREATE TABLE IF NOT EXISTS detail_penjualan (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_produk VARCHAR(10) NOT NULL,
    jumlah INT NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE
);

-- 4. Isi Data Awal
INSERT INTO produk (id_produk, nama_produk, stok, harga) VALUES
('P01', 'Asus Zenbook 14 OLED', 15, 15000000.00),
('P02', 'Logitech MX Master 3S', 30, 1600000.00),
('P03', 'Keychron K2 Mechanical', 20, 1400000.00);

-- 5. Buat Trigger Pengurangan Stok
DELIMITER //

CREATE TRIGGER trg_kurangi_stok_penjualan
AFTER INSERT ON detail_penjualan
FOR EACH ROW
BEGIN
    UPDATE produk
    SET stok = stok - NEW.jumlah
    WHERE id_produk = NEW.id_produk;
END //

DELIMITER ;

-- 6. Pengujian & Verifikasi
-- Langkah A: Cek Stok Sebelum Transaksi
SELECT id_produk, nama_produk, stok FROM produk WHERE id_produk = 'P01';

-- Langkah B: Eksekusi Transaksi Penjualan (Beli 3 unit P01)
INSERT INTO detail_penjualan (id_produk, jumlah, subtotal)
VALUES ('P01', 3, 45000000.00);

-- Langkah C: Cek Stok Sesudah Transaksi (Harus bernilai 12)
SELECT id_produk, nama_produk, stok FROM produk WHERE id_produk = 'P01';
```

---

## ❓ FAQ & Pertanyaan Kritis Penguji Seleksi Asprak

### Q1: "Mengapa tidak menggunakan Stored Procedure saja daripada Trigger?"
* **Jawaban Ideal:** Stored Procedure membutuhkan pemanggilan eksplisit (`CALL nama_prosedur()`) oleh aplikasi backend. Jika seorang developer junior lupa memanggil prosedur dan langsung menjalankan `INSERT` mentah, integritas data rusak. Trigger bersifat **deklaratif dan pasif**—ia akan otomatis aktif siapa pun atau aplikasi apa pun yang menyentuh tabel.

### Q2: "Kapan kita TIDAK boleh menggunakan Trigger?"
* **Jawaban Ideal:** 
  1. Ketika logika bisnis memerlukan komunikasi ke layanan eksternal (seperti mengirim email/SMS gateway atau memanggil REST API payment).
  2. Ketika operasi database sangat padat (*high-throughput bulk insert*), karena row-level trigger menambah overhead waktu simpan per baris.
  3. Ketika memicu *trigger chaining* yang terlalu dalam (> 3 layer trigger bertingkat) yang menyulitkan debugging sistem.

### Q3: "Bagaimana cara menangani kondisi jika stok barang di gudang ternyata kurang dari jumlah yang dibeli?"
* **Jawaban Ideal:** Kita dapat membuat trigger tambahan bertipe `BEFORE INSERT` yang melakukan pengecekan ketersediaan stok. Jika `stok < NEW.jumlah`, kita panggil `SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak mencukupi';` untuk membatalkan transaksi secara aman.
