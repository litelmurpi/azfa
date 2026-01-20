# 📊 Activity Diagram - TANAMI E-Commerce

Dokumen ini berisi Activity Diagram dalam format UML Mermaid untuk website TANAMI E-Commerce v2.0.

---

## 1. Activity Diagram: Registrasi & Login

Alur autentikasi pengguna mencakup registrasi akun baru dan proses login.

```mermaid
flowchart TD
    subgraph "Registrasi & Login"
        START((●)) --> A{Sudah Punya Akun?}
        
        A -->|Ya| B[Masuk Halaman Login]
        A -->|Tidak| C[Masuk Halaman Register]
        
        C --> D[Isi Form Registrasi<br>Nama, Email, Password, No HP, Alamat]
        D --> E{Validasi Data}
        E -->|Invalid| D
        E -->|Valid| F[Simpan ke Database]
        F --> G[Redirect ke Login]
        
        B --> H[Input Email & Password]
        H --> I{Kredensial Valid?}
        I -->|Tidak| J[Tampilkan Error]
        J --> H
        I -->|Ya| K{Cek Role Pengguna}
        
        K -->|Admin| L[Redirect ke Admin Dashboard]
        K -->|Petani| M[Redirect ke Petani Dashboard]
        K -->|Pembeli| N[Redirect ke Beranda]
        
        L --> END1((○))
        M --> END2((○))
        N --> END3((○))
    end
```

---

## 2. Activity Diagram: Alur Belanja (Pembeli)

Alur lengkap pembeli dari melihat produk hingga menyelesaikan pesanan.

```mermaid
flowchart TD
    subgraph "Alur Belanja Pembeli"
        START((●)) --> A[Buka Halaman Katalog]
        A --> B[Lihat Daftar Produk]
        B --> C{Filter/Search Produk?}
        C -->|Ya| D[Filter Kategori/Search/Sort]
        D --> B
        C -->|Tidak| E[Pilih Produk]
        E --> F[Lihat Detail Produk<br>Harga, Stok, Ulasan]
        
        F --> G{Tambah ke Keranjang?}
        G -->|Tidak| B
        G -->|Ya| H{Sudah Login?}
        H -->|Tidak| I[Redirect ke Login]
        I --> J[Login]
        J --> F
        H -->|Ya| K[Tambah ke Keranjang]
        K --> L{Lanjut Belanja?}
        L -->|Ya| B
        L -->|Tidak| M[Buka Keranjang]
        
        M --> N[Review Item di Keranjang]
        N --> O{Update/Hapus Item?}
        O -->|Ya| P[Update Qty/Hapus]
        P --> N
        O -->|Tidak| Q[Klik Checkout]
        
        Q --> R[Pilih Kota Tujuan]
        R --> S[Sistem Hitung Ongkir]
        S --> T{Pakai Kupon?}
        T -->|Ya| U[Input Kode Kupon]
        U --> V{Kupon Valid?}
        V -->|Tidak| W[Tampilkan Error]
        W --> T
        V -->|Ya| X[Terapkan Diskon]
        T -->|Tidak| X
        
        X --> Y[Tampilkan Ringkasan<br>Subtotal + Ongkir - Diskon]
        Y --> Z[Konfirmasi Pesanan]
        Z --> AA[Sistem Reserve Stok]
        AA --> AB[Create Pesanan<br>Status: Pending]
        AB --> AC[Set Batas Bayar<br>24 Jam]
        AC --> AD[Clear Keranjang]
        AD --> AE[Redirect ke Detail Pesanan]
        AE --> END((○))
    end
```

---

## 3. Activity Diagram: Pembayaran & Verifikasi

Alur pembayaran oleh pembeli dan verifikasi oleh petani.

```mermaid
flowchart TD
    subgraph "Pembayaran & Verifikasi"
        START((●)) --> A[Pesanan Status: Pending]
        A --> B[Lihat Detail Pesanan<br>Info Pembayaran]
        
        B --> C{Upload Bukti Bayar<br>Sebelum Timeout?}
        C -->|Timeout| D[Sistem Auto-Cancel<br>Release Reserved Stock]
        D --> END1((○))
        
        C -->|Ya| E[Upload Bukti Bayar<br>JPG/PNG max 2MB]
        E --> F[Status: Menunggu Verifikasi]
        
        F --> G[Petani Review<br>Bukti Bayar]
        G --> H{Pembayaran Valid?}
        
        H -->|Tolak| I[Input Alasan Tolak]
        I --> J[Status: Dibatalkan]
        J --> K[Release Reserved Stock]
        K --> END2((○))
        
        H -->|Verifikasi| L[Status: Dibayar]
        L --> M[Kurangi Stok Aktual]
        M --> N[Release Reserved Stock]
        N --> O[Create Escrow<br>Status: Ditahan]
        O --> P[Petani Proses Pesanan]
        P --> Q[Status: Diproses]
        
        Q --> R[Petani Siapkan Barang]
        R --> S[Input Nomor Resi]
        S --> T[Status: Dikirim]
        T --> U[Barang Terkirim]
        U --> V[Status: Terkirim]
        
        V --> W{Pembeli Konfirmasi<br>dalam 3 Hari?}
        W -->|Ya| X[Pembeli Klik Konfirmasi]
        W -->|Timeout| Y[Sistem Auto-Complete]
        
        X --> Z[Status: Selesai]
        Y --> Z
        Z --> AA[Escrow Dikirim ke Petani]
        AA --> AB[Pembeli Bisa Beri Ulasan]
        AB --> END3((○))
    end
```

