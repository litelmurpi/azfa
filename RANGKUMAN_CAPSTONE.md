# Rangkuman Capstone Project ASAH 2026 — UMKM Impact Track

**Penyelenggara:** Dicoding Indonesia × GoTo
**Sumber:** Playbook resmi (`capstone_play.md`), rangkuman kickoff (detail & ringkas), rangkuman GSS #2 "Beyond the Code".

---

## 1. Inti Program
Capstone adalah **tugas akhir tim** (Major Design Experience) untuk menyelesaikan **masalah nyata UMKM** dengan teknologi. Hasil akhir berupa **MVP/prototype** (bukan skala produksi, tapi fitur harus berfungsi). Komunikasi dengan UMKM **langsung tanpa perantara Dicoding**.

**Kenapa UMKM:** 64,2 juta UMKM, menyumbang 61% PDB, menyerap 97% tenaga kerja, tapi baru ±39,7% yang terdigitalisasi. Riset ADB: adopsi digital memberi peluang 1,5–2x pertumbuhan pendapatan positif.

---

## 2. Komposisi Tim (wajib 6 orang)
| Opsi | Full-Stack | Gen-AI | Data Science | Kuota |
|------|-----------|--------|--------------|-------|
| 1 (ideal) | 2 | 2 | 2 | — |
| 2 | 3 | 2 | 1 | hanya 30 tim |
| 3 | 3 | 1 | 2 | hanya 69 tim |

Hanya **ketua tim** yang mendaftarkan semua anggota via Academic Program Dashboard. Setelah klik Register, data **tidak bisa diubah**. Komposisi berpotensi berubah setelah Mandatory Achievement 2 & 3.

---

## 3. Lima Tahap Pelaksanaan
1. **Pendaftaran Tim & UMKM** (1–27 Okt) — bentuk tim via Discord, cari UMKM, wawancara, susun 1 use case, ajukan (maks **3x pengajuan**).
2. **Finalisasi Tim & Validasi UMKM** (pengumuman 2 Nov) — validasi berkala, hasil via email ≤2 hari kerja.
3. **Project Plan** (3–15 Nov) — susun dokumen + Pakta Integritas + request Advisor; review Asesor (hasil 20 Nov).
4. **Implementasi/Project Brief** (20 Nov–20 Des) — bangun MVP, mentoring Advisor (wajib 1x), laporan kemajuan (4–6 Des).
5. **Final Deliverables & Evaluasi** — demo ke UMKM (14–20 Des), final survey UMKM (≤21 Des), 360 feedback (20–22 Des).

---

## 4. Timeline Kunci
- Cari tim & UMKM: **1–27 Okt 2026**
- Project Plan: 3–15 Nov (deadline 15 Nov 17.00 WIB)
- Pengumuman penilaian Project Plan: 20 Nov
- Pengerjaan Capstone: 20 Nov–20 Des
- Mentoring Advisor: 23 Nov–13 Des
- Laporan kemajuan: 4–6 Des
- Demo ke UMKM: 14–20 Des
- Pengumpulan Project Brief + Final Deliverables: 20 Des 23.59 WIB
- 360 Feedback: 20–22 Des

**Checkpoint:** CP1 (15 Nov, bobot 25%), CP2 (6 Des, 35%), CP3 (22 Des, 40%). Skor keaktifan ≥60% = Aktif.

---

## 5. Kriteria UMKM
**Wajib:** produk/jasa aktif & punya pelanggan nyata, identitas bisa diverifikasi, PIC responsif sampai demo & final survey, punya masalah relevan teknologi.
**Opsional (nilai plus):** operasi >6 bulan, tim >2 orang, punya NIB.
UMKM milik sendiri **tidak disarankan** (konflik kepentingan).

Data pengajuan: profil usaha, PIC (nama/jabatan/WA), min 1 kanal digital (IG/web/marketplace/Maps/WA Business/foto tempat), dokumen interview + use case (template Asah, akses "Anyone with link can view").

---

## 6. Use Case
Satu tim = **1 UMKM, 1 use case, 1 masalah prioritas**, scope selesai ±4 minggu. Rumuskan: pengguna utama + masalah + tindakan + hasil. Alur: **Temuan → Kebutuhan → Use Case**.

Belum boleh dikunci kalau: pengguna/masalah belum jelas, data sensitif belum berizin, scope terlalu luas, atau PIC belum konfirmasi.

Contoh sektor: Gym (jadwal/kehadiran), F&B (pencatatan stok + forecasting), Retail (katalog + rekomendasi produk).

---

