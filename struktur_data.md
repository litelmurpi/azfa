## 📋 Rangkuman Rencana Pembelajaran Semester (RPS)

Berikut adalah poin-poin penting dari mata kuliah ini:

* **Informasi Umum**
    * [cite_start]**Nama Mata Kuliah:** Struktur Data [cite: 7]
    * [cite_start]**Kode MK:** SI025 [cite: 5, 8]
    * [cite_start]**Bobot:** 3 SKS [cite: 13, 14, 15]
    * [cite_start]**Semester:** 3 [cite: 15]
    * [cite_start]**Prasyarat:** Telah lulus mata kuliah Pemrograman Terstruktur (SI018) [cite: 43]

* **Deskripsi Singkat**
    [cite_start]Mata kuliah ini adalah lanjutan dari Pemrograman Terstruktur yang berfokus pada konsep dan teknik pengorganisasian data secara efisien menggunakan bahasa pemrograman **C++**[cite: 38]. [cite_start]Topik utamanya meliputi Array, Struct, Pointer, Sorting (pengurutan), Searching (pencarian), Stack (tumpukan), dan Queue (antrean)[cite: 38].

* **Tujuan Pembelajaran (CPMK)** 🎯
    Setelah menyelesaikan mata kuliah ini, mahasiswa diharapkan mampu:
    1.  [cite_start]**Menjelaskan konsep** struktur data dan algoritma sebagai dasar sistem informasi[cite: 35].
    2.  [cite_start]**Mengimplementasikan** struktur data dan algoritma tersebut ke dalam program C++ untuk studi kasus tertentu[cite: 34].

* **Sistem Penilaian** 📊
    Penilaian dibagi berdasarkan dua capaian utama:
    * [cite_start]**CPMK39 - Pemahaman Konsep (Bobot 63%)** [cite: 100]
        * [cite_start]Tugas Teori: 7% [cite: 100]
        * [cite_start]Kuis: 4% [cite: 100]
        * [cite_start]Ujian Tengah Semester (UTS): 15% [cite: 100]
        * [cite_start]Presentasi Final Project: 17% [cite: 100]
        * [cite_start]Ujian Akhir Semester (UAS): 20% [cite: 100]
    * [cite_start]**CPMK29 - Implementasi Praktik (Bobot 37%)** [cite: 100]
        * [cite_start]Tugas Praktikum: 14% [cite: 100]
        * [cite_start]Responsi (Ujian Praktik): 23% [cite: 100]

---

## 🗺️ Metode Pembelajaran Efektif (Learning Path)

Berikut adalah alur belajar yang runtut untuk membantumu menguasai materi selama satu semester.

### Fase 1: Membangun Fondasi yang Kokoh (Pertemuan 1-8)

Fokus pada "bata" penyusun struktur data. Pemahaman di fase ini adalah kunci.

* [cite_start]**Topik:** Array, Struct, dan Pointer[cite: 46].
* **Cara Belajar:**
    1.  **Pahami Array:** Pelajari cara deklarasi, akses, dan manipulasi elemen menggunakan indeks.
    2.  **Kuasai Struct:** Anggap `Struct` sebagai cara membuat "tipe data"-mu sendiri untuk menggabungkan berbagai jenis data.
    3.  **Jinakkan Pointer:** Pahami bahwa Pointer adalah variabel yang menyimpan **alamat memori**. Gunakan analogi "alamat rumah" untuk mempermudah.
    4.  **Latihan:** Gabungkan ketiganya dalam program sederhana, seperti membuat Array of Struct `Mahasiswa` dan mengaksesnya via Pointer.

### Fase 2: Belajar Mengolah Data (Pertemuan 9-14)

Setelah punya wadah data, sekarang saatnya belajar teknik untuk mengurutkan dan mencari data.

* [cite_start]**Topik:** Algoritma Sorting (Bubble, Selection, Insertion) dan Searching (Sequential, Binary)[cite: 55].
* **Cara Belajar:**
    1.  **Visualisasikan Algoritma:** Coba urutkan 5-7 angka acak di kertas secara manual sesuai alur setiap algoritma `sort` sebelum mulai coding.
    2.  **Pahami Perbedaan:** Ketahui kapan harus menggunakan `Sequential Search` (data acak) dan kapan `Binary Search` lebih efisien (data terurut).
    3.  **Implementasi:** Terjemahkan logika yang sudah kamu visualisasikan ke dalam kode C++.

