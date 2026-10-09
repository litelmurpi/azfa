# Panduan Asisten Praktikum: Pertemuan 3 sampai 7
## Sistem Manajemen Basis Data Lanjut (SI167)
### Program Studi Sistem Informasi - Universitas AMIKOM Yogyakarta

Panduan ini merupakan kelanjutan dari materi Pertemuan 1 dan 2. Fokus pembelajaran pada Pertemuan 3 hingga 7 adalah penguasaan *Programmable SQL* (Views, Functions, Stored Procedures, Triggers) dan administrasi database (Manajemen User, Hak Akses, Backup, Restore) menggunakan **Studi Kasus Database Penjualan (`db_penjualan`)**.

---

## 1. Peta Materi & Bobot Penilaian Fase 1 (P3 - P7)

Setiap pertemuan memiliki latihan praktikum dengan bobot masing-masing **5%** (total 25% dari nilai akhir):

| Pertemuan | Pokok Bahasan | Sub-CPMK Terkait | Luaran Penilaian | Bobot |
| :---: | :--- | :--- | :--- | :---: |
| **Pertemuan 3** | Pengambilan Data Lanjut, Views, dan Control Flow | Sub-CPMK05 | Ketepatan query View dan Control Flow | 5% |
| **Pertemuan 4** | User Defined Functions (UDF) | Sub-CPMK06 | Ketepatan pembuatan Function dan pemanggilannya | 5% |
| **Pertemuan 5** | Stored Procedures | Sub-CPMK06 | Ketepatan pembuatan Procedure transaksi | 5% |
| **Pertemuan 6** | Triggers (Event, Condition, Action) | Sub-CPMK06 | Ketepatan implementasi Trigger mutasi data | 5% |
| **Pertemuan 7** | Pemeliharaan Database & Hak Akses User | Sub-CPMK04 | Ketepatan User Privilege, Backup, dan Restore | 5% |

---

## 2. Pertemuan 3: Pengambilan Data Lanjut, Views, & Control Flow

### 2.1. Konsep Utama
1. **Views**: Tabel virtual berbasis hasil query `SELECT`. View tidak menyimpan data fisik sendiri (hanya menyimpan definisi query), berguna untuk:
   * Menyembunyikan kolom sensitif (misalnya password atau laba kotor).
   * Menyederhanakan query relasi banyak tabel yang sering dipanggil.
2. **Control Flow Functions**:
   * `IF(kondisi, nilai_jika_benar, nilai_jika_salah)`: Evaluasi kondisi biner sederhana.
   * `CASE WHEN ... THEN ... ELSE ... END`: Evaluasi multi-kondisi seperti percabangan switch-case.
   * `IFNULL(ekspresi, nilai_pengganti)`: Mengganti nilai `NULL` dengan nilai bawaan.
   * `COALESCE(v1, v2, ...)`: Mengembalikan nilai non-null pertama dari daftar argumen.

---

### 2.2. Contoh Implementasi Script SQL

```sql
USE db_penjualan;

-- 1. Query Agregasi Multi-Tabel dengan Join dan Group By
SELECT 
    p.id_penjualan,
    p.tgl_transaksi,
    pel.nama_pelanggan,
    COUNT(dp.id_barang) AS total_item,
    SUM(dp.subtotal) AS grand_total
FROM penjualan p
INNER JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
INNER JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
GROUP BY p.id_penjualan, p.tgl_transaksi, pel.nama_pelanggan;

-- 2. Membuat View Laporan Penjualan Lengkap dengan Klasifikasi Transaksi
CREATE OR REPLACE VIEW v_rekap_penjualan AS
SELECT 
    p.id_penjualan,
    p.tgl_transaksi,
    pel.nama_pelanggan,
    pel.no_hp,
    IFNULL(SUM(dp.subtotal), 0) AS total_belanja,
    IF(SUM(dp.subtotal) >= 1000000, 'Mendapat Kupon Hadiah', 'Tidak Ada Kupon') AS status_bonus,
    CASE 
        WHEN SUM(dp.subtotal) >= 2000000 THEN 'Pelanggan Platinum'
        WHEN SUM(dp.subtotal) >= 1000000 THEN 'Pelanggan Gold'
        WHEN SUM(dp.subtotal) >= 500000  THEN 'Pelanggan Silver'
        ELSE 'Pelanggan Reguler'
    END AS tier_transaksi
FROM penjualan p
INNER JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
LEFT JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan
GROUP BY p.id_penjualan, p.tgl_transaksi, pel.nama_pelanggan, pel.no_hp;

-- 3. Memanggil View
SELECT * FROM v_rekap_penjualan WHERE tier_transaksi IN ('Pelanggan Gold', 'Pelanggan Platinum');
```