## 7. Tech Stack (Main Quest wajib + Side Quest nilai tambah)
- **Full-Stack:** app web menyelesaikan 1 masalah UMKM, min 2 fitur utama, bisa diakses lewat browser/HP tanpa instalasi, feedback aksi jelas. Side quest: arsitektur decoupled, REST API (Express), validasi schema (Joi), deploy ke free tier.
- **Gen AI:** bangun model sendiri (dilarang pakai model jadi dari TF Hub / API ChatGPT sebagai model utama; dilarang AutoML), preprocessing, banding min 2 model, serving via FastAPI/Flask. Side quest: RAG, intent classification (min 4 intent), prompt terstruktur, batasi chatbot di luar konteks.
- **Data Science:** data wrangling lengkap (gathering → assessing → cleaning), analisis bisnis, sediakan data untuk tim lain. Side quest: dashboard (Streamlit), model prediksi/forecasting.

Data boleh dummy/sintetis/publik bila data asli tak tersedia — **wajib cantumkan sumber & keterbatasan**. Dilarang menyajikan data dummy seolah data operasional nyata.

---

## 8. Deliverables Akhir (kumpul 20 Des 23.59 WIB)
1. Project Brief (.PDF ≤10 MB) — template Asah, nama file: `Project Brief - [ID Tim]`
2. Slide presentasi (.PPTX/.PDF ≤10 MB)
3. Video presentasi 10 menit (YouTube, semua anggota tampil & presentasi bagiannya)
4. GitHub repo (.ZIP 100–200 MB, private, README lengkap, `.env.example`, tanpa credential; model AI di Google Drive dengan akses untuk `capstone@student.devacademy.id`)
5. Panduan penggunaan produk (PDF ≤10 MB / video ≤100 MB)

---

## 9. Penilaian
**Tim:** Project Plan 35% + Video presentasi 20% + Project Brief 45%.
**Individu:** Skor tim 60% + 360 Feedback 25% + partisipasi individu 15%.

**Rubrik Project Brief:** indikator teknis 40%, ide/inovasi 20%, dokumentasi 20%, desain/usability 10%, penyelesaian 10%.

---

## 10. Sesi Wajib (Briefing)
| Sesi | Jadwal | Topik |
|------|--------|-------|
| Kick-Off | 1 Okt, 15.00–17.00 | Pengenalan, alur kerja sama, pembentukan tim, wawancara |
| Briefing 1 | 3 Nov, 15.00–17.00 | Pakta Integritas, Project Plan, Request Advisor, Checkpoint, Mentoring |
| Briefing 2 | 25 Nov, 15.00–17.00 | Project Brief, Laporan Kemajuan, Demo ke UMKM |
| Briefing 3 | 9 Des, 15.00–17.00 | Final Deliverables, Final Survey, 360 Feedback, Penilaian Akhir |

---

## 11. Insight GSS #2 "Beyond the Code"
Mindset: **"Problem first, technology second"** — engineer = problem solver.
- Bedakan **gejala vs akar masalah**; lakukan **problem validation** (cari fakta → validasi dugaan → catat bukti).
- Pastikan masalah bisa diselesaikan teknologi (masalah administratif/legalitas/SDM bukan ranah kita).
- Keep it simple, jangan over-engineering, **jangan ubah alur bisnis yang sudah jalan**.
- Prinsip AI aman: human-in-the-loop, human approval, batasi akses data pelanggan, owner yang menetapkan kebijakan.
- Ukur impact dari **revenue, time saving, cost saving, space saving**.
- Menghadapi UMKM itu long run; selalu dengarkan owner, pastikan ada SOP, otomasi hal repetitif, beri report impact.

---

## 12. Peraturan Penting
- **Tidak ada toleransi plagiarisme** — bangun dari awal, boleh merujuk (tulis ulang & modifikasi), dilarang menyalin penuh.
- **Dilarang bantuan pihak eksternal** → risiko penonaktifan/tidak lulus.
- Boleh pakai API/dataset/library publik dengan **mencantumkan sumber**.
- Dokumentasi wajib: GitHub private + README lengkap, tanpa credential/API key/data sensitif.
- Hak milik: karya tim milik tim; data & aset UMKM tetap milik UMKM (pakai hanya dengan izin).

---

## 13. Hadiah & Kontak
Best Capstone → total hadiah **mencapai puluhan juta rupiah**.
Kontak: `capstone@student.devacademy.id`

**Dokumen & template kunci:** Capstone Playbook, Template Interview & Use Case UMKM, Lembar Pengantar Kolaborasi UMKM, Template Project Plan, Template Pakta Integritas, Template Project Brief, Checklist Tech Stack, Rubrik Penilaian Asesor, Dokumen FAQ (link lengkap ada di tabel Repository Dokumen pada `capstone_play.md`).
