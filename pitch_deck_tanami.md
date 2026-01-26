# 🌱 TANAMI Pitch Deck - Panduan Presenter

Dokumen ini berisi panduan untuk mempresentasikan pitch deck TANAMI Smart Urban Farming IoT System.

---

## 📊 KRITERIA PENILAIAN

| No  | Kriteria                        | Poin | Slide yang Membahas |
| --- | ------------------------------- | ---- | ------------------- |
| 1   | Inovasi Produk                  | 20   | 4, 5, 10            |
| 2   | Fitur Produk                    | 25   | 4, 5, 6, 7, 8       |
| 3   | Fungsionalitas & Kebermanfaatan | 25   | 9, 10, 11           |
| 4   | Potensi Pasar                   | 15   | 2, 3, 12            |
| 5   | Potensi Kelanjutan/Pengembangan | 15   | 14                  |

---

## Slide 1: Cover

**Durasi:** 30 detik

**Poin Utama:**

- Perkenalkan diri dan tim
- Sebutkan nama produk: **TANAMI**
- Tagline: "Menanam tumbuhan, Menyiram harapan, Menumbuhkan masa depan"

**Script:**

> "Selamat pagi/siang. Perkenalkan, kami dari tim TANAMI. Hari ini kami akan mempresentasikan TANAMI - sistem informasi manajemen smart garden berbasis IoT untuk urban farming."

---

## Slide 2: Masalah

**Durasi:** 1 menit | 🎯 **KRITERIA: Potensi Pasar**

**Poin yang harus disampaikan:**

1. ⏰ **Waktu terbatas** - Banyak orang lupa menyiram tanaman, mengakibatkan tanaman layu atau mati
2. 📊 **Tanpa data kuantitatif** - Perawatan berdasarkan "kira-kira", bukan fakta terukur
3. 🔧 **Setup rumit** - Perangkat IoT membutuhkan keahlian teknis untuk konfigurasi IP manual
4. 💰 **Mahal** - Solusi smart garden komersial Rp 500.000 - Rp 2.000.000, tidak terjangkau

**Script:**

> "Ada 4 masalah utama yang dihadapi urban farmers saat ini. Pertama, waktu terbatas sehingga tanaman sering layu karena lupa disiram. Kedua, tidak ada data kuantitatif - semua berdasarkan perkiraan, tidak ada parameter yang terukur. Ketiga, perangkat IoT yang ada terlalu rumit, harus input IP address manual yang berisiko human error. Dan terakhir, solusi komersial yang ada harganya tidak terjangkau - mulai dari 500 ribu sampai 2 juta rupiah."

---

## Slide 3: Target User

**Durasi:** 45 detik | 🎯 **KRITERIA: Potensi Pasar**

**Target pengguna:**

- 🏠 **Urban Farmers** - Berkebun di rumah/apartemen dengan lahan terbatas
- 👨‍💻 **Pekerja Sibuk** - Hobi berkebun tapi tidak punya waktu monitoring rutin
- 🌿 **Pemula Berkebun** - Ingin berkebun tapi takut tanaman mati karena kurang pengalaman
- 🏢 **IoT Enthusiast** - Ingin integrasi dengan ekosistem smart home

**Data Pasar:**

> Tren urban farming meningkat signifikan pasca pandemi, terutama di kalangan milenial dan gen-Z yang tinggal di apartemen/perumahan. Indonesia memiliki potensi pasar urban farming yang besar dengan populasi perkotaan lebih dari 56%.

**Script:**

> "Target pengguna kami adalah urban farmers, pekerja sibuk yang hobi berkebun, pemula yang takut tanamannya mati, dan IoT enthusiast. Pasar ini sangat besar - tren urban farming meningkat pesat pasca pandemi, terutama di kalangan anak muda yang tinggal di perkotaan dengan lahan terbatas. Indonesia dengan populasi urban lebih dari 56% adalah pasar yang sangat potensial."

---

## Slide 4: Solusi