---

### 2.3. Titik Kritis Pengajaran (Troubleshooting Asprak)
* **Kueri View Berjalan Lambat**: Jelaskan bahwa View menjalankan kueri aslinya setiap kali dipanggil. Jika tabel induk belum memiliki indeks pada kolom relasi (Foreign Key), View akan melakukan full-table scan.
* **View Read-Only vs Updatable**: Ingatkan mahasiswa bahwa View yang memuat `GROUP BY`, fungsi agregasi (`SUM`, `COUNT`), `DISTINCT`, atau `UNION` tidak bisa dimanipulasi dengan `INSERT` atau `UPDATE` secara langsung.

---

## 3. Pertemuan 4: User Defined Functions (UDF)

### 3.1. Konsep Utama
* Function adalah blok kode yang menerima argumen input, melakukan pemrosesan logika, dan **wajib mengembalikan satu nilai skalar** (`RETURNS <tipe_data>` dan perintah `RETURN`).
* Function bersifat *deterministic* jika input yang sama selalu menghasilkan output yang sama, atau *not deterministic* jika hasilnya bergantung pada kondisi luar (misalnya fungsi waktu `NOW()` atau `RAND()`).
* Function dapat dipanggil langsung di dalam klausa `SELECT`, `WHERE`, `ORDER BY`, dan `HAVING`.

---

### 3.2. Script SQL Function

Perhatikan sintaks penggantian delimiter (`DELIMITER //`) agar MySQL tidak mengakhiri perintah sebelum seluruh blok `BEGIN ... END` selesai dibaca:

```sql
USE db_penjualan;

-- 1. Mengubah Delimiter
DELIMITER //

-- 2. Membuat Function untuk Menghitung Nominal Diskon Transaksi
CREATE FUNCTION fn_hitung_potongan(total DECIMAL(12,2))
RETURNS DECIMAL(12,2)
DETERMINISTIC
BEGIN
    DECLARE nominal_diskon DECIMAL(12,2) DEFAULT 0.00;
    
    IF total >= 2000000 THEN
        SET nominal_diskon = total * 0.10; -- Diskon 10%
    ELSEIF total >= 1000000 THEN
        SET nominal_diskon = total * 0.05; -- Diskon 5%
    ELSEIF total >= 500000 THEN
        SET nominal_diskon = total * 0.02; -- Diskon 2%
    ELSE
        SET nominal_diskon = 0.00;
    END IF;
    
    RETURN nominal_diskon;
END //

-- 3. Membuat Function untuk Konversi Status Stok Barang
CREATE FUNCTION fn_status_stok(jml_stok INT)
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    DECLARE label_status VARCHAR(20);
    
    IF jml_stok <= 0 THEN
        SET label_status = 'HABIS';
    ELSEIF jml_stok <= 5 THEN
        SET label_status = 'MENIPIS';
    ELSE
        SET label_status = 'TERSEDIA';
    END IF;
    
    RETURN label_status;
END //

-- Mengembalikan Delimiter ke titik koma
DELIMITER ;

-- 4. Contoh Penggunaan Function di Query SELECT
SELECT 
    id_barang,
    nama_barang,
    stok,
    fn_status_stok(stok) AS indikator_stok
FROM barang;

SELECT 
    id_penjualan,
    total_bayar,
    fn_hitung_potongan(total_bayar) AS diskon,
    (total_bayar - fn_hitung_potongan(total_bayar)) AS total_setelah_diskon
FROM penjualan;
```

