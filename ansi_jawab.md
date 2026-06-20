# Jawaban Tugas Analisis dan Perancangan Sistem Informasi

**Kelompok:** Barbarabar (Kelompok 11)
**Tema:** Sistem Informasi E-Voting Tingkat Kelurahan

## 1. Deskripsi Proses pada Data Flow Diagram (DFD)

**Pengertian:**
Deskripsi proses (*Process Description*) adalah penjelasan naratif dan terstruktur yang menjabarkan logika kerja atau spesifikasi dari sebuah proses (simbol *bubble*) di dalam DFD. Karena DFD secara visual hanya menunjukkan aliran data (input dan output) tanpa menjelaskan bagaimana transformasi data tersebut secara logis terjadi, deskripsi proses berfungsi untuk mengisi kekurangan tersebut. Deskripsi ini merinci aturan bisnis, kondisi, dan urutan prosedural mengenai bagaimana data masukan diolah menjadi data keluaran, serta referensi ke *data store* apa saja yang dibaca atau ditulis.

**Contoh pada Sistem E-Voting Kelurahan (Kelompok Kami):**
Sebagai contoh, pada rancangan DFD level sistem kami, terdapat proses **Verifikasi & Autentikasi Pemilih**. Berikut adalah deskripsi prosesnya:

* **Input Data:** NIK pemilih yang diinputkan oleh Petugas TPS di aplikasi klien.
* **Logika Proses (Aturan Bisnis):**
  1. Sistem menerima input NIK dan melakukan kueri pencarian ke dalam *data store* **DPT_DIGITAL**.
  2. Sistem memvalidasi apakah NIK tersebut terdaftar. Jika tidak ditemukan, sistem menampilkan pesan galat "Data Pemilih Tidak Ditemukan".
  3. Jika NIK terdaftar, sistem akan mengecek atribut status pemilih. Jika status menunjukkan nilai "Sudah Memilih", sistem menolak akses dan mengeluarkan peringatan.
  4. Jika status pemilih valid ("Belum Memilih"), sistem akan meng-*generate* 6 digit angka acak sebagai OTP.
  5. Sistem melakukan proses *hashing* terhadap OTP tersebut, kemudian menyimpan *hash value* beserta batas waktu kedaluwarsa ke dalam *data store* **OTP_TOKENS**.
* **Output Data:** Kode OTP dalam format teks yang akan dicetak/ditampilkan kepada Petugas TPS, untuk kemudian diberikan kepada pemilih sebagai token akses ke bilik suara.

---

## 2. Matriks CRUD

**Pengertian:**
Matriks CRUD (*Create, Read, Update, Delete*) adalah sebuah tabel pemetaan dua dimensi yang menunjukkan relasi fungsional antara proses-proses di dalam sistem (atau aktor) dengan basis data (*data store* atau entitas database). Matriks ini berfungsi untuk memvalidasi kelengkapan rancangan arsitektur data. Melalui matriks ini, pengembang dapat memastikan bahwa setiap entitas data setidaknya memiliki satu proses yang men-*Create* datanya, serta tidak ada data yang *redundant* atau terisolasi (misal: bisa di-*Read* tetapi tidak pernah ada proses untuk meng-*Create*-nya).

**Contoh pada Sistem E-Voting Kelurahan (Kelompok Kami):**
Berikut adalah contoh implementasi Matriks CRUD berdasarkan alur operasional sistem e-voting yang kelompok kami rancang, dipetakan terhadap entitas *database* utamanya:


| Proses Operasional              | DPT_DIGITAL | KANDIDAT | DATA_AKUN | OTP_TOKENS | SUARA_ANONIM | BERITA_ACARA | AUDIT_LOG |
| :------------------------------ | :---------: | :------: | :-------: | :--------: | :----------: | :----------: | :-------: |
| **Manajemen Data Pemilih**      |   C, R, U   |          |           |            |              |              |     C     |
| **Manajemen Kandidat & Akun**   |             | C, R, U  |  C, R, U  |            |              |              |     C     |
| **Verifikasi Identitas di TPS** |      R      |          |           |     C      |              |              |     C     |
| **Pemberian Suara (Voting)**    |      U      |    R     |           |     R      |      C       |              |     C     |
| **Rekapitulasi Real-time**      |             |          |           |            |      R       |              |           |
| **Pengesahan Hasil Akhir**      |             |          |           |            |      R       |     C, R     |     C     |

**Keterangan:**

* **C (Create):** Menambahkan *record* data baru.
* **R (Read):** Menampilkan atau membaca data yang sudah ada.
* **U (Update):** Memodifikasi atau memperbarui data (Contoh: Pada saat proses *Voting*, sistem akan melakukan Update (U) pada `DPT_DIGITAL` untuk mengubah status warga menjadi "Sudah Memilih").
* **D (Delete):** Menghapus data. (Catatan Analisis: Pada sistem pemilu yang kami rancang, operasi *Delete* (D) sangat diminimalisir atau ditiadakan pada operasional harian guna menjaga integritas *Audit Trail*).