**Durasi:** 1.5 menit | 🎯 **KRITERIA: Inovasi Produk & Fitur Produk**

**3 Fitur Utama:**

1. **Real-Time Monitoring** - Pantau kelembaban tanah, suhu, dan kelembaban udara dari smartphone secara kuantitatif
2. **Auto-Watering** - Penyiraman otomatis dengan logika closed-loop berdasarkan threshold (default 40%)
3. **Plug & Play** - Zero-configuration dengan protokol NSD (Network Service Discovery), koneksi otomatis dalam < 2 detik

**Inovasi yang Ditekankan:**

- Penggunaan **Network Service Discovery (NSD)** - perangkat broadcast identitas `_http._tcp`, aplikasi mendeteksi otomatis via NsdManager
- **Edge Computing** - logika kontrol tertanam di firmware ESP32, berjalan otonom tanpa koneksi internet

**Script:**

> "TANAMI menawarkan 3 solusi utama. Pertama, monitoring real-time dengan data kuantitatif - pengguna bisa melihat persentase kelembaban tanah, suhu dalam Celcius, dan kelembaban udara langsung dari HP. Kedua, auto-watering dengan logika closed-loop - pompa menyala otomatis saat tanah kering di bawah 40% dan mati saat sudah cukup lembab. Ketiga, plug and play - tidak perlu konfigurasi IP manual, cukup nyalakan alat dan buka aplikasi, dalam 2 detik langsung terhubung menggunakan teknologi NSD."

---

## Slide 5: Fitur Unggulan

**Durasi:** 1.5 menit | 🎯 **KRITERIA: Inovasi Produk & Fitur Produk**

**Highlight Inovasi:**

- 🤖 **TanamCare AI** - Sistem diagnosis penyakit tanaman berbasis image processing  
  → User foto daun → Sistem kirim ke AI Cloud → Dapat diagnosis dan rekomendasi penanganan
- 📈 **Data-Driven Decision** - Keputusan perawatan berdasarkan data sensor kuantitatif (%, °C), bukan perkiraan
- 🔋 **Ready-for-Expansion** - Arsitektur modular dengan jalur data disiapkan untuk sensor NPK di masa depan
- ⚡ **Edge Computing** - Logika otomasi embedded di firmware, sistem tetap bekerja meski HP mati atau WiFi putus

**Alur TanamCare AI:**

```
📸 Foto Daun → 📤 Upload ke AI → 🔍 Analisis Image Processing → 📋 Diagnosis + Rekomendasi
```

**Script:**

> "Yang membedakan TANAMI dari kompetitor adalah TanamCare AI - pengguna cukup foto daun yang bermasalah, sistem mengirim ke layanan AI, dan dalam hitungan detik mendapat diagnosis penyakit beserta rekomendasi penanganan. Ini melengkapi data sensor untuk memberikan gambaran kesehatan tanaman yang holistik. Sistem juga menggunakan edge computing, artinya logika penyiraman otomatis berjalan di perangkat, bukan di cloud, sehingga tetap bekerja meski HP mati atau internet putus."

---

## Slide 6: Arsitektur Sistem

**Durasi:** 1 menit | 🎯 **KRITERIA: Fitur Produk**

**Arsitektur 3 Domain Terintegrasi:**

