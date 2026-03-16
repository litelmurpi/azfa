# PROPOSAL WEBSITE

# UrbanInsight AI — Platform WebGIS Berbasis AI untuk Perencanaan Kota Berkelanjutan

---

## A. Halaman Judul

| Atribut | Detail |
|---|---|
| **Judul Website** | UrbanInsight AI |
| **Nama Tim** | *(isi nama tim)* |
| **Nama Anggota Tim** | 1. *(ML/AI Engineer)*  2. *(Backend/Geospatial Engineer)*  3. *(Frontend/UI Engineer)* |
| **Asal Institusi/Organisasi** | *(isi institusi)* |
| **Kategori Kompetisi** | Web Development — Smart City & Environmental Tech |

---

## B. Latar Belakang

### Masalah Utama

Urbanisasi masif di kota-kota Indonesia (Jakarta, Surabaya, Bandung, Medan) menghadirkan tiga krisis lingkungan yang saling berkaitan dan semakin parah setiap tahunnya:

1. **Urban Heat Island (UHI):** Suhu permukaan di kawasan perkotaan dapat mencapai **1–7°C lebih tinggi** dibandingkan area pedesaan akibat dominasi beton, aspal, dan minimnya vegetasi (Rizwan et al., 2008; Oke, 1982). Hal ini berdampak langsung pada kesehatan masyarakat, peningkatan konsumsi energi pendingin, dan penurunan kualitas hidup.

2. **Risiko Banjir Periodik:** Curah hujan ekstrem yang dikombinasikan dengan rendahnya kapasitas drainase, tingginya imperviousness lahan (permukaan kedap air), dan kedekatan dengan badan air menciptakan siklus banjir berulang yang merendam pemukiman padat penduduk. Kerugian ekonomi dan sosial akibat banjir kota terus meningkat setiap tahun.

3. **Ketimpangan Ruang Terbuka Hijau (RTH):** Akses terhadap taman dan ruang hijau tidak merata secara spasial. Kelurahan-kelurahan padat dan miskin seringkali menjadi *"green desert"* — wilayah yang paling miskin RTH namun justru paling membutuhkan intervensi penghijauan.

### Urgensi Solusi

Perencana kota dan pembuat kebijakan di Indonesia **tidak memiliki tools berbasis data dan AI** yang mampu secara bersamaan menganalisis ketiga risiko ini dan memberikan **rekomendasi tindakan konkret**. Tools yang ada saat ini (BNPB inaRISK, Google Earth Engine, platform GIS konvensional) hanya bersifat *deskriptif* atau *prediktif* — menampilkan kondisi yang ada tanpa menjawab pertanyaan paling kritis:

> **"Di mana harus bertindak, dan tindakan apa yang memberikan dampak paling besar?"**

UrbanInsight AI hadir untuk menjawab celah tersebut dengan pendekatan **prescriptive analytics** — bukan hanya memvisualisasikan masalah, tetapi secara aktif merekomendasikan solusi optimal menggunakan Reinforcement Learning.

### Perbandingan dengan Website Serupa

| Platform | Kekuatan | Kelemahan vs UrbanInsight AI |
|---|---|---|
| **Google Earth Engine** | Platform analisis geospasial paling lengkap | Tidak accessible sebagai web app publik, tidak ada simulasi RL, butuh coding skill |
| **BNPB inaRISK** | Data bencana nasional Indonesia resmi | Hanya modul banjir/bencana, tidak ada ML prediktif, tidak ada rekomendasi aksi |
| **TreePlotter (AS)** | Inventaris dan manajemen pohon kota | Hanya inventaris pohon, tidak ada optimasi multi-objective berbasis RL |
| **Urban Climate Analyzer** | Riset akademik UHI dan iklim kota | Tidak dalam bentuk production-ready WebGIS yang interaktif dan multi-user |

**Peluang:** Tidak satupun platform yang ada menggabungkan analisis panas, banjir, dan green equity secara simultan dengan rekomendasi aksi berbasis AI seperti yang ditawarkan UrbanInsight AI.

