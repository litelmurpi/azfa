# 🎙️ Naskah Microteaching: Seleksi Calon Asisten Praktikum (Asprak)

> **Mata Kuliah** : Pemrograman Web Lanjut (SI118) — S1 Sistem Informasi Universitas Amikom Yogyakarta  
> **Topik Simulasi** : Pertemuan 16 — Arsitektur MVC & Request Lifecycle pada Laravel  
> **Format** : Microteaching Seleksi Calon Asisten Praktikum di Depan Dosen Penguji / Asisten Senior  
> **Target Durasi** : 10 – 12 Menit (Total 7 Slide)  
> **Presenter** : [Nama Kamu]  

---

## 🎯 Poin Penilaian Penguji yang Ditonjolkan:
1. **Penyampaian Konsep Teknis**: Mampu menyederhanakan materi abstrak (*MVC Architecture*) menjadi sangat mudah dipahami mahasiswa.
2. **Keterampilan Live Coding**: Menunjukkan penguasaan sintaks Laravel (Routing, Artisan CLI, Blade) secara tenang, terstruktur, dan minim typo.
3. **Komunikasi Pedagogik**: Suara jelas, interaktif, intonasi mantap, dan gestur seorang pendamping praktikum yang ramah serta solutif.

---

## 📌 Slide 1: Pembukaan & Greeting Profesional
* **Estimasi Waktu**: `00:00 - 01:00` (1 Menit)
* **Visual Cue / Sikap**: Berdiri tegap, kontak mata langsung ke para dosen penguji / asisten senior. Sampaikan salam pembuka dengan percaya diri dan antusias.

### 🗣️ Naskah Bicara:
> "Selamat pagi/siang Bapak/Ibu dosen penguji serta rekan-rekan asisten praktikum.
>
> Perkenalkan, nama saya **[Nama Kamu]**. Pada kesempatan microteaching seleksi calon asisten praktikum hari ini, saya akan membawakan simulasi pengajaran untuk mata kuliah **Pemrograman Web Lanjut (SI118)** pada **Pertemuan ke-16**.
>
> Topik yang akan saya simulasikan adalah: **'Arsitektur MVC pada Framework Laravel: Transformasi dari Spaghetti Code Menuju Kode Terstruktur'**.
>
> Izin untuk memulai simulasi pengajaran ke praktikan, Bapak/Ibu."

---

## 📌 Slide 2: Identifikasi Masalah (Spaghetti Code di PHP Native)
* **Estimasi Waktu**: `01:00 - 02:30` (1.5 Menit)
* **Visual Cue / Sikap**: Tekan `NEXT`, pasang ekspresi interaktif seolah berbicara langsung ke mahasiswa di laboratorium. Gunakan pertanyaan pemantik (*hook*).

### 🗣️ Naskah Bicara:
> "Halo rekan-rekan praktikan! Sebelum kita masuk ke framework Laravel, mari kita ingat kembali tugas-tugas di pertemuan 1 sampai 13 saat kita membuat web dengan PHP Native.
>
> Siapa di antara kalian yang file `index.php` atau `crud.php`-nya pernah tembus sampai 300 hingga 500 baris?
>
> Di baris paling atas ada koneksi database dan query SQL `SELECT` atau `INSERT`.  
> Di tengahnya ada logika perulangan `while`, `foreach`, dan `if-else`.  
> Lalu di bagian bawah bertaburan tag HTML `<table>`, form input, dan script CSS.
>
> Di industri software, pola seperti ini disebut **Spaghetti Code**.  
> Kelihatannya jalan, tapi bayangkan saat website kita bertambah besar atau dikerjakan bersama tim:
> 1. **Sulit di-maintain**: Mengubah 1 baris SQL bisa tanpa sengaja merusak layout tampilan web.
> 2. **Rawan Konflik Tim**: Saat bekerja dengan Git, file yang sama di-edit bersamaan akan menyebabkan banyak *merge conflict*.
> 3. **Testing Sulit**: Kita tidak bisa menguji fungsi logika secara terpisah.
>
> Nah, di sinilah Laravel hadir dengan solusi arsitektur standar industri!"

