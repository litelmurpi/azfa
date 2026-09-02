# 🎙️ Naskah Teleprompter Microteaching Asprak

> **Mata Kuliah** : Pemrograman Web Lanjut (SI118) — Semester 3  
> **Topik** : Arsitektur MVC & Request Lifecycle pada Framework Laravel  
> **Total Durasi** : 10 – 12 Menit (Total 7 Slide)  
> **Target Audiens** : Praktikan S1 Sistem Informasi / Dosen Penguji Seleksi Asprak  
> **Presenter** : [Nama Kamu]  

---

## 📌 Slide 1: Cover Presentasi
* **Estimasi Waktu**: `00:00 - 01:00` (1 Menit)
* **Visual Cue**: Berdiri tegak, tersenyum ramah, tatap audiens/penguji, gunakan suara lantang dan ramah.

### 🗣️ Naskah Bicara:
> "Halo semuanya! Selamat pagi/siang rekan-rekan praktikan Pemrograman Web Lanjut. Semoga rekan-rekan semua dalam kondisi prima dan bersemangat untuk praktikum hari ini.
>
> Perkenalkan, nama saya **[Nama Kamu]**, yang akan memandu sesi praktikum kita pada Pertemuan ke-16 ini.
>
> Hari ini kita akan masuk ke gerbang pemrograman web modern dengan topik yang sangat fundamental dan krusial, yaitu: **'Arsitektur MVC pada Framework Laravel: Dari Spageti Menuju Kode yang Terstruktur'**.
>
> Mari kita mulai!"

---

## 📌 Slide 2: The Problem: Spaghetti Code
* **Estimasi Waktu**: `01:00 - 02:30` (1.5 Menit)
* **Visual Cue**: Tekan `NEXT` (panah kanan), pasang ekspresi penasaran/reflektif, lemparkan pertanyaan pemantik ke audiens.

### 🗣️ Naskah Bicara:
> "Sebelum kita kenalan dengan Laravel, mari kita refleksi sejenak dari materi pertemuan 1 sampai 13 kemarin saat kita membuat aplikasi PHP Native.
>
> Siapa di antara rekan-rekan yang pernah membuat file `index.php` atau `crud.php` yang isinya sampai 500 baris?
>
> Di baris atas ada koneksi database dan query SQL `SELECT` / `INSERT`.  
> Di baris tengah ada logika perulangan dan `if-else`.  
> Lalu di bagian bawah bertaburan tag HTML `<table>`, `<div>`, dan styling CSS.
>
> Kode seperti ini di dunia industri biasa disebut **'Spaghetti Code'**.  
> Kelihatannya memang berjalan, tapi bayangkan jika aplikasi kita berkembang menjadi puluhan fitur, atau kita harus bekerja secara tim:
> 1. **Hard to Maintain**: Kode sangat sulit dibaca dan dirawat.
> 2. Memperbaiki satu baris bug di SQL bisa tanpa sengaja merusak tampilan layout HTML.
> 3. Rawan konflik (*conflict*) saat berkolaborasi via Git.
>
> Lalu, bagaimana programmer profesional menyelesaikan masalah ini?"

---

## 📌 Slide 3: The Solution: Konsep Arsitektur MVC
* **Estimasi Waktu**: `02:30 - 04:00` (1.5 Menit)
* **Visual Cue**: Tunjukkan gestur tangan membagi tiga bagian secara teratur (Kiri = Data, Kanan = UI, Tengah = Logika).

### 🗣️ Naskah Bicara:
> "Jawabannya adalah memisahkan tanggung jawab kode menggunakan pola arsitektur bernama **MVC: Model, View, dan Controller**.
>
> Konsep dasarnya sederhana: **'Separation of Concerns'** — jangan campur aduk urusan berbeda dalam satu wadah.
>
> Mari kita bagi peran ketiganya:
>
> 1. **MODEL (Data)**  
>    Model bertugas mengurus **DATA**. Semua komunikasi ke database, query, dan aturan validasi data ada di sini. Model tidak peduli bagaimana data akan ditampilkan di layar.
>
> 2. **VIEW (Tampilan)**  
>    View bertugas mengurus **TAMPILAN antarmuka** (User Interface). Di Laravel, kita memakai **Blade Template** (HTML & CSS). View hanya bertugas menampilkan apa yang diberikan kepadanya.
>
> 3. **CONTROLLER (Logika)**  
>    Controller adalah **OTAK atau jembatan logikanya**. Dia yang menerima permintaan dari pengguna, meminta data ke Model, lalu menyuruh View untuk menampilkan hasilnya.
>
> Agar semakin terbayang, mari kita lihat analogi di dunia nyata pada slide berikutnya!"

---

## 📌 Slide 4: Analogi Operasional Restoran
* **Estimasi Waktu**: `04:00 - 05:30` (1.5 Menit)
* **Visual Cue**: Arahkan pandangan ke kartu-kartu analogi. Gunakan intonasi bercerita (*storytelling*) yang hidup dan ekspresif.