### Dampak Website

- **Bagi Perencana Kota (BAPPEDA):** Pengambilan keputusan RTRW dan rencana penghijauan berdasarkan data, bukan intuisi
- **Bagi Pemerintah Daerah:** Alokasi anggaran penghijauan yang tepat sasaran ke wilayah yang paling membutuhkan
- **Bagi Masyarakat:** Pengurangan dampak UHI dan banjir, terutama di kawasan padat penduduk yang selama ini menjadi green desert
- **Bagi Lingkungan:** Penempatan pohon yang optimal secara ilmiah memaksimalkan dampak ekologis dari setiap pohon yang ditanam

---

## C. Tujuan, Manfaat, dan Solusi

### Tujuan

Membangun platform WebGIS berbasis AI yang mampu:
1. Menganalisis risiko iklim urban (panas, banjir, ketimpangan hijau) secara terpadu untuk **seluruh kota di Indonesia** menggunakan data geospasial resolusi tinggi
2. Merekomendasikan intervensi spasial optimal (penempatan pohon) menggunakan Reinforcement Learning dengan multi-objective optimization
3. Menyediakan antarmuka interaktif dan accessible bagi perencana kota tanpa membutuhkan keahlian teknis khusus

### Manfaat

| Penerima Manfaat | Manfaat |
|---|---|
| **Perencana Kota / BAPPEDA** | Analisis data terpadu untuk mendukung RTRW dan rencana penghijauan |
| **Dinas Lingkungan Hidup** | Identifikasi *Green Desert* dan perencanaan intervensi hijau berbasis prioritas |
| **Pembuat Kebijakan** | Overview kondisi kota secara real-time dan dashboard prioritas intervensi |
| **Akademisi & Peneliti** | Dataset geospasial dan model yang dapat direplikasi untuk riset urban & lingkungan |
| **LSM & Jurnalis Lingkungan** | Data visual yang transparan untuk advokasi kebijakan lingkungan |

### Solusi

UrbanInsight AI menyelesaikan masalah melalui 4 modul AI terintegrasi:

1. **Modul Urban Heat Prediction** — Memprediksi Land Surface Temperature (LST) per grid menggunakan data satelit dan variabel iklim mikro (kepadatan bangunan, kepadatan vegetasi) dengan formula deterministik yang dikalibrasi dari literatur ilmiah.

2. **Modul Flood Risk Scoring** — Menghitung skor probabilitas risiko banjir (0–100) per grid berdasarkan curah hujan, soil moisture, kedekatan badan air, imperviousness lahan, dan kepadatan vegetasi.

3. **Modul Green Equity Index** — Mengukur ketimpangan akses RTH secara spasial dan kuantitatif menggunakan kepadatan bangunan vs kepadatan ruang hijau per grid, menghasilkan skor equity 0–100.

4. **Modul RL Optimal Tree Placement** *(Fitur Unggulan)* — Agen PPO (Proximal Policy Optimization) yang secara cerdas memilih lokasi penanaman pohon untuk memaksimalkan dampak terhadap penurunan suhu (35%), pengurangan risiko banjir (30%), dan peningkatan green equity (25%) — dengan constraint budget.

---

## D. Batasan Website

### Pengguna Utama
- **Primary:** Perencana kota (BAPPEDA), pembuat kebijakan, Dinas Lingkungan Hidup
- **Secondary:** Akademisi, peneliti urban, konsultan perencanaan kota, jurnalis lingkungan

### Fungsi Inti Situs Web
- Pencarian dan analisis **seluruh kota di Indonesia** berdasarkan nama (geocoding otomatis via Nominatim API dengan boundary polygon clipping)
- Visualisasi peta interaktif multi-layer (Heat, Flood, Green Equity, Populasi)
- Simulasi RL penempatan pohon dengan animasi real-time dan statistik before/after
- Dashboard analitik dengan grafik dan statistik kota
- Export hasil analisis (GeoJSON, CSV)