---

## 📌 Slide 3: Konsep Solusi — MVC (Separation of Concerns)
* **Estimasi Waktu**: `02:30 - 04:00` (1.5 Menit)
* **Visual Cue / Sikap**: Gunakan gestur tangan membagi 3 area (Kiri = Data, Kanan = UI, Tengah = Logika). Tekankan istilah *Separation of Concerns*.

### 🗣️ Naskah Bicara:
> "Laravel menerapkan pola arsitektur **MVC: Model, View, dan Controller**.
>
> Prinsip utamanya adalah **Separation of Concerns** — setiap bagian kode hanya memiliki satu tanggung jawab spesifik:
>
> 1. **MODEL (Pengelola Data)**  
>    Model bertugas berkomunikasi dengan database, mengeksekusi query, dan memvalidasi data. Model tidak tahu dan tidak peduli bagaimana data tersebut akan ditampilkan di layar.
>
> 2. **VIEW (Tampilan Antarmuka)**  
>    View bertugas menampilkan antarmuka visual kepada user. Di Laravel, kita menggunakan template engine **Blade** (HTML & CSS). View hanya menampilkan data yang diterimanya.
>
> 3. **CONTROLLER (Otak Logika)**  
>    Controller adalah jembatan logikanya. Dia yang menerima request dari user, meminta data ke Model, lalu mengoper data tersebut ke View untuk dirender.
>
> Agar rekan-rekan lebih mudah mengingat alurnya, mari kita gunakan analogi sebuah Restoran di slide berikutnya."

---

## 📌 Slide 4: Analogi Mental Model — Operasional Restoran
* **Estimasi Waktu**: `04:00 - 05:30` (1.5 Menit)
* **Visual Cue / Sikap**: Sampaikan analogi dengan intonasi bercerita (*storytelling*) yang terstruktur. Tunjukkan bahwa kamu mampu menjelaskan konsep rumit secara komunikatif.

### 🗣️ Naskah Bicara:
> "Mari kita bayangkan MVC seperti sistem kerja di Restoran:
>
> 1. **User / Browser = Pelanggan**:  
>    Pelanggan datang membuka browser dan ingin memesan menu tertentu.
> 2. **Route (`routes/web.php`) = Kasir & Buku Menu**:  
>    Kasir melihat apa yang diminta pelanggan. *'Oh, user mengakses alamat `/mahasiswa`!'*. Kasir langsung memanggil pelayan yang bertugas.
> 3. **Controller = Pelayan (Waiter)**:  
>    Pelayan mencatat pesanan. Pelayan tidak memasak sendiri di kasir, melainkan langsung berkoordinasi ke dapur.
> 4. **Model & Database = Chef & Kulkas Bahan Makanan**:  
>    Chef mengambil bahan dari database dan memasak datanya. Setelah matang, data diserahkan kembali ke Pelayan (Controller).
> 5. **View (Blade) = Plating Sajian di Piring**:  
>    Pelayan membawa makanan ke meja plating agar dihias rapi di piring, kemudian disajikan ke meja pelanggan di layar browser.
>
> Sangat rapi, bukan? Setiap komponen fokus pada tugasnya masing-masing."

---

## 📌 Slide 5: Request Lifecycle pada Laravel
* **Estimasi Waktu**: `05:30 - 07:00` (1.5 Menit)
* **Visual Cue / Sikap**: Tunjukkan alur horizontal 5 langkah di layar. Jelaskan bagaimana route memanggil method di controller.

### 🗣️ Naskah Bicara:
> "Secara teknis di framework Laravel, siklus request berjalan sebagai berikut:
>
> 1. **Browser** mengirimkan HTTP Request (misalnya `GET /mahasiswa`).
> 2. **`routes/web.php`** menangkap endpoint tersebut dan mengarahkannya ke Controller: `MahasiswaController@index`.
> 3. **Controller** mengeksekusi method `index()`, lalu meminta data ke **Model** (misalnya data dummy atau query database).
> 4. **Model** mengembalikan data mahasiswa ke Controller.
> 5. Controller mengirimkan data tersebut ke **View** dengan perintah:  
>    `return view('mahasiswa', compact('mahasiswa'));`
> 6. File Blade merender HTML dan mengirimkannya kembali sebagai **HTTP Response** ke browser.
>
> Sekarang, mari kita buktikan alur ini secara nyata melalui Live Coding 3 langkah!"

