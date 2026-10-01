# Prompter Presentasi Sistem Rekomendasi: Google News
**Kelompok 7:**
- Yudistira Azfa Dani Wibowo (24.12.3274)
- Nayottama Ivan Rajendra (24.12.3356)
- Husnan Hidayat (24.12.3217)
- Viando Naufa Mikatama (24.12.3248)

---

*(Peran: Pembuka, Pengantar Agenda, Bentuk Rekomendasi, dan Algoritma)*

### [Slide 1: Judul & Anggota Kelompok]
> "Selamat pagi/siang rekan-rekan dan Bapak/Ibu dosen. Hari ini kami dari Kelompok 7 akan membedah bagaimana sistem rekomendasi bekerja pada salah satu platform agregator berita terbesar di dunia, yaitu Google News.
> 
> Di tim kami ada saya Yudistira, bersama tiga rekan saya: Ivan, Husnan, dan Viando."

### [Slide 2: Agenda Pembahasan]
> "(Ganti slide ke agenda)
> Ada tujuh topik bahasan utama yang akan kami ulas secara sistematis. Mulai dari identifikasi bentuk rekomendasi, algoritma di baliknya, data yang diserap, tujuan sistem, pengalaman pengguna, hingga tinjauan kritis dari sisi etika dan privasi."

### [Slide 3: 1. Bentuk Rekomendasi di Google News]
> "Kita mulai dari poin pertama: bentuk rekomendasinya. Saat pengguna membuka Google News, tampilan beritanya dibagi ke dalam empat format utama.
> 
> Pertama, tab **Untuk Anda** atau **For You**. Ini beranda utama yang sepenuhnya dipersonalisasi sesuai minat dan kebiasaan membaca tiap pengguna.
> 
> Kedua, tab **Sorotan** atau **Headlines**. Bagian ini menampilkan berita utama murni berdasarkan wilayah dan bahasa, tanpa sentuhan personalisasi. Jadi, seluruh pengguna di region yang sama akan melihat daftar berita utama yang serupa.
> 
> Ketiga, fitur **Liputan Lengkap** atau **Full Coverage**. Fitur ini merangkum satu isu atau peristiwa besar dari berbagai sudut pandang penerbit, ragam media, dan format pemberitaan.
> 
> Keempat, **Berita Lokal & Ikuti**, yang menyajikan rekomendasi sesuai lokasi yang dipilih (seperti kota asal) serta penerbit favorit yang sengaja di-follow oleh pengguna."

### [Slide 4: 2. Pendekatan Algoritma (Hybrid)]
> "Lalu, bagaimana Google menentukan berita apa yang disodorkan kepada kita? Pendekatan yang digunakan adalah **Hybrid**, yaitu gabungan dari tiga model algoritma.
> 
> Model pertama adalah **Content-Based Filtering**. Algoritma menganalisis entitas berita: nama tokoh, topik peristiwa, dan kata kunci, lalu mencocokkannya dengan jenis artikel yang sering dibaca oleh pengguna.
> 
> Model kedua adalah **Collaborative Filtering**. Sistem melihat tren pembaca lain yang memiliki demografi atau pola minat serupa, sehingga berita yang sedang ramai di kelompok tersebut juga direkomendasikan kepada kita.
> 
> Model ketiga adalah **Rule-Based atau Kontekstual**. Ini aturan pasti yang mengikat, seperti lokasi GPS/IP perangkat, bahasa, dan faktor yang paling krusial dalam berita yaitu kesegaran informasi atau recency.
> 
> Ketiga pendekatan ini dipadukan agar kurasi berita tetap relevan dan aktual. Pembahasan selanjutnya mengenai data yang menjadi bahan bakar algoritma ini akan dilanjutkan oleh rekan saya Ivan. Silakan, Ivan."

---

*(Peran: Sumber Data dan Tujuan Sistem Rekomendasi)*