### Keterbatasan Situs Web
- Mendukung pencarian **semua kota di Indonesia** (geocoding dinamis), namun data kota pilot utama untuk demo adalah Surabaya
- Tidak ada integrasi sensor IoT real-time (masuk roadmap v2)
- Tidak ada aplikasi mobile native (iOS/Android)
- Tidak ada sistem akun pengguna atau pembayaran
- Model prediksi menggunakan *simplified transition model*, bukan simulasi biofisik penuh
- Grid resolusi 100m — detail intra-grid mungkin hilang untuk area sangat kecil

### Platform yang Didukung
- ✅ **Desktop** (dioptimalkan — penggunaan utama)
- ✅ **Tablet** (responsif)
- ⚠️ **Mobile** (fungsional, namun pengalaman terbaik di layar lebar karena kompleksitas peta)

---

## E. Website Features & Uniqueness

### Fitur Utama

| Fitur | Deskripsi |
|---|---|
| **Interactive Map Explorer** | Peta WebGIS interaktif berbasis MapLibre GL JS dengan multi-layer toggle (Heat, Flood, Equity) |
| **City Search & Geocoding** | Pencarian **seluruh kota di Indonesia** secara otomatis dengan boundary polygon clipping menggunakan Nominatim API |
| **Heat Choropleth** | Heatmap suhu permukaan per grid dengan tooltip detail (LST, Building Density, Green Density) |
| **Flood Risk Zones** | Peta risiko banjir 4 kategori (Rendah–Sangat Tinggi) dengan color-coded choropleth |
| **Green Equity Map** | Visualisasi ketimpangan RTH per grid dengan highlight area Green Desert |
| **RL Simulation** | Simulasi penempatan pohon optimal dengan kontrol budget dan statistik before/after |
| **Analytics Dashboard** | Dashboard data kota lengkap dengan grafik Recharts (bar, radar, distribusi) |
| **Map Legend** | Legenda peta dinamis yang menyesuaikan layer aktif |
| **Design System** | Sistem desain konsisten dengan komponen reusable |

### Keunikan Website

1. **RL-Powered Prescriptive Simulation** — Satu-satunya platform WebGIS yang menggunakan Reinforcement Learning untuk merekomendasikan di mana harus menanam pohon, bukan hanya menampilkan kondisi.
2. **Multi-Objective Optimization** — RL agent mengoptimasi 3 tujuan sekaligus (suhu + banjir + green equity) dengan constraint anggaran realistis.
3. **Real-Time Data API Pipeline** — Data cuaca dan geospasial diambil secara real-time dari Open-Meteo dan OSM Overpass, bukan data statis.
4. **Grid-Based Urban Intelligence** — Kota direpresentasikan sebagai grid spasial dengan data yang dihitung per cell, memungkinkan granularitas tinggi.

### Nilai Inovasi

UrbanInsight AI menawarkan paradigma baru: **dari "melihat masalah" menjadi "merekomendasikan solusi".** Ini adalah lompatan dari *descriptive analytics* (apa yang terjadi?) ke *prescriptive analytics* (apa yang harus dilakukan?) — sebuah pendekatan yang belum ada di ekosistem tools perencanaan kota Indonesia.

---

## F. Teknologi

### Frontend
| Teknologi | Fungsi |
|---|---|
| **React JS 19** | Library utama UI dengan component-based architecture |
| **Vite 7** | Build tool ultra-fast dengan HMR dan code-splitting |
| **TailwindCSS 4** | Utility-first CSS framework untuk styling responsif |
| **MapLibre GL JS** | Engine peta WebGIS open-source, high-performance |
| **react-map-gl** | Wrapper React untuk MapLibre GL JS |
| **Recharts** | Library charting deklaratif untuk dashboard analitik |
| **D3.js** | Visualisasi data custom dan grafik lanjutan |
| **Framer Motion** | Animasi UI deklaratif (fade-in, stagger, transitions) |
| **GSAP (GreenSock)** | Animasi scroll-driven dan parallax effects |
| **Lucide React** | Icon system modern dan konsisten |
| **SWR** | Data fetching dengan caching dan revalidation otomatis |
| **Axios** | HTTP client untuk komunikasi dengan backend API |