---

## 4. Activity Diagram: Manajemen Produk (Petani)

Alur petani mengelola produk di toko mereka.

```mermaid
flowchart TD
    subgraph "Manajemen Produk Petani"
        START((●)) --> A[Login sebagai Petani]
        A --> B[Akses Dashboard Petani]
        B --> C[Buka Menu Produk Saya]
        
        C --> D{Pilih Aksi}
        
        D -->|Tambah| E[Klik Tambah Produk]
        E --> F[Isi Form Produk<br>Nama, Deskripsi, Harga, Stok]
        F --> G[Pilih Kategori]
        G --> H[Upload Foto Produk<br>JPG/PNG max 5MB]
        H --> I{Validasi Data}
        I -->|Invalid| F
        I -->|Valid| J[Simpan Produk]
        J --> K[Generate Slug Otomatis]
        K --> C
        
        D -->|Edit| L[Pilih Produk]
        L --> M[Buka Form Edit]
        M --> N[Update Informasi]
        N --> O{Validasi Data}
        O -->|Invalid| N
        O -->|Valid| P[Simpan Perubahan]
        P --> C
        
        D -->|Hapus| Q[Pilih Produk]
        Q --> R{Ada Reserved Stock?}
        R -->|Ya| S[Tampilkan Error<br>Tidak Bisa Hapus]
        S --> C
        R -->|Tidak| T[Konfirmasi Hapus]
        T --> U[Hapus Produk]
        U --> C
        
        D -->|Selesai| END((○))
    end
```

---

## 5. Activity Diagram: Verifikasi Pesanan (Petani)

Alur petani menangani pesanan masuk.

```mermaid
flowchart TD
    subgraph "Verifikasi Pesanan Petani"
        START((●)) --> A[Login sebagai Petani]
        A --> B[Akses Dashboard]
        B --> C[Buka Menu Pesanan Masuk]
        C --> D[Lihat Daftar Pesanan<br>Filter by Status]
        
        D --> E[Pilih Pesanan<br>Menunggu Verifikasi]
        E --> F[Lihat Detail Pesanan<br>& Bukti Bayar]
        
        F --> G{Bukti Bayar Valid?}
        
        G -->|Tolak| H[Input Alasan Penolakan]
        H --> I[Klik Tolak Pembayaran]
        I --> J[Status: Dibatalkan]
        J --> K[Release Stock]
        K --> D
        
        G -->|Verifikasi| L[Klik Verifikasi Pembayaran]
        L --> M[Status: Dibayar]
        M --> N[Kurangi Stok Produk]
        N --> O[Create Escrow Ditahan]
        
        O --> P[Klik Proses Pesanan]
        P --> Q[Status: Diproses]
        Q --> R[Siapkan Barang]
        
        R --> S[Input Nomor Resi]
        S --> T[Klik Kirim Pesanan]
        T --> U[Status: Dikirim]
        U --> V[Tunggu Konfirmasi Pembeli]
        V --> END((○))
    end
```

---

## 6. Activity Diagram: Admin Dashboard

Alur admin mengelola platform.

```mermaid
flowchart TD
    subgraph "Admin Dashboard"
        START((●)) --> A[Login sebagai Admin]
        A --> B[Akses Admin Dashboard]
        B --> C[Lihat Statistik GMV, Transaksi, User]
        
        C --> D{Pilih Menu}
        
        D -->|Master Data| E[Kelola Kategori/Kota/Kupon]
        E --> F{CRUD Operation}
        F -->|Create| G[Tambah Data Baru]
        F -->|Read| H[Lihat Daftar]
        F -->|Update| I[Edit Data]
        F -->|Delete| J[Hapus Data]
        G --> C
        H --> C
        I --> C
        J --> C
        
        D -->|Pengguna| K[Lihat Daftar User]
        K --> L{Filter Role}
        L -->|Petani Pending| M[Verifikasi Akun Petani]
        L -->|Semua| N[Lihat Detail User]
        M --> C
        N --> C
        
        D -->|Pesanan| O[Monitor Semua Pesanan]
        O --> P[Lihat Histori Status]
        P --> C
        
        D -->|Escrow| Q[Monitor Dana Ditahan]
        Q --> C
        
        D -->|Refund| R[Lihat Request Refund]
        R --> S{Keputusan}
        S -->|Approve| T[Refund ke Pembeli]
        S -->|Reject| U[Dana ke Petani]
        T --> C
        U --> C
        
        D -->|Logout| END((○))
    end
```

---

## 7. Activity Diagram: Proses Refund

Alur permintaan dan penanganan refund.