---

### 3.3. Titik Kritis Pengajaran (Troubleshooting Asprak)
* **Error 1418: This function has none of DETERMINISTIC, NO SQL, or READS SQL DATA in its declaration**: Terjadi saat setting `log_bin_trust_function_creators` aktif di MySQL. Solusinya: wajib cantumkan keyword `DETERMINISTIC` atau `READS SQL DATA` setelah baris `RETURNS`.
* **Perbedaan Function vs Procedure**: Tekankan bahwa Function mengembalikan satu nilai langsung (return value) dan bisa diletakkan di dalam ekspresi `SELECT kolom, fn()`, sedangkan Procedure dipanggil dengan perintah tersendiri: `CALL`.

---

## 4. Pertemuan 5: Stored Procedures

### 4.1. Konsep Utama
* Stored Procedure adalah kumpulan perintah SQL yang disimpan di server database untuk mengeksekusi serangkaian alur logika transaksi.
* Mendukung tiga tipe parameter:
  * `IN`: Nilai dikirim dari pemanggil ke procedure (default).
  * `OUT`: Nilai dikembalikan dari procedure ke pemanggil.
  * `INOUT`: Nilai dikirim ke procedure, diubah di dalam procedure, lalu dikembalikan.
* Mendukung deklarasi variabel lokal (`DECLARE`), kontrol percabangan (`IF`, `CASE`), perulangan (`WHILE`, `LOOP`), serta transaksi atomik (`START TRANSACTION`, `COMMIT`, `ROLLBACK`).

---

### 4.2. Script SQL Stored Procedure

Contoh procedure transaksi penjualan yang memvalidasi ketersediaan stok, menyisipkan detail penjualan, dan memperbarui header:

```sql
USE db_penjualan;

DELIMITER //

-- Procedure Pencatatan Transaksi Barang
CREATE PROCEDURE sp_tambah_item_penjualan (
    IN p_id_penjualan VARCHAR(20),
    IN p_id_barang INT,
    IN p_qty INT,
    OUT p_pesan VARCHAR(100),
    OUT p_sukses BOOLEAN
)
BEGIN
    DECLARE v_stok INT DEFAULT 0;
    DECLARE v_harga DECIMAL(12,2) DEFAULT 0.00;
    DECLARE v_subtotal DECIMAL(12,2) DEFAULT 0.00;

    -- Periksa ketersediaan barang dan stok
    SELECT stok, harga INTO v_stok, v_harga 
    FROM barang 
    WHERE id_barang = p_id_barang;

    -- Validasi apakah barang ditemukan
    IF v_harga IS NULL THEN
        SET p_pesan = 'Error: Barang tidak ditemukan.';
        SET p_sukses = FALSE;
    -- Validasi kecukupan stok
    ELSEIF v_stok < p_qty THEN
        SET p_pesan = CONCAT('Error: Stok tidak cukup. Sisa stok: ', v_stok);
        SET p_sukses = FALSE;
    ELSE
        -- Hitung subtotal
        SET v_subtotal = v_harga * p_qty;

        -- Simpan ke detail penjualan
        INSERT INTO detail_penjualan (id_penjualan, id_barang, qty, harga_satuan, subtotal)
        VALUES (p_id_penjualan, p_id_barang, p_qty, v_harga, v_subtotal);

        -- Perbarui total bayar di tabel penjualan
        UPDATE penjualan 
        SET total_bayar = total_bayar + v_subtotal 
        WHERE id_penjualan = p_id_penjualan;

        SET p_pesan = 'Sukses: Item berhasil ditambahkan ke penjualan.';
        SET p_sukses = TRUE;
    END IF;
END //

DELIMITER ;
```