### [Slide 5: 3. Data yang Menggerakkan Rekomendasi]
> "Terima kasih, Yudis. Sekarang kita masuk ke bagian ketiga: data apa saja yang diserap Google News untuk menjalankan algoritma hybrid tadi.
> 
> Ada tiga lapisan data yang bekerja di sini.
> 
> Lapisan pertama adalah **Data Eksplisit**. Ini data yang secara sadar kita berikan ke sistem. Contohnya topik yang sengaja kita follow, atau interaksi langsung melalui tombol jempol ke atas untuk minta lebih banyak konten sejenis, serta tombol sembunyikan untuk memblokir media tertentu.
> 
> Lapisan kedua adalah **Data Implisit**. Data ini dihimpun secara otomatis dari perilaku kita di dalam aplikasi. Mulai dari artikel mana yang kita klik, berapa lama durasi kita membaca, hingga kedalaman scroll halaman.
> 
> Lapisan ketiga adalah **Data Personal Lintas Ekosistem Google**. Google News memiliki keunggulan masif karena terhubung dengan riwayat Google Search, tontonan YouTube, lokasi real-time, dan aktivitas akun Google melalui fitur Web & App Activity. Sentralisasi inilah yang membuat sistem Google News sangat cepat membaca profil minat kita."

### [Slide 6: 4. Tujuan Sistem Rekomendasi]
> "Lalu, apa sebenarnya tujuan sistem rekomendasi ini dibangun? Di slide 4 kita melihat adanya dua sisi kepentingan: pengguna dan bisnis platform.
> 
> Dari sudut pandang pengguna (**User-Centric**), tujuannya adalah efisiensi dan relevansi. Di tengah jutaan artikel berita setiap hari, sistem membantu pengguna menemukan informasi penting secara cepat dan terarah.
> 
> Namun dari sisi bisnis Google (**Platform-Centric**), target utamanya adalah meningkatkan engagement, yaitu memperpanjang waktu baca, memperbanyak frekuensi buka aplikasi, serta menciptakan ecosystem lock-in agar pengguna tetap betah menggunakan layanan Google.
> 
> Titik keselarasan di antara keduanya: kebutuhan pengguna akan berita yang cepat dan akurat memang terpenuhi. Tetapi ada kekurangannya, informasi yang disajikan cenderung otomatis satu arah, sehingga mengurangi dorongan eksplorasi berita mandiri dari sisi pembaca.
> 
> Selanjutnya, rekan saya Husnan akan mengulas bagaimana sistem ini berdampak langsung pada pengalaman pengguna dan potensi risiko etisnya. Silakan, Husnan."

---

*(Peran: Analisis Pengalaman Pengguna dan Aspek Etika Bagian 1)*

### [Slide 7: 5. Analisis Pengalaman Pengguna (UX)]
> "Terima kasih, Ivan. Teman-teman sekalian, mari kita lihat bagaimana kerja sistem tadi terasa pada pengalaman pengguna sehari-hari.
> 
> Sisi keunggulannya terletak pada akurasi dan kecepatan pembaruan feed yang berlangsung secara real-time. Selain itu, pengguna diberikan kontrol preferensi yang cukup detail untuk mengatur topik maupun memblokir sumber yang tidak diinginkan.
> 
> Namun, ada risiko UX yang sangat penting kita cermati, yaitu **Filter Bubble** atau efek ruang gema (echo chamber). Ketika feed terlalu disesuaikan dengan minat kita, pengguna berisiko terkurung hanya pada opini atau pandangan politik yang mengonfirmasi bias pribadi mereka sendiri.
> 
> Solusi yang dihadirkan Google untuk masalah ini adalah fitur **Sorotan** dan **Liputan Lengkap**. Fitur ini dirancang untuk mengajak pengguna keluar dari gelembung minat pribadinya, dengan menampilkan fakta peristiwa yang sama dari berbagai spektrum media yang berbeda pandangan."