```mermaid
flowchart TD
    subgraph "Proses Refund"
        START((●)) --> A[Pesanan Status: Terkirim]
        A --> B{Ada Masalah<br>dengan Barang?}
        
        B -->|Tidak| C[Konfirmasi Terima]
        C --> D[Status: Selesai]
        D --> E[Escrow ke Petani]
        E --> END1((○))
        
        B -->|Ya| F[Pembeli Klik Minta Refund]
        F --> G[Input Alasan Refund]
        G --> H[Status: Minta Refund]
        H --> I[Notifikasi ke Admin]
        
        I --> J[Admin Review Request]
        J --> K{Keputusan Admin}
        
        K -->|Reject| L[Status: Selesai]
        L --> M[Escrow ke Petani]
        M --> END2((○))
        
        K -->|Approve| N[Status: Direfund]
        N --> O[Escrow Refund ke Pembeli]
        O --> P[Status: Dibatalkan]
        P --> END3((○))
    end
```

---

## 8. Activity Diagram: Scheduled Jobs (Automation)

Alur job otomatis yang berjalan di background.

```mermaid
flowchart TD
    subgraph "Scheduled Jobs"
        START((●)) --> A[Scheduler Berjalan]
        
        A --> B[Job: Cancel Timeout Payment<br>Setiap 1 Jam]
        B --> C{Ada Pesanan Pending<br>Lebih dari 24 Jam?}
        C -->|Ya| D[Auto Cancel Pesanan]
        D --> E[Release Reserved Stock]
        E --> F[Set Alasan: Timeout]
        C -->|Tidak| G[Skip]
        
        A --> H[Job: Cancel Timeout Verification<br>Setiap 1 Jam]
        H --> I{Ada Pesanan<br>Menunggu Verifikasi > 48 Jam?}
        I -->|Ya| J[Auto Cancel Pesanan]
        J --> K[Release Stock]
        K --> L[Auto Refund jika ada Escrow]
        I -->|Tidak| M[Skip]
        
        A --> N[Job: Auto Complete Order<br>Setiap 6 Jam]
        N --> O{Ada Pesanan Terkirim<br>Lebih dari 3 Hari?}
        O -->|Ya| P[Auto Complete Pesanan]
        P --> Q[Status: Selesai]
        Q --> R[Escrow ke Petani]
        O -->|Tidak| S[Skip]
        
        A --> T[Job: Payment Reminder<br>Setiap 6 Jam]
        T --> U{Ada Pesanan Pending<br>H-6 Jam dari Batas?}
        U -->|Ya| V[Kirim Email Reminder]
        U -->|Tidak| W[Skip]
        
        F --> END1((○))
        G --> END2((○))
        L --> END3((○))
        M --> END4((○))
        R --> END5((○))
        S --> END6((○))
        V --> END7((○))
        W --> END8((○))
    end
```

---

## 9. Activity Diagram: Ulasan Produk

Alur pembeli memberikan ulasan setelah pesanan selesai.

```mermaid
flowchart TD
    subgraph "Ulasan Produk"
        START((●)) --> A[Pesanan Status: Selesai]
        A --> B[Buka Detail Pesanan]
        B --> C{Sudah Beri Ulasan?}
        
        C -->|Ya| D[Lihat Ulasan Sebelumnya]
        D --> END1((○))
        
        C -->|Tidak| E[Tampilkan Form Ulasan]
        E --> F[Pilih Rating 1-5 Bintang]
        F --> G[Tulis Komentar<br>Optional]
        G --> H[Submit Ulasan]
        H --> I{Validasi}
        I -->|Invalid| F
        I -->|Valid| J[Simpan Ulasan]
        J --> K[Update Rating Produk]
        K --> END2((○))
    end
```

---

## Ringkasan Flow Status Pesanan

```mermaid
stateDiagram-v2
    [*] --> Pending : Checkout
    
    Pending --> Menunggu_Verifikasi : Upload Bukti
    Pending --> Dibatalkan : Timeout 24 Jam / Cancel
    
    Menunggu_Verifikasi --> Dibayar : Petani Verifikasi
    Menunggu_Verifikasi --> Dibatalkan : Petani Tolak / Timeout 48 Jam
    
    Dibayar --> Diproses : Petani Proses
    Diproses --> Dikirim : Input Resi
    Dikirim --> Terkirim : Barang Sampai
    
    Terkirim --> Selesai : Konfirmasi / Auto 3 Hari
    Terkirim --> Minta_Refund : Request Refund
    
    Minta_Refund --> Selesai : Admin Reject
    Minta_Refund --> Dibatalkan : Admin Approve Refund
    
    Selesai --> [*]
    Dibatalkan --> [*]
```

---

> **Catatan**: Diagram ini dibuat menggunakan Mermaid UML berdasarkan analisis:
> - [README.md](file:///d:/laragon/www/Tanami_web/README.md)
> - [BACKEND-CHECKLIST.md](file:///d:/laragon/www/Tanami_web/BACKEND-CHECKLIST.md) 
> - [FRONTEND-PAGES.md](file:///d:/laragon/www/Tanami_web/FRONTEND-PAGES.md)
> - [routes/web.php](file:///d:/laragon/www/Tanami_web/routes/web.php)

_Dokumen Activity Diagram TANAMI E-Commerce v2.0_
