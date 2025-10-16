# Panduan Kolaborasi Proyek Android di GitHub

Selamat datang di tim! Dokumen ini menjelaskan cara untuk mulai berkontribusi pada proyek dan alur kerja yang kita gunakan agar kolaborasi berjalan lancar.

## 1. Persiapan Awal untuk Anggota Tim

Langkah-langkah ini hanya perlu dilakukan **satu kali** di awal.

### A. Terima Undangan Kolaborator

1.  Anda akan menerima email undangan dari GitHub untuk menjadi kolaborator di repositori ini.
2.  Klik tautan di email tersebut dan terima undangannya.

### B. Clone Proyek ke Komputer Anda

"Clone" adalah proses mengunduh proyek dari GitHub ke komputer lokal Anda.

1.  Buka halaman utama repositori di GitHub.
2.  Klik tombol hijau **`< > Code`**.
3.  Salin URL HTTPS yang tersedia (`https://github.com/litelmurpi/tanami.git`).
4.  Buka Android Studio.
5.  Di jendela selamat datang, pilih **"Get from VCS"** (atau jika proyek lain terbuka, pilih `File > New > Project from Version Control`).
6.  Tempelkan URL yang sudah disalin ke kolom **URL**, pilih lokasi penyimpanan di komputer Anda, lalu klik **"Clone"**.

Android Studio akan mengunduh proyek dan secara otomatis melakukan sinkronisasi Gradle. Tunggu hingga proses selesai.

## 2. Alur Kerja (Workflow) Harian

Ikuti siklus ini **setiap kali** Anda akan mulai mengerjakan tugas atau fitur baru.

### Langkah 1: Selalu Sinkronisasi Proyek (`git pull`)

Sebelum mulai menulis kode, pastikan Anda memiliki versi terbaru dari kode yang ada di `main`. Ini sangat penting untuk menghindari konflik.

Buka **Terminal** di Android Studio (`View > Tool Windows > Terminal`) dan jalankan perintah:

```bash
git checkout main
git pull origin main
```

Atau, Anda bisa menggunakan tombol **"Update Project"** (ikon panah biru ke bawah) di Android Studio.

### Langkah 2: Buat Branch Baru (`git checkout -b`)

Jangan pernah bekerja langsung di *branch* `main`. Buatlah *branch* baru untuk setiap tugas yang Anda kerjakan.

Gunakan format penamaan berikut: `tipe/deskripsi-singkat`

-   **fitur/**: Untuk pengembangan fitur baru (contoh: `fitur/sistem-login-google`)
-   **perbaikan/**: Untuk memperbaiki bug (contoh: `perbaikan/tombol-submit-tidak-responsif`)
-   **dok/**: Untuk menambah atau memperbaiki dokumentasi (contoh: `dok/update-panduan-instalasi`)

Jalankan perintah ini di terminal:

```bash
# Contoh untuk membuat fitur login
git checkout -b fitur/sistem-login-google
```

Sekarang Anda sudah berada di *branch* baru dan siap untuk mulai *coding*.

### Langkah 3: Bekerja dan Lakukan Commit (`git commit`)

Tulislah kode Anda. Setelah menyelesaikan satu bagian kecil yang logis dari tugas Anda, lakukan *commit*. *Commit* yang sering dan kecil lebih baik daripada satu *commit* besar.

1.  Buka jendela **Commit** di Android Studio (biasanya ada di tab sebelah kiri atau tekan `Ctrl + K`).
2.  Pilih file-file yang ingin Anda sertakan dalam *commit*.
3.  Tulis **pesan commit yang jelas** dengan format:
    > **Judul Singkat (maksimal 50 karakter)**
    >
    > (Opsional) Berikan penjelasan lebih detail jika diperlukan.
    >
    > Contoh: `Feat: Menambahkan validasi email dan password pada halaman login`

4.  Klik tombol **"Commit"**.

### Langkah 4: Kirim Perubahan ke GitHub (`git push`)

Setelah melakukan beberapa *commit*, unggah (*push*) *branch* Anda ke repositori GitHub agar anggota tim lain bisa melihat progres Anda.

Saat pertama kali melakukan *push* untuk *branch* baru, gunakan perintah:

```bash
git push -u origin nama-branch-anda

# Contoh:
git push -u origin fitur/sistem-login-google
```

Untuk *push* selanjutnya di *branch* yang sama, Anda cukup menjalankan:

```bash
git push
```

Atau, gunakan tombol **"Push"** (ikon panah hijau ke atas) di Android Studio.

### Langkah 5: Buat Pull Request (PR)

Ketika pekerjaan Anda di *branch* tersebut sudah selesai dan siap untuk digabungkan ke `main`, buatlah *Pull Request* (PR).

1.  Buka halaman repositori di GitHub.
2.  GitHub akan menampilkan notifikasi untuk *branch* yang baru saja Anda *push*. Klik tombol **"Compare & pull request"**.
3.  **Judul PR**: Isi dengan judul yang deskriptif (mirip pesan commit).
4.  **Deskripsi**: Jelaskan perubahan apa saja yang Anda buat, bagaimana cara mengujinya, dan lampirkan *screenshot* jika perlu.
5.  **Reviewers**: Di sisi kanan, tambahkan anggota tim yang Anda minta untuk me-review kode Anda.
6.  Klik **"Create pull request"**.

### Langkah 6: Proses Review dan Merge

1.  Tim *reviewer* akan memeriksa kode Anda dan mungkin memberikan komentar atau permintaan perubahan.
2.  Lakukan perbaikan sesuai masukan. Setiap *commit* dan *push* baru yang Anda lakukan di *branch* Anda akan otomatis masuk ke PR yang sudah ada.
3.  Setelah PR disetujui (`Approved`), salah satu *project maintainer* akan menggabungkan (`merge`) kode Anda ke *branch* `main`.
4.  Selamat! Tugas Anda sudah selesai dan menjadi bagian dari proyek utama.

Ulangi siklus ini dari **Langkah 1** untuk tugas berikutnya.