### Backend
| Teknologi | Fungsi |
|---|---|
| **Python 3** | Bahasa pemrograman utama backend |
| **FastAPI** | Framework API asinkron dengan auto-generated OpenAPI docs |
| **httpx** | HTTP client asinkron untuk API calls eksternal |
| **GeoPandas** | Analisis data geospasial (grid generation, spatial joins) |
| **Shapely** | Operasi geometri (polygon clipping, buffering, overlay) |
| **NumPy** | Komputasi numerik intensif (matrix operations) |
| **Uvicorn** | ASGI server untuk menjalankan FastAPI |

### Database & Caching
| Teknologi | Fungsi |
|---|---|
| **In-Memory TTL Cache** | Custom caching system dengan Time-To-Live (Geocoder: 24h, Weather: 10min, OSM: 1h) |
| **Supabase (PostgreSQL)** | Database relasional dengan PostGIS extension *(planned)* |

### API / Additional Integrations
| API | Data yang Digunakan | Fungsi |
|---|---|---|
| **Open-Meteo API** | Suhu, curah hujan, soil moisture, kelembapan | Sumber data cuaca real-time untuk kalkulasi Heat dan Flood Risk |
| **OSM Overpass API** | Building footprints, taman, hutan, badan air | Sumber data geospasial untuk kepadatan bangunan, green space, dan water proximity |
| **Nominatim API** | Geocoding, bounding box, polygon kota | Pencarian dan identifikasi boundary kota untuk clipping grid |

---

## G. Implementasi dan Pengujian

### Proses Pengujian Website