```
┌─────────────────────────────────────────────────────────────────────┐
│                    SISTEM TANAMI - 3 DOMAIN                         │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  🔧 Node IoT            📱 Aplikasi Android      ☁️ AI Cloud        │
│  (Lapangan)             (Pengguna)               (TanamCare)        │
│                                                                     │
│  ┌─────────────┐       ┌─────────────┐        ┌─────────────┐       │
│  │ ESP32       │──────→│ Dashboard   │───────→│ Image       │       │
│  │ + Sensors   │ HTTP  │ Monitoring  │ Upload │ Processing  │       │
│  │ + Actuator  │ JSON  │ + Control   │        │ + Diagnosis │       │
│  └─────────────┘       └─────────────┘        └─────────────┘       │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

**4 Fase Alur Kerja Sistem:**

| Fase              | Deskripsi                                                  |
| ----------------- | ---------------------------------------------------------- |
| 1. **Sensing**    | Sensor membaca parameter fisik (kelembaban, suhu, RH)      |
| 2. **Processing** | ESP32 konversi ADC → %, °C dan evaluasi terhadap threshold |
| 3. **Actuating**  | Relay mengontrol pompa berdasarkan keputusan logika        |
| 4. **Monitoring** | Aplikasi menampilkan dashboard dan menerima input user     |

**Script:**

> "Arsitektur sistem Tanami terdiri dari 3 domain terintegrasi. Pertama, Node IoT di lapangan dengan ESP32 dan sensor-sensor. Kedua, Aplikasi Android untuk dashboard pengguna. Dan ketiga, AI Cloud untuk fitur TanamCare. Alur kerja sistem dibagi menjadi 4 fase: Sensing untuk akuisisi data, Processing untuk logika keputusan, Actuating untuk eksekusi tindakan, dan Monitoring untuk visualisasi ke pengguna."

---

## Slide 7: Hardware - Komponen Tanami IoT Node

**Durasi:** 1.5 menit | 🎯 **KRITERIA: Fitur Produk**

**Komponen Hardware Detail:**

| Komponen                      | Fungsi                         | Spesifikasi Teknis                                                                                                         |
| ----------------------------- | ------------------------------ | -------------------------------------------------------------------------------------------------------------------------- |
| **ESP32**                     | Mikrokontroler utama (Brain)   | WiFi 2.4GHz + Bluetooth 4.2, Web Server, NSD support, GPIO berlimpah, konsumsi daya rendah, penerus ESP8266 dari Espressif |
| **Capacitive Soil Moisture**  | Sensor kelembaban tanah        | Output analog 600-2900, tanpa korosi (kapasitif), semakin basah nilai semakin rendah                                       |
| **DHT11**                     | Sensor suhu & kelembaban udara | Digital single-wire protocol, termistor + sensor kapasitif, biaya rendah                                                   |
| **Relay 5VDC 2-Channel**      | Saklar elektronik              | Optocoupler isolasi, indikator LED, terminal sekrup, kontrol beban AC/DC lebih tinggi                                      |
| **Pompa Air Mini 3V**         | Aktuator penyiraman            | Sentrifugal, ukuran mini (sejempol), impeller kecepatan tinggi                                                             |
| **Baterai 9V / USB 5V Micro** | Sumber daya                    | Portabel (baterai) atau adaptor 5V via Micro-USB                                                                           |
| **Breadboard + Kabel Jumper** | Prototyping                    | Solderless, koneksi mudah male/female                                                                                      |

**Diagram Koneksi Hardware:**

```
┌──────────────────────────────────────────────────────────────┐
│                       SUMBER DAYA                            │
│  ┌─────────┐  ┌─────────┐  ┌─────────┐                       │
│  │5V Source│  │  GND    │  │3.3V Src │                       │
│  └────┬────┘  └────┬────┘  └────┬────┘                       │
│       │            │            │                            │
├───────┼────────────┼────────────┼────────────────────────────┤
│       ↓            ↓            ↓                            │
│  ┌─────────────────────────────────────┐                     │
│  │         ESP32 (Brain)               │                     │
│  │  GPIO 34 ← Analog In (Soil Sensor)  │                     │
│  │  GPIO 4  ← Digital In (DHT11)       │                     │
│  │  GPIO 5  → Digital Out (Relay)      │                     │
│  └─────────────────────────────────────┘                     │
│                                                              │
│  INPUT SENSOR              OUTPUT AKTUATOR                   │
│  ┌────────────────┐        ┌────────────────┐                │
│  │Soil Moisture   │        │Relay 1-Channel │                │
│  │Capacitive      │        │     ↓          │                │
│  └────────────────┘        │Pompa Air Mini  │                │
│  ┌────────────────┐        │     5V         │                │
│  │DHT11 Sensor    │        └────────────────┘                │
│  │Suhu & RH       │                                          │
│  └────────────────┘                                          │
└──────────────────────────────────────────────────────────────┘
```

**Total Biaya Komponen:** **~Rp 150.000 - Rp 200.000**

**Script:**

> "Hardware Tanami IoT Node menggunakan komponen yang affordable. ESP32 sebagai otak sistem - chip canggih dengan WiFi dan Bluetooth built-in dari Espressif. Sensor kelembaban tanah kapasitif yang tidak korosif dengan output analog 600-2900. DHT11 untuk suhu dan kelembaban udara menggunakan protokol single-wire. Relay 2 channel dengan optocoupler untuk isolasi keamanan. Pompa air mini 3V ukuran sejempol yang cukup untuk penyiraman pot. Semua terhubung melalui breadboard tanpa perlu solder. Total biaya komponen kurang dari 200 ribu rupiah - 10x lebih murah dibanding solusi komersial."

---

## Slide 8: Software Stack & Metodologi

**Durasi:** 1 menit | 🎯 **KRITERIA: Fitur Produk**

**Android App (Kotlin Native):**

| Komponen       | Fungsi                                             |
| -------------- | -------------------------------------------------- |
| **NsdManager** | Auto-discovery perangkat via NSD di jaringan lokal |
| **Retrofit**   | HTTP client untuk komunikasi REST API              |
| **SQLite**     | Cache konfigurasi jaringan lokal                   |
| **TanamCare**  | Integrasi AI untuk diagnosis penyakit              |

**ESP32 Firmware (Arduino C++):**

- Web Server ringan menyediakan REST API endpoint
- NSD broadcasting dengan nama `tanami-esp32`
- Logika threshold embedded untuk closed-loop control

**Format Data JSON Response:**

```json
{
  "moisture": 45,
  "temp": 28,
  "humidity": 65,
  "pump": "OFF"
}
```

**Metodologi: Rapid Application Development (RAD)**

| Tahap                   | Fokus                                              |
| ----------------------- | -------------------------------------------------- |
| 1. Requirement Planning | Analisis aliran data (Input → Proses → Output)     |
| 2. User Design          | Arsitektur sistem, algoritma NSD, flowchart logika |
| 3. Construction         | Implementasi firmware ESP32 + Android app          |
| 4. Cutover              | Pengujian validitas data dan keandalan logika      |

**Script:**

> "Untuk software, kami menggunakan pendekatan RAD - Rapid Application Development untuk iterasi cepat. Aplikasi Android ditulis dalam Kotlin native dengan NsdManager untuk auto-discovery. ESP32 menjalankan web server ringan yang menyediakan REST API dalam format JSON. Transisi dari Bluetooth ke WiFi dilakukan untuk meningkatkan reliabilitas pertukaran data. Metodologi RAD memungkinkan kami memvalidasi fungsionalitas sistem dengan cepat."

---

## Slide 9: Logika Otomasi (Edge Computing)

**Durasi:** 1 menit | 🎯 **KRITERIA: Fungsionalitas & Kebermanfaatan**

**Decision Logic Embedded di Firmware:**

```
┌─────────────────────────────────────────────────────────────┐
│  FASE 1: KONVERSI DATA                                      │
│  ─────────────────────                                      │
│  Data mentah sensor → Satuan yang mudah dibaca              │
│  • Kelembaban: ADC 600-2900 → Persentase %                  │
│  • Suhu: Digital → Celcius °C                               │
│                                                             │
│  FASE 2: LOGIKA KOMPARASI                                   │
│  ─────────────────────────                                  │
│  PENYIRAMAN:                                                │
│  IF (Kelembaban < 40%) THEN Status = KERING → Pompa = ON    │
│  IF (Kelembaban ≥ 40%) THEN Status = BASAH  → Pompa = OFF   │
│                                                             │
│  PEMUPUKAN (Future - Sensor NPK):                           │
│  IF (TDS_Value < 500ppm) THEN Nutrient_Pump = ON            │
│  ELSE Nutrient_Pump = OFF                                   │
│                                                             │
│  FASE 3: EKSEKUSI OTOMATIS                                  │
│  ─────────────────────────                                  │
│  ESP32 kirim sinyal → Relay tutup sirkuit → Pompa menyala   │
│  Pompa berhenti OTOMATIS saat target kelembaban tercapai    │
└─────────────────────────────────────────────────────────────┘
```

**Keunggulan Closed-Loop System:**

- ✅ **Hemat air** - Pompa mati otomatis saat target tercapai, tidak boros
- ✅ **Otonom** - Berjalan mandiri meski koneksi ke app terputus (Edge Computing)
- ✅ **Efisien** - Mengurangi beban kerja manual pengguna hingga 90%
- ✅ **Presisi** - Keputusan berdasarkan data sensor, bukan perkiraan

**Script:**

> "Logika otomasi tertanam langsung di firmware ESP32 sebagai edge computing. Prosesnya: pertama, data mentah dari sensor dikonversi ke satuan yang mudah dibaca - persentase untuk kelembaban, Celcius untuk suhu. Kedua, ESP32 membandingkan nilai dengan threshold 40%. Jika di bawah, status KERING dan pompa menyala. Jika di atas, status BASAH dan pompa mati. Ini adalah closed-loop system - pompa berhenti otomatis saat target tercapai. Yang paling penting, sistem ini berjalan otonom tanpa bergantung pada koneksi aplikasi."

---

## Slide 10: Zero-Configuration (Network Service Discovery)

**Durasi:** 1 menit | 🎯 **KRITERIA: Inovasi Produk & Fungsionalitas**

**Teknologi NSD (Network Service Discovery):**

Menggunakan protokol NSD, perangkat menyiarkan identitas dan kapabilitasnya melalui NsdManager di Android. Aplikasi dapat menemukan alamat IP dan Port secara dinamis - menghilangkan kebutuhan konfigurasi alamat statis.

**Prosedur Koneksi Otomatis:**

| Step | Proses                                                                     |
| ---- | -------------------------------------------------------------------------- |
| 1    | ESP32 menyiarkan layanan `_http._tcp` dengan nama `tanami-esp32`           |
| 2    | Aplikasi Android menjalankan Listener NsdManager di background             |
| 3    | Saat layanan terdeteksi, sistem **resolve** IP Address & Port otomatis     |
| 4    | Konfigurasi disimpan di memori lokal (SQLite) untuk akses cepat berikutnya |

**Hasil Pengujian Zero-Config:**

| Metrik                | Hasil                        |
| --------------------- | ---------------------------- |
| ⏱️ Discovery time     | **< 2 detik**                |
| 🔧 Konfigurasi manual | **0 (Zero)**                 |
| ❌ Human error        | **Eliminasi total**          |
| 🔄 Reconnect          | **Otomatis via cache lokal** |

**Perbandingan dengan Metode Konvensional:**

| Aspek      | TANAMI (NSD)                    | Metode Konvensional            |
| ---------- | ------------------------------- | ------------------------------ |
| Setup      | Nyalakan → Buka app → Terhubung | Input IP manual → Test → Retry |
| Waktu      | < 2 detik                       | 2-5 menit                      |
| Error rate | ~0%                             | Tinggi (typo, IP berubah)      |
| User skill | Tidak perlu teknis              | Perlu paham networking         |

**Script:**

> "Yang sangat inovatif dari TANAMI adalah zero-configuration. Menggunakan protokol NSD, ESP32 menyiarkan identitasnya di jaringan WiFi. Aplikasi Android dengan NsdManager menjalankan listener di background. Saat terdeteksi, sistem resolve IP dan Port otomatis - semua dalam waktu kurang dari 2 detik. Pengguna tidak perlu tahu IP address, tidak perlu setting manual. Ini mengeliminasi human error total dan membuat sistem benar-benar plug and play - cocok untuk pengguna non-teknis."

---

## Slide 11: Hasil Testing & Validasi

**Durasi:** 1 menit | 🎯 **KRITERIA: Fungsionalitas & Kebermanfaatan**

**Pengujian Sistem (Cutover Phase):**

| Test Case        | Hasil   | Keterangan Detail                                               |
| ---------------- | ------- | --------------------------------------------------------------- |
| Auto-Discovery   | ✅ PASS | IP resolved dalam waktu rata-rata < 2 detik                     |
| Sensor Accuracy  | ✅ PASS | Data tampil di app sesuai kondisi fisik tanah (validasi manual) |
| Auto-Watering    | ✅ PASS | Pompa aktif konsisten saat kelembaban < threshold 40%           |
| Closed-Loop      | ✅ PASS | Pompa mati otomatis saat kondisi ideal tercapai                 |
| Edge Computing   | ✅ PASS | Sistem tetap berjalan saat koneksi app terputus                 |
| TanamCare AI     | ✅ PASS | Diagnosis penyakit tanaman dari foto berhasil                   |
| Prosedur Koneksi | ✅ PASS | Berjalan otomatis tanpa error, cache untuk reconnect cepat      |

**Validitas Data:**

```
Kondisi Fisik Tanah    →   Nilai Sensor    →   Status di App
────────────────────────────────────────────────────────────
Tanah kering           →   < 40%           →   🔴 KERING
Tanah lembab           →   40-70%          →   🟢 IDEAL
Tanah basah            →   > 70%           →   🔵 BASAH
```

**Kesimpulan Testing:**

> ✅ Sistem TANAMI **berhasil memenuhi fungsi** sebagai Sistem Informasi Manajemen untuk urban farming  
> ✅ Logika otomasi **efektif** menjalankan operasional perawatan secara mandiri  
> ✅ Protokol NSD **terbukti menyederhanakan** prosedur teknis - layak dikategorikan sebagai Plug & Play

**Script:**

> "Kami sudah melakukan pengujian menyeluruh pada fase Cutover dan semua test case berhasil. Auto-discovery bekerja dalam 2 detik. Data sensor akurat dan tervalidasi dengan kondisi fisik di lapangan. Pompa aktif dan mati sesuai threshold secara konsisten. Edge computing berfungsi - sistem tetap jalan meski koneksi terputus. Dan TanamCare AI berhasil mendiagnosis penyakit dari foto. Kesimpulannya, TANAMI berhasil sebagai sistem informasi manajemen yang efektif dan mudah dioperasikan."

---

## Slide 12: Keunggulan Kompetitif

**Durasi:** 1 menit | 🎯 **KRITERIA: Potensi Pasar**

**Perbandingan dengan Kompetitor:**

| Aspek               | 🌱 TANAMI                                  | ❌ Kompetitor                      |
| ------------------- | ------------------------------------------ | ---------------------------------- |
| 💰 **Harga**        | **< Rp 200.000** (DIY-Friendly)            | Rp 500.000 - Rp 2.000.000          |
| 🔧 **Setup**        | **Plug & Play** (NSD < 2 detik)            | Konfigurasi IP manual, error-prone |
| 🎯 **Target**       | **Indonesia** (konteks lokal)              | Global/Generic                     |
| 🔌 **Arsitektur**   | **Modular** (jalur untuk sensor NPK ready) | Fixed, tidak bisa upgrade          |
| 🤖 **AI**           | **TanamCare** (diagnosis + rekomendasi)    | Tidak ada fitur AI                 |
| 📡 **Konektivitas** | **Edge Computing** (otonom)                | Cloud-dependent (butuh internet)   |
| 📊 **Data**         | **Real-time & Kuantitatif** (%, °C)        | Indikator sederhana (high/low)     |
| 🔋 **Portabilitas** | **Baterai 9V atau USB 5V**                 | Tergantung adaptor listrik         |

**Value Proposition:**

```
┌─────────────────────────────────────────────────────────────────┐
│  "Dengan harga 1/10 dari kompetitor, TANAMI menawarkan         │
│   fitur yang LEBIH LENGKAP: AI diagnosis, zero-config,         │
│   dan edge computing yang tidak dimiliki kompetitor."          │
└─────────────────────────────────────────────────────────────────┘
```

**Script:**

> "Dibanding kompetitor, TANAMI unggul di hampir semua aspek. Harga 10x lebih murah - kurang dari 200 ribu versus 500 ribu sampai 2 juta. Setup plug and play dalam 2 detik tanpa konfigurasi manual yang error-prone. Fokus di pasar Indonesia dengan konteks lokal. Arsitektur modular yang sudah disiapkan jalur untuk sensor NPK. Punya fitur AI diagnosis TanamCare yang tidak dimiliki kompetitor. Dan menggunakan edge computing sehingga berjalan otonom tanpa bergantung internet. Dengan harga sepersepuluh, kami menawarkan fitur yang lebih lengkap."

---

## Slide 13: Unique Selling Points (USP)

**Durasi:** 45 detik | 🎯 **KRITERIA: Inovasi Produk**

**4 USP TANAMI:**

| #   | USP                                  | Detail                                                  |
| --- | ------------------------------------ | ------------------------------------------------------- |
| 🇮🇩  | **Dirancang untuk Indonesia**        | Konteks urban farming lokal, bahasa Indonesia           |
| 🔌  | **Zero-Configuration (NSD)**         | Plug & Play < 2 detik, eliminasi human error            |
| 🤖  | **AI-Powered Diagnosis (TanamCare)** | Foto daun → Diagnosis penyakit + Rekomendasi penanganan |
| 💰  | **Affordable & DIY-Friendly**        | < Rp 200.000, bisa dirakit sendiri, edukasi IoT         |

**Tagline:**

> 🌱 _"TANAMI - Menanam tumbuhan, Menyiram harapan, Menumbuhkan masa depan"_

**Script:**

> "Inilah 4 USP TANAMI. Pertama, dirancang khusus untuk konteks Indonesia - bukan produk generik global. Kedua, zero-config yang membuat siapapun bisa menggunakan tanpa keahlian teknis - dalam 2 detik langsung terhubung. Ketiga, fitur AI TanamCare untuk diagnosis penyakit yang melengkapi data sensor. Dan keempat, harga terjangkau dan DIY-friendly - bisa dirakit sendiri sebagai media edukasi IoT."

---

## Slide 14: Roadmap & Business Model

**Durasi:** 1.5 menit | 🎯 **KRITERIA: Potensi Kelanjutan/Pengembangan**

### 🚀 Phase 2: Cloud Integration

- ☁️ **Cloud Database** - Penyimpanan data historis untuk analisis tren jangka panjang (Data Analytics)
- 📊 **Dashboard Analytics** - Visualisasi tren pertumbuhan dan insight kesehatan tanaman
- 🔔 **Push Notifications** - Notifikasi real-time saat ada anomali atau kondisi kritis

### ⚡ Phase 3: Scale Up & Efficiency

- 📡 **MQTT Protocol** - Efisiensi bandwidth untuk skala perkebunan besar (menggantikan HTTP polling)
- 🌱 **Sensor NPK** - Monitoring nutrisi tanah untuk pemupukan presisi (jalur sudah disiapkan)
- 🏭 **Multi-node Support** - Satu aplikasi untuk mengelola beberapa perangkat sekaligus

### 💼 Business Expansion

| Produk/Layanan            | Target Market                         | Model                   |
| ------------------------- | ------------------------------------- | ----------------------- |
| 🛒 **DIY Kit**            | Retail, hobbyist, maker community     | Penjualan paket lengkap |
| 🏢 **Enterprise**         | Greenhouse, urban farm skala besar    | B2B licensing           |
| 📚 **Education Platform** | Sekolah, kampus, komunitas IoT        | Modul pembelajaran      |
| ☁️ **Cloud Premium**      | Power user, data analytics enthusiast | Subscription bulanan    |

**Monetisasi:**

```
Revenue Streams:
├── Hardware: DIY Kit penjualan retail
├── Software: Subscription cloud premium
├── Service: B2B licensing & konsultasi
└── Education: Modul pembelajaran IoT
```

**Script:**

> "Pengembangan selanjutnya sudah kami rencanakan dengan jelas. Phase 2, integrasi cloud untuk menyimpan data historis, data analytics, dan push notification saat ada anomali. Phase 3, implementasi protokol MQTT untuk efisiensi bandwidth, sensor NPK yang jalurnya sudah kami siapkan, dan dukungan multi-node. Untuk bisnis, kami akan menjual DIY kit untuk retail, menawarkan solusi enterprise untuk greenhouse besar, mengembangkan platform edukasi IoT, dan subscription cloud premium. Monetisasi melalui penjualan hardware, subscription software, B2B licensing, dan modul edukasi."

---

## Slide 15: Thank You & Contact

**Durasi:** 30 detik

**Tim TANAMI:**

> _"Menanam tumbuhan, Menyiram harapan, Menumbuhkan masa depan"_

**Kontak:**

| Platform     | Handle/Link                |
| ------------ | -------------------------- |
| 📧 Email     | tanamiuniverse10@gmail.com |
| 📷 Instagram | @tanami_tech               |
| 🎥 YouTube   | @Tanami_Universe10         |

**Call to Action:**

> 🌱 Mari wujudkan urban farming yang **affordable, smart, dan accessible** untuk semua!

**Script:**

> "Demikian presentasi dari kami. TANAMI - sistem informasi manajemen smart garden berbasis IoT yang affordable dengan harga kurang dari 200 ribu, mudah digunakan dengan teknologi plug and play, dan dilengkapi AI untuk diagnosis penyakit. Kami bertekad mewujudkan urban farming yang accessible untuk semua kalangan. Terima kasih atas perhatiannya. Apakah ada pertanyaan?"

---

## 📋 CHECKLIST SEBELUM PRESENTASI

- [ ] Cek koneksi WiFi (untuk demo jika ada)
- [ ] Siapkan backup slide dalam format PDF
- [ ] Bawa prototype hardware Tanami IoT Node
- [ ] Siapkan video demo sebagai backup
- [ ] Test TanamCare AI dengan foto daun
- [ ] Latihan presentasi minimal 2x untuk timing
- [ ] Siapkan jawaban untuk pertanyaan umum (lihat FAQ di bawah)

## ❓ FAQ - Antisipasi Pertanyaan

| Pertanyaan                               | Jawaban Singkat                                                                       |
| ---------------------------------------- | ------------------------------------------------------------------------------------- |
| Kenapa tidak pakai Bluetooth?            | WiFi lebih reliable untuk data real-time, range lebih luas, NSD untuk auto-discovery  |
| Bagaimana jika WiFi mati?                | Edge computing - logika tetap jalan di ESP32, data di-cache untuk sync saat reconnect |
| Apakah bisa untuk outdoor/cuaca ekstrem? | Perlu enclosure waterproof (pengembangan selanjutnya)                                 |
| Bagaimana dengan sensor NPK?             | Jalur sudah disiapkan, tinggal integrasi di Phase 3                                   |
| Kenapa lebih murah dari kompetitor?      | DIY approach, komponen generik, open-source firmware, tanpa markup branding           |

## ⏱️ TOTAL DURASI

| Bagian                                 | Durasi        |
| -------------------------------------- | ------------- |
| Slide 1-5 (Intro, Masalah & Solusi)    | ~5 menit      |
| Slide 6-9 (Teknis & Otomasi)           | ~5 menit      |
| Slide 10-13 (Testing, USP & Kompetisi) | ~4 menit      |
| Slide 14-15 (Roadmap & Closing)        | ~2 menit      |
| **TOTAL**                              | **~16 menit** |
| Q&A                                    | ~5-10 menit   |

---

_Selamat mempresentasikan! 🌱_