---

## 📌 Slide 6: Demonstrasi Live Coding (3 Langkah Praktis)
* **Estimasi Waktu**: `07:00 - 10:30` (3.5 Menit)
* **Visual Cue / Sikap**: Pindah layar ke VS Code & Terminal. Bicara santai namun pasti saat mengetik kode. Tunjukkan penguasaan perintah CLI dan debugging.

### 🗣️ Naskah Bicara:
> "Kita implementasikan alur ini dalam 3 langkah singkat:
>
> **Langkah 1: Menentukan Route di `routes/web.php`**  
> Kita daftarkan endpoint URL-nya:  
> `Route::get('/mahasiswa', [MahasiswaController::class, 'index']);`  
> *Artinya: saat ada request ke `/mahasiswa`, Laravel akan memanggil method `index` di `MahasiswaController`.*
>
> **Langkah 2: Membuat Controller Menggunakan Artisan CLI**  
> Buka terminal, kita manfaatkan generator Laravel:  
> `php artisan make:controller MahasiswaController`  
> Buka filenya di `app/Http/Controllers/MahasiswaController.php`. Kita buat method:  
> ```php
> public function index() {
>     $mahasiswa = [
>         ['nim' => '23.11.0001', 'nama' => 'Budi Santoso', 'jurusan' => 'Sistem Informasi'],
>         ['nim' => '23.11.0002', 'nama' => 'Siti Aminah', 'jurusan' => 'Sistem Informasi']
>     ];
>     return view('mahasiswa', compact('mahasiswa'));
> }
> ```
>
> **Langkah 3: Membuat Template Tampilan di `resources/views/mahasiswa.blade.php`**  
> Kita siapkan tabel dan tampilkan data menggunakan sintaks Blade `@forelse`:  
> ```html
> @forelse ($mahasiswa as $mhs)
>     <tr>
>         <td>{{ $mhs['nim'] }}</td>
>         <td>{{ $mhs['nama'] }}</td>
>     </tr>
> @empty
>     <tr><td>Data kosong.</td></tr>
> @endforelse
> ```
>
> Kita jalankan `php artisan serve` dan buka di browser: datanya langsung tampil rapi melewati alur Route &rarr; Controller &rarr; View!"

---

## 📌 Slide 7: Kesimpulan, Next Steps & Penutup
* **Estimasi Waktu**: `10:30 - 12:00` (1.5 Menit)
* **Visual Cue / Sikap**: Berikan ringkasan materi, transisi ke materi minggu depan, lalu tutup simulasi dengan kembali menghadap dosen penguji secara formal.

### 🗣️ Naskah Bicara:
> "Sebagai kesimpulan dari materi hari ini:
> 1. **MVC Architecture** membantu kita memisahkan data, antarmuka, dan logika bisnis agar kode bersih, modular, dan terstruktur.
> 2. **Pemisahan Peran** ini memudahkan kerja tim dan meminimalisir potensi bug.
> 3. Pada pertemuan berikutnya (Pertemuan 18–22), kita akan melengkapi siklus ini dengan menghubungkan **Model ke Database MySQL secara otomatis menggunakan Migration dan Eloquent ORM**.
>
> Silakan rekan-rekan praktikan mulai mencoba latihan pada modul praktikum.
>
> Demikian simulasi microteaching yang dapat saya sampaikan. Terima kasih banyak atas perhatian dan waktu dari Bapak/Ibu dosen penguji serta rekan-rekan asisten. Saya siap menerima masukan, evaluasi, ataupun sesi tanya jawab.  
> Wassalamu'alaikum warahmatullahi wabarakatuh / Selamat pagi/siang."