#### Cara Pemanggilan Procedure dengan Parameter OUT:
```sql
-- Siapkan variabel penampung output
SET @hasil_pesan = '';
SET @hasil_status = FALSE;

-- Jalankan procedure
CALL sp_tambah_item_penjualan('PJ001', 1, 2, @hasil_pesan, @hasil_status);

-- Tampilkan output
SELECT @hasil_pesan AS pesan_eksekusi, @hasil_status AS status_eksekusi;
```

---

### 4.3. Titik Kritis Pengajaran (Troubleshooting Asprak)
* **Variabel bernilai NULL jika query SELECT INTO tidak menemukan baris**: Ingatkan mahasiswa jika baris tidak ditemukan, variabel penampung tidak otomatis bernilai default melainkan `NULL`. Pastikan selalu ada pemeriksaan nilai awal atau penanganan kondisi baris kosong.
* **Eksekusi Procedure di phpMyAdmin**: ingatkan mahasiswa untuk mengosongkan kotak delimiter di bawah SQL textarea jika sudah menggunakan `DELIMITER //` di dalam script.

---

## 5. Pertemuan 6: Triggers

### 5.1. Konsep Utama
* Trigger adalah blok kode SQL yang dijalankan secara otomatis oleh database engine saat terjadi event DML tertentu pada sebuah tabel.
* Struktur Trigger terdiri dari:
  * **Timing**: `BEFORE` (sebelum operasi ditulis ke disk) atau `AFTER` (setelah operasi berhasil ditulis ke disk).
  * **Event**: `INSERT`, `UPDATE`, atau `DELETE`.
  * **Scope**: `FOR EACH ROW` (berlaku untuk setiap baris data yang terpengaruh).
* **Kata Kunci Akses Kolom**:
  * `NEW.kolom`: Mengakses nilai baru yang sedang disisipkan atau diperbarui (tersedia pada event `INSERT` dan `UPDATE`).
  * `OLD.kolom`: Mengakses nilai lama sebelum diperbarui atau dihapus (tersedia pada event `UPDATE` dan `DELETE`).

---

### 5.2. Script SQL Trigger

Contoh implementasi dua trigger nyata:
1. Pemotongan stok otomatis saat item transaksi disimpan.
2. Pencatatan riwayat perubahan harga barang ke tabel log (*audit trail*).

```sql
USE db_penjualan;

-- 1. Buat Tabel Audit Log untuk Perubahan Harga Barang
CREATE TABLE IF NOT EXISTS log_perubahan_harga (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    harga_lama DECIMAL(12,2) NOT NULL,
    harga_baru DECIMAL(12,2) NOT NULL,
    waktu_perubahan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_pengubah VARCHAR(50) DEFAULT (CURRENT_USER())
) ENGINE = InnoDB;

DELIMITER //

-- 2. Trigger 1: Otomatis Kurangi Stok Barang Setelah Insert Detail Penjualan
CREATE TRIGGER trg_kurangi_stok_penjualan
AFTER INSERT ON detail_penjualan
FOR EACH ROW
BEGIN
    UPDATE barang 
    SET stok = stok - NEW.qty 
    WHERE id_barang = NEW.id_barang;
END //

-- 3. Trigger 2: Otomatis Kembalikan Stok Barang Jika Detail Penjualan Dihapus
CREATE TRIGGER trg_kembalikan_stok_batal
AFTER DELETE ON detail_penjualan
FOR EACH ROW
BEGIN
    UPDATE barang 
    SET stok = stok + OLD.qty 
    WHERE id_barang = OLD.id_barang;
END //

-- 4. Trigger 3: Catat Log Perubahan Harga Barang (Audit Log)
CREATE TRIGGER trg_audit_harga_barang
AFTER UPDATE ON barang
FOR EACH ROW
BEGIN
    IF OLD.harga <> NEW.harga THEN
        INSERT INTO log_perubahan_harga (id_barang, harga_lama, harga_baru)
        VALUES (OLD.id_barang, OLD.harga, NEW.harga);
    END IF;
END //

DELIMITER ;
```