1. **Unit Testing Backend**
   - Diagnostic script ([diag_grid.py](file:///var/www/html/gis-azfa/backend/diag_grid.py)) untuk memverifikasi formula microclimate synthesis
   - Test data integration scripts untuk validasi pipeline end-to-end
   - Verifikasi bahwa flood risk score, equity score, dan populasi dihitung berdasarkan data nyata (bukan random)

2. **API Testing**
   - Pengujian endpoint `/api/health`, `/api/analysis/heat`, `/api/analysis/search`
   - Validasi response time < 2 detik untuk query grid
   - Pengujian error handling dan graceful fallback saat API eksternal gagal

3. **Frontend Testing**
   - Manual testing cross-browser (Chrome, Firefox, Safari)
   - Responsive testing pada breakpoint desktop, tablet, dan mobile
   - Verifikasi interaksi peta (zoom, pan, hover tooltip, layer toggle)

4. **Integration Testing**
   - End-to-end flow: search kota → fetch data → generate grid → render peta
   - Verifikasi konsistensi data antara backend response dan frontend visualization
   - Performance profiling untuk memastikan < 2 detik response time

### Metode Pengumpulan Umpan Balik

- **User Testing:** Demo langsung kepada calon pengguna (perencana kota) dan pengumpulan feedback kualitatif
- **Bug Reporting:** Issue tracking melalui GitHub Issues
- **Evaluasi Internal:** Review kode oleh tim dan iterasi berdasarkan temuan teknis
- **Performance Monitoring:** Logging server-side (Uvicorn) untuk monitoring response time dan error rate

---

## H. Mockup Website

> **Catatan:** Lampirkan wireframe, mockup UI/UX, dan user flow pada dokumen proposal final. Mockup harus mencakup:
> - Landing Page dengan hero section dan penjelasan 4 modul
> - Map Explorer dengan multi-layer visualization
> - Simulation page dengan kontrol RL dan before/after comparison
> - Analytics Dashboard dengan grafik dan statistik
> - User Flow diagram: Landing → Search Kota → Map Explorer → Toggle Layer → Run Simulation → View Results

---

## I. Attachment

Dokumen pendukung yang perlu dilampirkan:

1. **Research Results:** Referensi literatur ilmiah yang mendasari model (Bowler et al., 2010; Berland et al., 2017; Zölch et al., 2016; Wolch et al., 2014; dll.)
2. **Data Sources:** Daftar lengkap sumber data (Open-Meteo, OSM, Landsat, Sentinel-2, CHIRPS, BNPB, WorldPop, SRTM)
3. **Architecture Diagram:** Diagram arsitektur 3-tier (Frontend → Backend API → AI/ML Service → Database → External Sources)

> **Format Proposal:** PDF  
> **Filename:** `TeamName_WebDevelopment_Proposal_2026.pdf`

---

## J. Repositori GitHub

Repositori GitHub harus berisi:

```
gis-azfa/
├── backend/
│   ├── app/
│   │   ├── api/
│   │   │   └── endpoints.py          # FastAPI route handlers
│   │   ├── services/
│   │   │   ├── cache.py              # TTL Cache system
│   │   │   ├── geocoder.py           # Nominatim geocoding
│   │   │   ├── grid.py               # Grid generation & microclimate synthesis
│   │   │   ├── open_meteo.py         # Weather data fetching
│   │   │   └── osm.py               # OSM Overpass data fetching
│   │   └── main.py                   # FastAPI app initialization
│   ├── requirements.txt              # Python dependencies
│   └── diag_grid.py                  # Diagnostic/testing script
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   │   ├── charts/               # Recharts visualization components
│   │   │   ├── common/               # Shared UI components (Button, Card, etc.)
│   │   │   ├── layout/               # Navbar, Sidebar, Footer
│   │   │   ├── map/                  # MapContainer, MapLegend
│   │   │   └── simulation/           # SimulationControls, SimulationStats
│   │   ├── context/                  # React Context (LayerContext)
│   │   ├── hooks/                    # Custom React hooks
│   │   ├── pages/                    # Landing, MapExplorer, Simulation, Analytics, About
│   │   ├── services/                 # API client (axios)
│   │   └── utils/                    # Utility functions
│   ├── package.json
│   └── vite.config.js
├── prd_urban_v2.md                   # Product Requirements Document
├── .gitignore
└── README.md
```

- ✅ Kode sumber lengkap (frontend + backend)
- ✅ Struktur folder yang rapi dan terorganisir
- ✅ Riwayat commit yang terdokumentasi
- ✅ README file dengan instruksi setup dan penggunaan

---

## K. Demo Video

### Isi Video Demo (Format: MP4)

| Segmen | Durasi Est. | Isi |
|---|---|---|
| **Perkenalan Tim** | ~1 menit | Nama tim, anggota, dan peran masing-masing |
| **Gambaran Masalah** | ~2 menit | 3 krisis urban (UHI, Banjir, Green Desert) dan gap tools yang ada |
| **Fitur Website** | ~3 menit | Demo lengkap: Landing → Map Explorer → Layer Toggle → Analytics |
| **Demonstrasi Sistem** | ~2 menit | Live demo pencarian kota dan visualisasi data real-time |
| **Penjelasan Teknis** | ~1 menit | Arsitektur 3-tier, RL reward function, API pipeline |
| **Dampak & Roadmap** | ~1 menit | Dampak positif bagi perencanaan kota + rencana pengembangan v2/v3 |

> **Filename:** `TeamName_WebDev_Demo_2026.mp4`

---

### Referensi Literatur

1. Bowler, D. E., et al. (2010). Urban greening to cool towns and cities. *Landscape and Urban Planning*, 97(3).
2. Zölch, T., et al. (2016). Regulating urban surface runoff through nature-based solutions. *Environmental Research*, 151.
3. Berland, A., et al. (2017). The role of trees in urban stormwater management. *Landscape and Urban Planning*, 162.
4. Wolch, J. R., et al. (2014). Urban green space, public health, and environmental justice. *Landscape and Urban Planning*, 125.
5. Rizwan, A. M., et al. (2008). A review on the generation, determination and mitigation of UHI. *J. Env. Sciences*, 20(1).
6. Oke, T. R. (1982). The energetic basis of the urban heat island. *Q. J. R. Meteorol. Soc.*, 108(455).