### Fase 3: Mengenal Struktur Data Abstrak (Pertemuan 16-23)

Belajar struktur data dengan perilaku spesifik untuk menyelesaikan masalah yang lebih kompleks.

* [cite_start]**Topik:** Stack, Queue, dan Linked List[cite: 65, 70].
* **Cara Belajar:**
    1.  **Gunakan Analogi Dunia Nyata:**
        * [cite_start]**Stack:** Tumpukan piring (**LIFO** - Last-In, First-Out)[cite: 75].
        * [cite_start]**Queue:** Antrean kasir (**FIFO** - First-In, First-Out)[cite: 70].
    2.  **Pahami Linked List:** Bayangkan sebagai "gerbong kereta", di mana setiap gerbong (`Node`) tahu letak gerbong di belakangnya (Pointer `next`).

### Fase 4: Aplikasi dan Pembuktian (Pertemuan 24-30)

Mengintegrasikan semua yang telah dipelajari ke dalam sebuah proyek dan ujian akhir.

* [cite_start]**Topik:** Final Project, Responsi Akhir, dan UAS[cite: 75, 80].
* **Cara Belajar:**
    1.  **Cicil Final Project:** Mulai rancang proyek dari jauh-jauh hari dan tentukan struktur data yang paling cocok.
    2.  **Perbanyak Latihan Soal:** Ulangi latihan dari pertemuan-pertemuan sebelumnya untuk persiapan Responsi dan UAS.
    3.  **Review Total:** Buat rangkuman pribadi untuk setiap topik agar lebih mudah mengingat saat ujian.

## contoh penggunaan pointer
```
#include <iostream>
#include <string>

// Langkah 1: Mendefinisikan "cetakan" atau Struct untuk data Mahasiswa.
// Ini sesuai dengan materi di RPS tentang Struct[cite: 46, 50].
struct Mahasiswa {
    int nim;
    std::string nama;
    float ipk;
    float absensi;
};

int main() {
    // Langkah 2: Membuat Array of Struct.
    // Kita membuat array bernama 'kelas' yang bisa menampung 3 data Mahasiswa.
    Mahasiswa kelas[4] = {
        {101, "Budi", 3.45, 80},
        {102, "Citra", 3.80, 90},
        {103, "Dewi", 3.67, 100},
        {104, "Azfa", 4, 75},
    };

    // Langkah 3: Membuat Pointer yang akan menunjuk ke Struct Mahasiswa.
    // Pointer 'ptrMahasiswa' sekarang menyimpan alamat memori dari elemen pertama array 'kelas',
    // yaitu data milik Budi (kelas[0]). Ini adalah konsep inti dari Pointer[cite: 46, 50].
    Mahasiswa *ptrMahasiswa = kelas;

    std::cout << "=== Mengakses Data Mahasiswa Menggunakan Pointer ===" << std::endl;

    // Langkah 4: Menggunakan loop untuk mengakses setiap elemen dalam array via pointer.
    for (int i = 0; i < 4; i++) {
        std::cout << "\nData Mahasiswa ke-" << (i + 1) << std::endl;
        
        // Untuk mengakses member dari struct melalui pointer, kita gunakan operator '->' (panah).
        // 'ptrMahasiswa->nama' artinya "ambil data 'nama' dari alamat yang ditunjuk oleh ptrMahasiswa".
        std::cout << "NIM  : " << ptrMahasiswa->nim << std::endl;
        std::cout << "Nama : " << ptrMahasiswa->nama << std::endl;
        std::cout << "IPK  : " << ptrMahasiswa->ipk << std::endl;
        std::cout << "Absensi  : " << ptrMahasiswa->absensi << std::endl;

        // Pindahkan pointer untuk menunjuk ke elemen berikutnya di dalam array.
        ptrMahasiswa++;
    }

    return 0;
}