---

### 5.3. Pengujian Trigger di Laboratorium

Minta mahasiswa menguji langsung efek otomasi trigger:

```sql
-- Cek stok awal barang 1
SELECT id_barang, nama_barang, stok FROM barang WHERE id_barang = 1;

-- Masukkan transaksi detail
INSERT INTO detail_penjualan (id_penjualan, id_barang, qty, harga_satuan, subtotal)
VALUES ('PJ001', 1, 3, 1400000.00, 4200000.00);

-- Cek stok kembali (stok harus berkurang 3 secara otomatis tanpa perintah UPDATE manual)
SELECT id_barang, nama_barang, stok FROM barang WHERE id_barang = 1;

-- Uji log audit dengan mengubah harga barang
UPDATE barang SET harga = 1350000.00 WHERE id_barang = 1;

-- Periksa tabel log audit
SELECT * FROM log_perubahan_harga;
```

---

### 5.4. Titik Kritis Pengajaran (Troubleshooting Asprak)
* **Error 1442: Can't update table 'detail_penjualan' in stored function/trigger because it is already in use by statement which invoked this stored function/trigger**:
  * *Penyebab*: Mahasiswa menulis kueri `UPDATE detail_penjualan ...` di dalam trigger yang menempel pada tabel `detail_penjualan`.
  * *Solusi*: MySQL melarang modifikasi tabel yang sama di dalam trigger karena memicu rekursi tak berujung (*infinite loop*). Jika ingin memodifikasi data baris yang sedang masuk, gunakan `BEFORE INSERT` lalu ubah kolom menggunakan `SET NEW.nama_kolom = nilai_baru;`.

---

## 6. Pertemuan 7: Pemeliharaan Database & Hak Akses User

### 6.1. Konsep Utama
1. **User Privilege Management**:
   * Menghindari penggunaan akun `root` untuk operasional aplikasi sehari-hari.
   * Menerapkan prinsip hak akses minimal (*Principle of Least Privilege*): User kasir hanya berhak membaca data produk dan mencatat transaksi, tidak boleh menghapus tabel atau melihat akun gaji.
2. **Database Maintenance**:
   * *Backup Logis*: Mengekspor skema dan data menjadi file SQL mentah menggunakan utility `mysqldump`.
   * *Restore / Recovery*: Mengimpor kembali file backup SQL ke database tujuan saat terjadi kerusakan data.
   * *Sinkronisasi Data*: Mengekspor dan mengimpor file CSV/teks untuk kebutuhan integrasi eksternal.

---

### 6.2. Script Manajemen Pengguna & Hak Akses

```sql
-- 1. Membuat User Baru
CREATE USER 'kasir_toko'@'localhost' IDENTIFIED BY 'PasswordKasir123!';
CREATE USER 'manajer_toko'@'localhost' IDENTIFIED BY 'PasswordManager123!';

-- 2. Memberikan Hak Akses Khusus untuk User Kasir
-- Kasir hanya boleh membaca kategori dan barang, serta membaca & menambah transaksi penjualan
GRANT SELECT ON db_penjualan.kategori TO 'kasir_toko'@'localhost';
GRANT SELECT ON db_penjualan.barang TO 'kasir_toko'@'localhost';
GRANT SELECT, INSERT ON db_penjualan.penjualan TO 'kasir_toko'@'localhost';
GRANT SELECT, INSERT ON db_penjualan.detail_penjualan TO 'kasir_toko'@'localhost';

-- Kasir diberi izin membaca view rekap
GRANT SELECT ON db_penjualan.v_rekap_penjualan TO 'kasir_toko'@'localhost';

-- 3. Memberikan Hak Akses untuk Manajer (Akses Penuh pada Database Tertentu)
GRANT ALL PRIVILEGES ON db_penjualan.* TO 'manajer_toko'@'localhost';

-- 4. Menerapkan Perubahan Hak Akses
FLUSH PRIVILEGES;

-- 5. Memeriksa Daftar Hak Akses yang Dimiliki User
SHOW GRANTS FOR 'kasir_toko'@'localhost';

-- 6. Mencabut Hak Akses Tertentu
REVOKE INSERT ON db_penjualan.penjualan FROM 'kasir_toko'@'localhost';
FLUSH PRIVILEGES;

-- 7. Menghapus User jika Sudah Tidak Diperlukan
-- DROP USER 'kasir_toko'@'localhost';
```