### 🗣️ Naskah Bicara:
> "Bayangkan arsitektur MVC seperti operasional sebuah Restoran:
>
> 1. **Pelanggan (User / Browser)**:  
>    Pelanggan datang membuka browser dan ingin memesan menu tertentu.
> 2. **Kasir / Daftar Menu (Route di `routes/web.php`)**:  
>    Menerima URL yang diakses. *'Oh, pelanggan ini mengakses URL `/mahasiswa`!'*. Route langsung memanggil pelayan yang bertugas.
> 3. **Pelayan / Waiter (Controller)**:  
>    Pelayan mencatat pesanan. Pelayan tidak memasak sendiri di meja kasir, melainkan langsung menuju dapur.
> 4. **Chef & Gudang Bahan (Model & Database)**:  
>    Chef di dapur mengambil bahan dari kulkas (Database) dan memasak datanya. Setelah matang, Chef menyerahkan data tersebut kembali ke Pelayan (Controller).
> 5. **Plating & Penyajian (View)**:  
>    Pelayan membawa makanan yang sudah matang ke meja plating (View) agar dihias cantik di atas piring, lalu disajikan langsung ke meja Pelanggan.
>
> Rapi sekali, bukan? Koki fokus masak di dapur, pelayan fokus koordinasi, dan penyaji fokus pada keindahan piring."

---

## 📌 Slide 5: Request Lifecycle pada Laravel
* **Estimasi Waktu**: `05:30 - 07:00` (1.5 Menit)
* **Visual Cue**: Tunjukkan diagram alur horizontal (Step 1 s/d 5). Tekankan arah panah eksekusinya.

### 🗣️ Naskah Bicara:
> "Nah, jika diterjemahkan ke dalam struktur project Laravel, alurnya berjalan seperti ini:
>
> 1. **Browser** mengirimkan HTTP Request (misal: `GET /mahasiswa`).
> 2. Request diterima oleh file **`routes/web.php`**.
> 3. Route meneruskannya ke method di **Controller**, misalnya: `MahasiswaController@index`.
> 4. Controller meminta data ke **Model** (misal: data dummy atau query database).
> 5. Model mengambil data dari **Database MySQL**, lalu mengembalikannya ke Controller.
> 6. Controller melempar data tersebut ke **View** menggunakan fungsi `return view('mahasiswa', compact('mahasiswa'))`.
> 7. **View** (file Blade) merender HTML akhir dan mengirimkannya kembali sebagai **HTTP Response** ke layar browser user.
>
> Sekarang, mari kita buktikan alur ini lewat Live Coding 5 menit!"

---

## 📌 Slide 6: Live Coding Demo (3 Langkah Praktis)
* **Estimasi Waktu**: `07:00 - 10:30` (3.5 Menit)
* **Visual Cue**: Switch layar ke VS Code & Terminal. Tekan `Ctrl + +` untuk memperbesar font editor. Jelaskan baris kode dengan tenang.

### 🗣️ Naskah Bicara:
> "Kita akan mempraktikkan alur MVC ini hanya dalam 3 langkah sederhana:
>
> **LANGKAH 1: DEFINISI ROUTE**  
> Kita buka file `routes/web.php`.  
> Kita tulis:  
> `Route::get('/mahasiswa', [MahasiswaController::class, 'index']);`  
> *Artinya: jika user membuka `/mahasiswa`, serahkan tugas ke MahasiswaController pada fungsi `index`.*
>
> **LANGKAH 2: MEMBUAT CONTROLLER DENGAN ARTISAN**  
> Buka terminal, kita manfaatkan CLI Laravel:  
> `php artisan make:controller MahasiswaController`  
> Kita buka filenya di `app/Http/Controllers/MahasiswaController.php`.  
> Kita buat fungsi `public function index()`.  
> Di dalamnya, kita siapkan data array mahasiswa, lalu kita kirim ke view dengan:  
> `return view('mahasiswa', compact('mahasiswa'));`
>
> **LANGKAH 3: MEMBUAT VIEW BLADE**  
> Kita buat file baru di `resources/views/mahasiswa.blade.php`.  
> Kita buat tabel HTML dan lakukan perulangan data dengan sintaks Blade: `@forelse`.
>
> Mari kita uji di browser: jalankan `php artisan serve` lalu buka `http://localhost:8000/mahasiswa`.  
> Dan lihat... datanya tampil sempurna melalui alur Route &rarr; Controller &rarr; View!"

---

## 📌 Slide 7: Kesimpulan & Langkah Selanjutnya
* **Estimasi Waktu**: `10:30 - 12:00` (1.5 Menit)
* **Visual Cue**: Berikan kesimpulan dengan nada mantap, buka sesi pertanyaan praktikan, lalu tutup dengan salam.

### 🗣️ Naskah Bicara:
> "Tiga poin utama yang kita pelajari hari ini:
> 1. **MVC** memisahkan data (Model), antarmuka (View), dan alur logika (Controller).
> 2. Kode menjadi bersih, modular, scalable, dan siap untuk standar kerja tim industri.
> 3. **Laravel** memudahkan implementasi MVC melalui Routing yang elegan, Artisan CLI, dan Blade engine.
>
> Pada pertemuan berikutnya (Pertemuan 18–22), kita akan menghubungkan Model ini ke **Database MySQL nyata menggunakan Migration dan Eloquent ORM**.
>
> Silakan rekan-rekan mulai mencoba modul praktikum di komputer masing-masing. Jika ada kendala atau pesan error, jangan ragu untuk angkat tangan.
>
> Terima kasih atas perhatian dan antusiasmenya, selamat berpraktik, dan wassalamu'alaikum wr. wb. / Selamat siang!"
