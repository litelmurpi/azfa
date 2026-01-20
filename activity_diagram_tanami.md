# Activity Diagram - Sistem TANAMI E-Commerce

> **Dokumen Activity Diagram untuk Sistem Manajemen Basis Data Lanjut**  
> Berdasarkan Rule Bisnis Versi 2.0 dengan Sistem Escrow

---

## Daftar Isi

1. [Proses Registrasi dan Login](#1-proses-registrasi-dan-login)
2. [Proses Checkout dan Pembayaran (dengan Escrow)](#2-proses-checkout-dan-pembayaran-dengan-escrow)
3. [Proses Verifikasi Pembayaran oleh Petani](#3-proses-verifikasi-pembayaran-oleh-petani)
4. [Proses Pengiriman Barang](#4-proses-pengiriman-barang)
5. [Proses Konfirmasi Penerimaan Barang](#5-proses-konfirmasi-penerimaan-barang)
6. [Proses Refund](#6-proses-refund)
7. [Proses Auto-Cancel Timeout Pembayaran](#7-proses-auto-cancel-timeout-pembayaran)
8. [Proses Auto-Complete Pesanan](#8-proses-auto-complete-pesanan)

---

## 1. Proses Registrasi dan Login

### Activity Diagram

```mermaid
flowchart TD
    Start([User Mengakses Halaman]) --> Choice{Sudah Punya<br/>Akun?}

    Choice -->|Belum| RegStart[Klik Registrasi]
    Choice -->|Sudah| LoginStart[Klik Login]

    RegStart --> InputReg[Input Data:<br/>- Nama Lengkap<br/>- Email<br/>- Password<br/>- No HP<br/>- Alamat]
    InputReg --> ChooseRole{Pilih Role}
    ChooseRole -->|Pembeli| SetRolePembeli[Set role = pembeli]
    ChooseRole -->|Petani| SetRolePetani[Set role = petani]

    SetRolePembeli --> ValidateReg{Validasi Data}
    SetRolePetani --> ValidateReg

    ValidateReg -->|Invalid| ErrorReg[Tampilkan Error:<br/>- Email sudah terdaftar<br/>- Password lemah<br/>- Field kosong]
    ErrorReg --> InputReg

    ValidateReg -->|Valid| SaveUser[Simpan ke tabel pengguna<br/>is_verified = 0<br/>password = bcrypt]
    SaveUser --> SendEmail[Kirim Email Verifikasi]
    SendEmail --> RegSuccess[Tampilkan Pesan:<br/>Cek email untuk verifikasi]
    RegSuccess --> End1([Selesai])

    LoginStart --> InputLogin[Input Email & Password]
    InputLogin --> ValidateLogin{Validasi<br/>Kredensial}

    ValidateLogin -->|Invalid| ErrorLogin[Tampilkan Error:<br/>Email/Password salah]
    ErrorLogin --> InputLogin

    ValidateLogin -->|Valid| CheckVerified{is_verified<br/>= 1?}
    CheckVerified -->|Tidak| ErrorNotVerified[Error: Email belum diverifikasi]
    ErrorNotVerified --> End2([Selesai])

    CheckVerified -->|Ya| CreateSession[Buat Session:<br/>- User ID<br/>- Role<br/>- Timeout 2 jam]
    CreateSession --> RedirectRole{Redirect<br/>by Role}

    RedirectRole -->|Admin| DashAdmin[Dashboard Admin]
    RedirectRole -->|Petani| DashPetani[Dashboard Petani]
    RedirectRole -->|Pembeli| DashPembeli[Halaman Produk]

    DashAdmin --> End3([Selesai])
    DashPetani --> End3
    DashPembeli --> End3
```

### Penjelasan

**Actor:** Customer/Petani, System

**Rule Bisnis:**

- Password harus di-hash menggunakan bcrypt
- Email harus unik
- Session timeout 2 jam
- Verifikasi email wajib untuk login

**Database Tables:**

- `pengguna` (id_pengguna, email, password, role_pengguna, is_verified)

---

## 2. Proses Checkout dan Pembayaran (dengan Escrow)

### Activity Diagram

```mermaid
flowchart TD
    Start([Customer Browse Produk]) --> AddCart[Tambah Produk ke Keranjang]
    AddCart --> UpdateCart[Update tabel keranjang:<br/>id_pengguna, id_produk, jumlah]
    UpdateCart --> ViewCart{Lanjut<br/>Belanja?}

    ViewCart -->|Ya| AddCart
    ViewCart -->|Tidak| Checkout[Klik Checkout]

    Checkout --> ValidateStock{Stok<br/>Tersedia?}
    ValidateStock -->|Tidak| ErrorStock[Error: Stok tidak cukup]
    ErrorStock --> End1([Selesai])

    ValidateStock -->|Ya| ReserveStock[Reserved Stock:<br/>stok_direserve += jumlah]
    ReserveStock --> SelectKota[Pilih Kota Tujuan]
    SelectKota --> CalcOngkir[Hitung Ongkir dari tabel kota]
    CalcOngkir --> InputKupon{Ada<br/>Kupon?}

    InputKupon -->|Ya| ValidateKupon{Kupon<br/>Valid?}
    ValidateKupon -->|Tidak| ErrorKupon[Error: Kupon tidak valid]
    ErrorKupon --> InputKupon
    ValidateKupon -->|Ya| ApplyDiskon[Terapkan Diskon]

    InputKupon -->|Tidak| CalcTotal[Hitung Total:<br/>subtotal + ongkir - diskon]
    ApplyDiskon --> CalcTotal

    CalcTotal --> CreateOrder[Buat Pesanan:<br/>- status = pending<br/>- batas_bayar = NOW + 24 JAM<br/>- Insert ke tabel pesanan]
    CreateOrder --> CreateItems[Insert item_pesanan:<br/>- id_produk, jumlah<br/>- harga_snapshot]
    CreateItems --> LogStatus1[Insert histori_status:<br/>status_baru = pending]
    LogStatus1 --> ClearCart[Hapus dari keranjang]
    ClearCart --> ShowPayment[Tampilkan Info Pembayaran:<br/>- Rekening petani<br/>- Total bayar<br/>- Batas upload: 24 jam]

    ShowPayment --> WaitUpload{Customer Upload<br/>Bukti dalam 24 jam?}

    WaitUpload -->|Timeout| AutoCancel[Stored Procedure:<br/>sp_batalkan_pesanan_timeout<br/>- status = dibatalkan<br/>- Release reserved stock]
    AutoCancel --> End2([Selesai])

    WaitUpload -->|Upload| SaveBukti[Simpan bukti_bayar:<br/>- Upload file<br/>- status = menunggu_verifikasi]
    SaveBukti --> LogStatus2[Insert histori_status:<br/>status_baru = menunggu_verifikasi]
    LogStatus2 --> NotifyPetani[Kirim Notifikasi ke Petani:<br/>Email + Dashboard]
    NotifyPetani --> End3([Lanjut ke Proses Verifikasi])
```

### Penjelasan

**Actor:** Customer, System

**Rule Bisnis:**

- Timeout pembayaran: **24 JAM** (bukan 30 menit)
- Reserved stock dikurangi saat checkout, stok aktual dikurangi saat dibayar
- Kupon valid jika: aktif, belum expired, subtotal ≥ min_belanja, limit belum tercapai
- `batas_bayar` = NOW() + INTERVAL 24 HOUR

**Database Tables:**

- `keranjang`, `pesanan`, `item_pesanan`, `produk`, `kota`, `kupon`, `pemakaian_kupon`, `histori_status`

**Stored Procedures:**

- `sp_batalkan_pesanan_timeout()` - Jalan setiap 1 jam

---

## 3. Proses Verifikasi Pembayaran oleh Petani

### Activity Diagram

```mermaid
flowchart TD
    Start([Petani Login Dashboard]) --> ViewOrders[Lihat Daftar Pesanan:<br/>status = menunggu_verifikasi]
    ViewOrders --> SelectOrder[Pilih Pesanan untuk Verifikasi]
    SelectOrder --> ViewBukti[Lihat Bukti Transfer]

    ViewBukti --> CheckTimeout{Sudah lewat<br/>48 jam?}
    CheckTimeout -->|Ya| AutoCancelRefund[System Auto-Cancel:<br/>- status = dibatalkan<br/>- Refund ke customer<br/>- Release reserved stock]
    AutoCancelRefund --> End1([Selesai])

    CheckTimeout -->|Tidak| Decision{Verifikasi<br/>Petani}

    Decision -->|Tolak| InputAlasan[Input Alasan Penolakan]
    InputAlasan --> RejectPayment[Update pesanan:<br/>- status = dibatalkan<br/>- alasan_tolak = input<br/>- tgl_dibatalkan = NOW]
    RejectPayment --> ReleaseStock[Release Reserved Stock:<br/>stok_direserve -= jumlah]
    ReleaseStock --> LogReject[Insert histori_status:<br/>status_baru = dibatalkan<br/>id_pengubah = id_petani]
    LogReject --> NotifyReject[Kirim Email ke Customer:<br/>Pembayaran ditolak]
    NotifyReject --> End2([Selesai])

    Decision -->|Approve| ApprovePayment[Update pesanan:<br/>- status = dibayar<br/>- tgl_verifikasi = NOW<br/>- id_verifikator = id_petani]
    ApprovePayment --> CreateEscrow[Insert ke tabel escrow:<br/>- id_pesanan<br/>- jumlah = total_bayar<br/>- status_escrow = ditahan<br/>- tgl_ditahan = NOW]
    CreateEscrow --> DeductStock[Kurangi Stok Aktual:<br/>stok -= jumlah<br/>stok_direserve -= jumlah]
    DeductStock --> LogApprove[Insert histori_status:<br/>status_baru = dibayar<br/>id_pengubah = id_petani]
    LogApprove --> NotifyApprove[Kirim Email ke Customer:<br/>Pembayaran diverifikasi]
    NotifyApprove --> End3([Lanjut ke Proses Pengiriman])
```

### Penjelasan

**Actor:** Petani, System

**Rule Bisnis:**

- Petani **WAJIB** verifikasi dalam **48 JAM**
- Jika lewat 48 jam → auto-cancel + auto-refund
- Saat approve: dana ditahan escrow (status: `ditahan`)
- Stok aktual baru dikurangi saat approve (bukan saat checkout)

**Database Tables:**

- `pesanan`, `escrow`, `produk`, `item_pesanan`, `histori_status`

**Escrow Status:**

- `ditahan` - Dana ditahan platform setelah verifikasi

---

## 4. Proses Pengiriman Barang

### Activity Diagram

```mermaid
flowchart TD
    Start([Petani Login Dashboard]) --> ViewPaid[Lihat Pesanan:<br/>status = dibayar]
    ViewPaid --> SelectOrder[Pilih Pesanan untuk Diproses]
    SelectOrder --> ProcessOrder[Klik Proses Pesanan]

    ProcessOrder --> UpdateProses[Update pesanan:<br/>- status = diproses<br/>- tgl_update = NOW]
    UpdateProses --> LogProses[Insert histori_status:<br/>status_baru = diproses<br/>id_pengubah = id_petani]
    LogProses --> NotifyProses[Kirim Email ke Customer:<br/>Pesanan sedang diproses]

    NotifyProses --> PackOrder[Petani Kemas Barang]
    PackOrder --> ReadyShip[Barang Siap Kirim]
    ReadyShip --> InputResi[Input Nomor Resi Pengiriman]

    InputResi --> UpdateKirim[Update pesanan:<br/>- status = dikirim<br/>- no_resi = input<br/>- tgl_update = NOW]
    UpdateKirim --> LogKirim[Insert histori_status:<br/>status_baru = dikirim<br/>id_pengubah = id_petani]
    LogKirim --> NotifyKirim[Kirim Email ke Customer:<br/>Pesanan dikirim + no_resi]

    NotifyKirim --> WaitDelivery[Menunggu Barang Sampai]
    WaitDelivery --> CourierDeliver[Kurir Antarkan Barang]
    CourierDeliver --> UpdateTerkirim[Update pesanan:<br/>- status = terkirim<br/>- tgl_update = NOW]

    UpdateTerkirim --> LogTerkirim[Insert histori_status:<br/>status_baru = terkirim]
    LogTerkirim --> NotifyTerkirim[Kirim Email ke Customer:<br/>Barang telah sampai]
    NotifyTerkirim --> End([Lanjut ke Proses Konfirmasi])
```

### Penjelasan

**Actor:** Petani, Kurir, System

**Rule Bisnis:**

- Status sequential: dibayar → diproses → dikirim → terkirim
- Nomor resi wajib diinput saat update status "dikirim"
- Dana masih **DITAHAN** di escrow selama proses pengiriman
- Setiap perubahan status tercatat di `histori_status` via trigger

**Database Tables:**

- `pesanan`, `histori_status`

**Escrow Status:**

- Masih `ditahan` - Dana belum dikirim ke petani

---

## 5. Proses Konfirmasi Penerimaan Barang

### Activity Diagram

```mermaid
flowchart TD
    Start([Customer Terima Barang]) --> ViewOrder[Lihat Detail Pesanan:<br/>status = terkirim]
    ViewOrder --> CheckGoods{Barang<br/>Sesuai?}

    CheckGoods -->|Ya| ConfirmOK[Klik Konfirmasi Penerimaan]
    ConfirmOK --> UpdateSelesai[Update pesanan:<br/>- status = selesai<br/>- tgl_selesai = NOW<br/>- id_konfirmasi = id_customer]
    UpdateSelesai --> ReleaseEscrow[Update escrow:<br/>- status_escrow = dikirim_ke_petani<br/>- tgl_kirim = NOW<br/>- id_penerima = id_petani]
    ReleaseEscrow --> LogSelesai[Insert histori_status:<br/>status_baru = selesai<br/>id_pengubah = id_customer<br/>alasan = Konfirmasi customer]
    LogSelesai --> NotifyComplete[Kirim Email:<br/>- Customer: Terima kasih<br/>- Petani: Dana dikirim]
    NotifyComplete --> AllowReview[Customer Bisa Beri Review]
    AllowReview --> End1([Selesai])

    CheckGoods -->|Tidak| Komplain[Klik Ajukan Refund]
    Komplain --> InputAlasanRefund[Input Alasan Refund:<br/>- Barang rusak<br/>- Tidak sesuai deskripsi<br/>- dll]
    InputAlasanRefund --> UploadFoto[Upload Foto Bukti]
    UploadFoto --> UpdateRefund[Update pesanan:<br/>- status = minta_refund<br/>- alasan_refund = input]
    UpdateRefund --> LogRefund[Insert histori_status:<br/>status_baru = minta_refund<br/>id_pengubah = id_customer]
    LogRefund --> NotifyAdmin[Kirim Notifikasi ke Admin:<br/>Ada permintaan refund]
    NotifyAdmin --> End2([Lanjut ke Proses Refund])

    CheckGoods -->|Tidak Konfirmasi| WaitTimeout{Lewat<br/>3 Hari?}
    WaitTimeout -->|Belum| WaitTimeout
    WaitTimeout -->|Ya| AutoComplete[Stored Procedure:<br/>sp_selesaikan_pesanan_otomatis<br/>- status = selesai<br/>- tgl_selesai_otomatis = NOW]
    AutoComplete --> AutoReleaseEscrow[Update escrow:<br/>- status_escrow = dikirim_ke_petani<br/>- tgl_kirim = NOW<br/>- id_penerima = id_petani<br/>- catatan = Auto-complete]
    AutoReleaseEscrow --> LogAutoComplete[Insert histori_status:<br/>status_baru = selesai]
    LogAutoComplete --> NotifyAutoComplete[Kirim Email:<br/>- Customer: Auto-complete<br/>- Petani: Dana dikirim]
    NotifyAutoComplete --> End3([Selesai])
```

### Penjelasan

**Actor:** Customer, System, Admin

**Rule Bisnis:**

- Customer punya **3 HARI** untuk konfirmasi setelah status "terkirim"
- Jika tidak konfirmasi dalam 3 hari → **AUTO-COMPLETE**
- Saat konfirmasi OK atau auto-complete → dana **DIKIRIM KE PETANI**
- Jika komplain → status "minta_refund", menunggu review admin

**Database Tables:**

- `pesanan`, `escrow`, `histori_status`

**Escrow Status:**

- `dikirim_ke_petani` - Dana dikirim ke rekening petani

**Stored Procedures:**

- `sp_selesaikan_pesanan_otomatis()` - Jalan setiap 6 jam

---

## 6. Proses Refund

### Activity Diagram

```mermaid
flowchart TD
    Start([Admin Login Dashboard]) --> ViewRefund[Lihat Daftar Permintaan Refund:<br/>status = minta_refund]
    ViewRefund --> SelectRefund[Pilih Permintaan Refund]
    SelectRefund --> ViewDetail[Lihat Detail:<br/>- Alasan refund<br/>- Foto bukti<br/>- Histori pesanan]

    ViewDetail --> ContactPetani[Hubungi Petani untuk Klarifikasi]
    ContactPetani --> ReviewEvidence[Review Bukti dan Alasan]
    ReviewEvidence --> Decision{Keputusan<br/>Admin}

    Decision -->|Tolak| InputAlasanTolak[Input Alasan Penolakan Refund]
    InputAlasanTolak --> RejectRefund[Update pesanan:<br/>- status = selesai<br/>- catatan = alasan tolak]
    RejectRefund --> ReleaseEscrowPetani[Update escrow:<br/>- status_escrow = dikirim_ke_petani<br/>- tgl_kirim = NOW<br/>- id_penerima = id_petani<br/>- catatan = Refund ditolak]
    ReleaseEscrowPetani --> LogReject[Insert histori_status:<br/>status_baru = selesai<br/>id_pengubah = id_admin<br/>alasan = Refund ditolak]
    LogReject --> NotifyReject[Kirim Email:<br/>- Customer: Refund ditolak<br/>- Petani: Dana dikirim]
    NotifyReject --> End1([Selesai])

    Decision -->|Approve| ApproveRefund[Update pesanan:<br/>- status = direfund<br/>- tgl_update = NOW]
    ApproveRefund --> RefundEscrow[Update escrow:<br/>- status_escrow = direfund_ke_pembeli<br/>- tgl_kirim = NOW<br/>- id_penerima = id_customer<br/>- catatan = Refund approved]
    RefundEscrow --> RestoreStock[Kembalikan Stok:<br/>stok += jumlah]
    RestoreStock --> LogApprove[Insert histori_status:<br/>status_baru = direfund<br/>id_pengubah = id_admin<br/>alasan = Refund disetujui]
    LogApprove --> NotifyApprove[Kirim Email:<br/>- Customer: Refund disetujui<br/>- Petani: Pesanan direfund]
    NotifyApprove --> End2([Selesai])
```

### Penjelasan

**Actor:** Admin, System

**Rule Bisnis:**

- Admin review permintaan refund dari customer
- Jika approve → dana **DI-REFUND KE CUSTOMER**, stok dikembalikan
- Jika reject → dana **DIKIRIM KE PETANI**, status jadi "selesai"
- Semua keputusan tercatat di `histori_status`

**Database Tables:**

- `pesanan`, `escrow`, `produk`, `histori_status`

**Escrow Status:**

- `direfund_ke_pembeli` - Dana dikembalikan ke customer
- `dikirim_ke_petani` - Dana dikirim ke petani (jika refund ditolak)

---

## 7. Proses Auto-Cancel Timeout Pembayaran

### Activity Diagram

```mermaid
flowchart TD
    Start([Event Scheduler Aktif]) --> WaitTrigger[Tunggu 1 Jam]
    WaitTrigger --> TriggerEvent[Event: evt_batalkan_timeout<br/>Jalan Setiap 1 Jam]
    TriggerEvent --> CallSP[CALL sp_batalkan_pesanan_timeout]

    CallSP --> QueryPending[SELECT pesanan WHERE:<br/>- status = pending<br/>- batas_bayar < NOW<br/>- bukti_bayar IS NULL]
    QueryPending --> CheckResult{Ada<br/>Pesanan?}

    CheckResult -->|Tidak| End1([Selesai - Tunggu 1 Jam Lagi])

    CheckResult -->|Ya| UpdateStatus[UPDATE pesanan SET:<br/>- status = dibatalkan<br/>- alasan_batal = Timeout 24 jam<br/>- tgl_dibatalkan = NOW<br/>- tgl_update = NOW]
    UpdateStatus --> GetItems[SELECT item_pesanan<br/>JOIN produk<br/>WHERE id_pesanan IN canceled_orders]
    GetItems --> ReleaseStock[UPDATE produk SET:<br/>stok_direserve -= jumlah<br/>WHERE id_produk IN items]

    ReleaseStock --> LogCancel[Trigger Auto-Insert:<br/>histori_status<br/>- status_baru = dibatalkan<br/>- alasan = Timeout pembayaran]
    LogCancel --> NotifyCustomer[Kirim Email ke Customer:<br/>Pesanan dibatalkan - timeout]
    NotifyCustomer --> End2([Selesai - Tunggu 1 Jam Lagi])

    End1 --> WaitTrigger
    End2 --> WaitTrigger
```

### Penjelasan

**Actor:** System (Automated)

**Rule Bisnis:**

- Stored Procedure: `sp_batalkan_pesanan_timeout()`
- Jalan setiap **1 JAM** via Event Scheduler
- Cancel order yang:
  - Status = "pending"
  - `batas_bayar` < NOW() (lewat 24 jam)
  - `bukti_bayar` IS NULL (belum upload)
- Reserved stock di-release kembali

**Database Tables:**

- `pesanan`, `item_pesanan`, `produk`, `histori_status`

**Event Scheduler:**

```sql
CREATE EVENT evt_batalkan_timeout
ON SCHEDULE EVERY 1 HOUR
DO CALL sp_batalkan_pesanan_timeout();
```

---

## 8. Proses Auto-Complete Pesanan

### Activity Diagram

```mermaid
flowchart TD
    Start([Event Scheduler Aktif]) --> WaitTrigger[Tunggu 6 Jam]
    WaitTrigger --> TriggerEvent[Event: evt_selesaikan_otomatis<br/>Jalan Setiap 6 Jam]
    TriggerEvent --> CallSP[CALL sp_selesaikan_pesanan_otomatis]

    CallSP --> QueryTerkirim[SELECT pesanan WHERE:<br/>- status = terkirim<br/>- tgl_update < NOW - 3 HARI]
    QueryTerkirim --> CheckResult{Ada<br/>Pesanan?}

    CheckResult -->|Tidak| End1([Selesai - Tunggu 6 Jam Lagi])

    CheckResult -->|Ya| UpdateSelesai[UPDATE pesanan SET:<br/>- status = selesai<br/>- tgl_selesai = NOW<br/>- tgl_selesai_otomatis = NOW<br/>- tgl_update = NOW]
    UpdateSelesai --> GetEscrow[SELECT escrow<br/>JOIN item_pesanan<br/>WHERE id_pesanan IN completed_orders<br/>AND status_escrow = ditahan]
    GetEscrow --> ReleaseEscrow[UPDATE escrow SET:<br/>- status_escrow = dikirim_ke_petani<br/>- tgl_kirim = NOW<br/>- id_penerima = id_petani<br/>- catatan = Auto-complete 3 hari]

    ReleaseEscrow --> LogComplete[Trigger Auto-Insert:<br/>histori_status<br/>- status_baru = selesai]
    LogComplete --> NotifyBoth[Kirim Email:<br/>- Customer: Auto-complete<br/>- Petani: Dana dikirim]
    NotifyBoth --> End2([Selesai - Tunggu 6 Jam Lagi])

    End1 --> WaitTrigger
    End2 --> WaitTrigger
```

### Penjelasan

**Actor:** System (Automated)

**Rule Bisnis:**

- Stored Procedure: `sp_selesaikan_pesanan_otomatis()`
- Jalan setiap **6 JAM** via Event Scheduler
- Auto-complete order yang:
  - Status = "terkirim"
  - `tgl_update` < NOW() - INTERVAL 3 DAY (lewat 3 hari)
- Dana **DIKIRIM KE PETANI** dari escrow
- Set `tgl_selesai_otomatis` untuk tracking

**Database Tables:**

- `pesanan`, `escrow`, `item_pesanan`, `histori_status`

**Escrow Status:**

- `dikirim_ke_petani` - Dana dikirim ke rekening petani

**Event Scheduler:**

```sql
CREATE EVENT evt_selesaikan_otomatis
ON SCHEDULE EVERY 6 HOUR
DO CALL sp_selesaikan_pesanan_otomatis();
```

---

## Ringkasan Timeline Timeout

| Proses                  | Timeout | Action                                     | Stored Procedure                   |
| ----------------------- | ------- | ------------------------------------------ | ---------------------------------- |
| **Upload Bukti Bayar**  | 24 JAM  | Auto-cancel jika tidak upload              | `sp_batalkan_pesanan_timeout()`    |
| **Verifikasi Petani**   | 48 JAM  | Auto-cancel + refund jika tidak verifikasi | Manual check (bisa dibuat SP)      |
| **Konfirmasi Customer** | 3 HARI  | Auto-complete + dana ke petani             | `sp_selesaikan_pesanan_otomatis()` |

---

## Ringkasan Status Escrow

| Status Escrow           | Deskripsi                     | Kapan Terjadi                                  |
| ----------------------- | ----------------------------- | ---------------------------------------------- |
| **ditahan**             | Dana ditahan platform         | Saat petani approve pembayaran                 |
| **dikirim_ke_petani**   | Dana dikirim ke petani        | Saat customer konfirmasi OK atau auto-complete |
| **direfund_ke_pembeli** | Dana dikembalikan ke customer | Saat admin approve refund                      |

---

## Referensi

- **Dokumen:** SISTEM-MANAJEMEN-BASIS-DATA-LANJUT-V2.md
- **Database:** tanami_web.sql
- **ERD:** https://dbdiagram.io/d/tanami_web2-694b539fdbf05578e66c71c5
- **Versi:** 2.0 (29 Desember 2025)