---

### 6.3. Perintah Backup & Recovery (Command Prompt / Terminal)

Jelaskan bahwa perintah ini dijalankan di **Command Prompt / Terminal OS**, bukan di dalam query editor MySQL:

```bash
# 1. Backup Seluruh Database Penjualan ke File SQL
mysqldump -u root -p db_penjualan > backup_db_penjualan.sql

# 2. Backup Hanya Struktur Tabel Tanpa Data
mysqldump -u root -p --no-data db_penjualan > skema_hanya.sql

# 3. Backup Hanya Data Tanpa Struktur Tabel
mysqldump -u root -p --no-create-info db_penjualan > data_hanya.sql

# 4. Melakukan Restore / Recovery Database dari File Backup
# Pastikan database target sudah dibuat terlebih dahulu di MySQL
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS db_penjualan_restore;"
mysql -u root -p db_penjualan_restore < backup_db_penjualan.sql
```

---

## 7. Rangkuman Troubleshooting Fase 1 (Laboratorium Check)

| Masalah yang Sering Muncul | Akar Masalah | Solusi Cepat dari Asprak |
| :--- | :--- | :--- |
| **Error delimiter saat membuat Function / Procedure / Trigger** | Sintaks `DELIMITER //` tidak dikenali phpMyAdmin jika ditulis di kolom textarea. | Kosongkan kolom "Delimiter" bawaan form phpMyAdmin atau ubah isinya menjadi `//`. Jika via DBeaver atau CLI terminal, script berjalan normal. |
| **Trigger tidak berjalan saat update atau insert via GUI phpMyAdmin** | Penulisan nama kolom pada `NEW.` atau `OLD.` salah ketik (*case sensitive* di sebagian OS). | Cocokkan nama kolom persis dengan hasil `DESCRIBE nama_tabel;`. |
| **User kasir gagal login dari aplikasi lokal** | Host dibatasi ke `localhost`, sementara aplikasi konek melalui IP `127.0.0.1` atau `192.168.x.x`. | Buat user dengan host fleksibel: `CREATE USER 'kasir'@'%' IDENTIFIED BY '...';`. |
| **Hasil mysqldump berukuran 0 byte / Access Denied** | Password root salah atau direktori tujuan tidak memiliki izin tulis (*write permission*). | Jalankan terminal dengan mode administrator atau tentukan path lengkap tujuan, misalnya `C:\backup\backup.sql`. |

---

## 8. Persiapan Menjelang Ujian Tengah Semester (Pertemuan 8)

Pada pertemuan ke-8 mahasiswa menghadapi UTS dengan bobot **15%**. Asprak disarankan mengingatkan mahasiswa untuk mereview:
1. Hubungan antara Normalisasi 3NF dengan pembuatan tabel fisik yang bebas anomali.
2. Perbedaan kapan harus menggunakan `VIEW`, `FUNCTION`, `STORED PROCEDURE`, dan `TRIGGER`.
3. Kemampuan membaca dan menelusuri alur eksekusi trigger saat terjadi operasi DML berantai.