### [Slide 8: 6. Aspek Etika & Dampak Sosial (Bagian 1)]
> "Melanjutkan analisis tadi, di slide 8 kita masuk ke aspek etika dan dampak sosial.
> 
> Poin pertama adalah **Potensi Bias Sumber Berita**. Google menerapkan prinsip kurasi ketat yang disebut **E-E-A-T** (Experience, Expertise, Authoritativeness, Trustworthiness).
> 
> Sisi positifnya: prinsip ini terbukti sangat ampuh menangkal penyebaran hoaks dan berita palsu.
> Namun sisi negatifnya: algoritma secara alamiah akan memprioritaskan media raksasa atau mainstream yang memiliki otoritas SEO tinggi. Akibatnya, jurnalisme independen dan media lokal kecil yang kredibel rentan terpinggirkan dari beranda utama.
> 
> Poin kedua adalah **Risiko Kecanduan**. Di Google News, risiko kecanduan memang lebih rendah dibanding media sosial karena tidak ada video scroll tanpa henti. Namun, notifikasi breaking news yang dikirimkan terus-menerus tetap dirancang untuk memancing Click-Through Rate (CTR), yang berisiko memicu rasa cemas tertinggal berita atau sindrom FOMO.
> 
> Dua isu etika berikutnya, mengenai transparansi algoritma dan privasi data, akan dibahas oleh rekan saya Viando. Silakan, Viando."

---

*(Peran: Aspek Etika Bagian 2, Kesimpulan, dan Penutup)*

### [Slide 9: 6. Aspek Etika & Dampak Sosial (Bagian 2)]
> "Terima kasih, Husnan. Kita lanjutkan ke dua isu etika krusial lainnya: transparansi dan privasi.
> 
> Pertama, fenomena **Kotak Hitam** atau Black Box pada transparansi algoritma. Google memang menerbitkan panduan umum tentang cara kerja seleksi berita mereka. Tetapi formula matematis yang spesifik, seperti pembobotan mengapa artikel dari media A menempati peringkat lebih tinggi dibanding artikel B, tetap dirahasiakan sepenuhnya.
> 
> Kedua, isu **Privasi Data**. Personalisasi tingkat tinggi di Google News berpijak pada sentralisasi data aktivitas kita di seluruh produk Google. Masalahnya, pengumpulan data ini berjalan aktif secara default. Banyak pengguna awam yang tidak menyadari seberapa luas jejak digital mereka diserap hanya untuk menyusun feed berita harian."

### [Slide 10: 7. Kesimpulan]
> "Dari seluruh pembahasan tadi, kita tiba pada kesimpulan di slide 10.
> 
> Google News merupakan agregator berita dengan sistem rekomendasi Hybrid yang sangat adaptif dan berdaya guna tinggi, karena didukung oleh infrastruktur data ekosistem Google.
> 
> Namun ada **pertukaran nilai** yang harus kita pahami:
> Kemudahan yang kita peroleh berupa efisiensi waktu dan relevansi informasi harus dibayar dengan penyerahan privasi data dalam jumlah besar. Pengguna juga dituntut proaktif memeriksa fitur seperti Liputan Lengkap agar tidak terperangkap dalam gelembung opini algoritma."

### [Slide 11: Penutup]
> "(Ganti slide ke penutup)
> Sekian pemaparan dari Kelompok 7 mengenai analisis sistem rekomendasi Google News. Kami membuka sesi tanya jawab untuk rekan-rekan dan Bapak/Ibu dosen. Terima kasih."

---

## Panduan Eksekusi bagi Tim

1. **Estimasi Waktu:** Setiap pembicara rata-rata berbicara selama 1,5 hingga 2 menit. Total waktu presentasi kelompok berkisar antara 7 sampai 8 menit, sangat ideal untuk standar presentasi tugas kuliah.
2. **Kesiapan Transisi:** Ketika pembicara sebelumnya menyebutkan nama pembicara berikutnya, pembicara tujuan langsung mengambil alih mikrofon tanpa jeda canggung.
3. **Penyampaian Alami:** Gunakan teks ini sebagai acuan alur berpikir. Saat di depan kelas, pertahankan kontak mata dengan audiens dan dosen, serta gunakan gestur tangan yang rileks.
