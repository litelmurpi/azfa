# 📸 DOKUMENTASI PROGRAM FOOD DELIVERY ROUTE OPTIMIZER

## 🎯 Tentang Program

**Food Delivery Route Optimizer** adalah sistem manajemen pengiriman makanan yang mensimulasikan cara kerja aplikasi ojek online. Program ini menggunakan berbagai struktur data (Linked List, Queue, Stack, Array) dan algoritma (Bubble Sort, Linear Search, Euclidean Distance) untuk mengelola pesanan secara efisien.

---

## 🚀 CARA MENJALANKAN PROGRAM

### Kompilasi Program

```bash
g++ fp_food.cpp -o fp_food.exe
```

### Menjalankan Program

```bash
fp_food.exe
```

---

## 📋 TAMPILAN AWAL PROGRAM

Ketika program dijalankan, akan muncul tampilan pembuka:

```
========================================
  FOOD DELIVERY ROUTE OPTIMIZER
  Sistem Manajemen Delivery Makanan
========================================

✓ Driver Budi ditambahkan!
✓ Driver Siti ditambahkan!
✓ Driver Andi ditambahkan!
```

**Penjelasan:**

- Program otomatis menginisialisasi 3 driver saat startup
- Driver Budi di posisi (1.0, 0.0)
- Driver Siti di posisi (3.0, 5.0)
- Driver Andi di posisi (5.0, 2.0)

---

## 🎮 MENU UTAMA

```
===== MENU UTAMA =====
1. Buat Order Baru
2. Lihat Pending Orders
3. Assign Order ke Driver
4. Lihat Daftar Driver
5. Lihat History Completed Orders
6. Cari Order by ID
7. Tambah Driver Baru
8. Hapus Order Terakhir dari History
0. Keluar

Pilihan:
```

**Penjelasan:**

- Menu menggunakan switch-case untuk navigasi
- Input menggunakan `cin >>` untuk pilihan angka
- Loop `while(true)` membuat program terus berjalan sampai user pilih 0

---

## 📝 FITUR 1: BUAT ORDER BARU

### Input yang Diminta:

```
===== BUAT ORDER BARU =====
Nama Customer: Budi Santoso
Alamat: Jl. Merdeka No. 15
Koordinat X: 4.5
Koordinat Y: 3.2

Tambah Items (ketik 'selesai' untuk berhenti):
Nama item: Nasi Goreng
Harga: Rp25000
Nama item: Es Teh
Harga: Rp5000
Nama item: Kerupuk
Harga: Rp3000
Nama item: selesai

✓ Order #1 ditambahkan ke queue!
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

1. **Linked List** - Untuk menyimpan items (Nasi Goreng, Es Teh, Kerupuk)
2. **Queue** - Order masuk ke antrian pending

**Proses:**

```
Input Customer → Input Items (Linked List) → Hitung Total → Enqueue ke Queue
```

**Fungsi yang Dipanggil:**

- `buatOrderBaru()` - Mengambil input dari user
- `tambahItem()` - Menambah item ke linked list
- `hitungTotalHarga()` - Menghitung total dari semua items
- `enqueueOrder()` - Memasukkan order ke queue

**Visualisasi Linked List Items:**

```
head → [Nasi Goreng|25000] → [Es Teh|5000] → [Kerupuk|3000] → NULL
```

**Visualisasi Queue:**

```
orderQueueHead → [Order #1] → NULL
```

---

## 👀 FITUR 2: LIHAT PENDING ORDERS

### Output yang Ditampilkan:

```
===== PENDING ORDERS =====
1. Order #1 - Budi Santoso
   Alamat: Jl. Merdeka No. 15 (4.5,3.2)
   Items:
   - Nasi Goreng (Rp25000)
   - Es Teh (Rp5000)
   - Kerupuk (Rp3000)
   Total: Rp33000
   Waktu: 5 menit

2. Order #2 - Siti Rahayu
   Alamat: Jl. Sudirman No. 5 (2.0,4.0)
   Items:
   - Mie Ayam (Rp20000)
   - Es Jeruk (Rp5000)
   Total: Rp25000
   Waktu: 10 menit
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Queue** - Traversal dari head sampai NULL

**Proses:**

```
orderQueueHead → Traversal → Display setiap order
```

**Fungsi yang Dipanggil:**

- `tampilkanPendingOrders()` - Traversal queue
- `tampilkanItems()` - Traversal linked list items

**Algoritma:**

```cpp
Order* temp = orderQueueHead;
while (temp != NULL) {
    // Tampilkan detail order
    temp = temp->next;  // Pindah ke order berikutnya
}
```

**Kompleksitas:** O(n × m)

- n = jumlah order dalam queue
- m = rata-rata jumlah item per order

---

## 🚗 FITUR 3: ASSIGN ORDER KE DRIVER

### Output yang Ditampilkan:

```
✓ Order #1 di-assign ke Budi
  Jarak: 4.30 km
  Estimasi: 21 menit
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

1. **Queue** - Dequeue order pertama
2. **Array** - Sorting driver berdasarkan jarak
3. **Stack** - Push order yang selesai ke history

**Proses Lengkap:**

```
┌─────────────────────────────────────────────┐
│  1. Dequeue order dari Queue                │
│  2. Sort driver by jarak (Bubble Sort)      │
│  3. Pilih driver available terdekat         │
│  4. Hitung jarak (Euclidean Distance)       │
│  5. Assign order ke driver                  │
│  6. Push order ke Stack history             │
│  7. Update posisi driver                    │
│  8. Delete order (memory management)        │
└─────────────────────────────────────────────┘
```

**Algoritma Sorting (Bubble Sort):**

```
SEBELUM sort (target = restaurant 0,0):
┌─────────┬─────────┬─────────┐
│  Andi   │  Siti   │  Budi   │
│ (5,2)   │ (3,5)   │ (1,0)   │
│ 5.39km  │ 5.83km  │ 1.00km  │
└─────────┴─────────┴─────────┘

SETELAH sort:
┌─────────┬─────────┬─────────┐
│  Budi   │  Andi   │  Siti   │
│ (1,0)   │ (5,2)   │ (3,5)   │
│ 1.00km  │ 5.39km  │ 5.83km  │
└─────────┴─────────┴─────────┘
```

**Perhitungan Jarak (Euclidean Distance):**

```
Driver Budi: (1.0, 0.0)
Customer: (4.5, 3.2)

Jarak = √[(1.0-4.5)² + (0.0-3.2)²]
      = √[(-3.5)² + (-3.2)²]
      = √[12.25 + 10.24]
      = √22.49
      = 4.74 km
```

**Fungsi yang Dipanggil:**

- `assignOrderToDriver()` - Fungsi utama
- `dequeueOrder()` - Ambil order dari queue
- `sortDriversByDistance()` - Bubble sort driver
- `hitungJarak()` - Euclidean distance
- `pushStack()` - Push ke history
- `delete order` - Free memory

**Kompleksitas:** O(n²)

- Bubble sort = O(n²) dimana n = jumlah driver (max 5)

---

## 👥 FITUR 4: LIHAT DAFTAR DRIVER

### Output yang Ditampilkan:

```
===== DAFTAR DRIVER =====
1. Budi (ID: 1)
   Posisi: (4.5,3.2)
   Status: available

2. Siti (ID: 2)
   Posisi: (3,5)
   Status: available

3. Andi (ID: 3)
   Posisi: (5,2)
   Status: available
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Array** - Penyimpanan statis max 5 driver

**Proses:**

```
Loop array dari index 0 sampai driverCount-1
```

**Fungsi yang Dipanggil:**

- `tampilkanDrivers()` - Loop array driver

**Algoritma:**

```cpp
for (int i = 0; i < driverCount; i++) {
    cout << drivers[i].nama << endl;
    cout << "Posisi: (" << drivers[i].posisiSaatIni.x << ","
         << drivers[i].posisiSaatIni.y << ")" << endl;
}
```

**Kompleksitas:** O(n) dimana n = jumlah driver

**Catatan:**

- Posisi driver berubah setelah mengantar order
- Status "available" atau "busy"

---

## 📚 FITUR 5: LIHAT HISTORY COMPLETED ORDERS

### Output yang Ditampilkan:

```
===== HISTORY COMPLETED ORDERS =====
1. Order #3 - Ahmad Rizki
   Total: Rp45000

2. Order #2 - Siti Rahayu
   Total: Rp25000

3. Order #1 - Budi Santoso
   Total: Rp33000
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Stack** - LIFO (Last In First Out)

**Prinsip LIFO:**

```
Order yang terakhir selesai muncul paling atas
```

**Visualisasi Stack:**

```
TOP
 ↓
[Order #3] ← Terakhir selesai (paling atas)
    ↓
[Order #2]
    ↓
[Order #1] ← Pertama selesai (paling bawah)
    ↓
  NULL
```

**Fungsi yang Dipanggil:**

- `tampilkanHistory()` - Traversal stack dari top ke bottom

**Algoritma:**

```cpp
StackNode* temp = completedOrdersStack;
while (temp != NULL) {
    cout << temp->orderData.orderID << endl;
    temp = temp->next;  // Pindah ke node di bawah
}
```

**Kompleksitas:** O(n) dimana n = jumlah order di stack

---

## 🔍 FITUR 6: CARI ORDER BY ID

### Input dan Output:

```
Masukkan Order ID: 2

✓ Order ditemukan!
Order #2 - Siti Rahayu
Status: pending
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Queue (Linked List)** - Linear search

**Algoritma Linear Search:**

```cpp
Order* temp = orderQueueHead;
while (temp != NULL) {
    if (temp->orderID == id) {
        return temp;  // Ketemu!
    }
    temp = temp->next;
}
return NULL;  // Tidak ketemu
```

**Proses:**

```
Start → [Order #1] → [Order #2] ✓ FOUND → Stop
```

**Fungsi yang Dipanggil:**

- `searchOrderByID()` - Linear search di queue

**Kompleksitas:** O(n)

- Worst case: ID ada di akhir atau tidak ada
- Best case: ID ada di awal (O(1))

**Kenapa Linear Search?**

- Data dalam Linked List (tidak bisa random access)
- Order tidak sorted by ID
- Dataset kecil, Linear Search cukup efisien

---

## ➕ FITUR 7: TAMBAH DRIVER BARU

### Input dan Output:

```
Nama driver: Rudi
Posisi X: 2.5
Posisi Y: 1.5

✓ Driver Rudi ditambahkan!
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Array** - Insert di index berikutnya

**Proses:**

```
drivers[driverCount] = newDriver
driverCount++
```

**Validasi:**

```cpp
if (driverCount >= 5) {
    cout << "Driver sudah penuh (max 5)!" << endl;
    return;
}
```

**Fungsi yang Dipanggil:**

- `tambahDriver()` - Insert ke array

**Kompleksitas:** O(1) - Direct access ke index

**Batasan:**

- Maksimal 5 driver (static array)
- Jika penuh, tidak bisa tambah lagi

---

## 🗑️ FITUR 8: HAPUS ORDER TERAKHIR DARI HISTORY

### Output yang Ditampilkan:

```
Order terakhir dihapus dari history:
Order #3 - Ahmad Rizki
Total: Rp45000
Items:
- Ayam Bakar (Rp40000)
- Es Jeruk (Rp5000)
```

### Penjelasan Teknis:

**Struktur Data yang Digunakan:**

- **Stack** - Pop operation (LIFO)

**Proses Pop:**

```
SEBELUM pop:
top → [Order #3] → [Order #2] → [Order #1] → NULL

SETELAH pop:
top → [Order #2] → [Order #1] → NULL

Return: Copy of Order #3
```

**Fungsi yang Dipanggil:**

- `popStack()` - Remove from top

**Algoritma:**

```cpp
StackNode* temp = completedOrdersStack;
completedOrdersStack = completedOrdersStack->next;  // Geser top

Order* order = new Order;  // Buat copy
*order = temp->orderData;

delete temp;  // Hapus node asli
return order;  // Return copy
```

**Memory Management:**

```
1. Pop dari stack → dapat copy
2. Tampilkan detail
3. Delete copy → free memory
```

**Kompleksitas:** O(1) - Direct access ke top

---

## 🚪 FITUR 0: KELUAR

### Output yang Ditampilkan:

```
Terima kasih telah menggunakan sistem!
```

**Proses:**

- `return 0` - Keluar dari main()
- Program selesai

---

## 🔄 ALUR KERJA LENGKAP PROGRAM

### Skenario: Customer Pesan Makanan

```
┌─────────────────────────────────────────────────────────┐
│ 1. BUAT ORDER (Menu 1)                                  │
│    Input: Budi Santoso, Jl. Merdeka, (4.5, 3.2)        │
│    Items: Nasi Goreng, Es Teh                           │
│    → Order masuk ke QUEUE                               │
├─────────────────────────────────────────────────────────┤
│ 2. LIHAT PENDING (Menu 2)                               │
│    → Tampilkan semua order di queue                     │
│    → Order #1 menunggu di antrian                       │
├─────────────────────────────────────────────────────────┤
│ 3. ASSIGN ORDER (Menu 3)                                │
│    → Dequeue Order #1 dari queue                        │
│    → Sort driver: Budi (1.0km) terdekat                 │
│    → Hitung jarak: 4.74 km                              │
│    → Assign ke Budi                                     │
│    → Push Order #1 ke STACK history                     │
│    → Update posisi Budi ke (4.5, 3.2)                   │
├─────────────────────────────────────────────────────────┤
│ 4. LIHAT HISTORY (Menu 5)                               │
│    → Tampilkan Order #1 di top stack                    │
│    → Status: completed                                  │
└─────────────────────────────────────────────────────────┘
```

---

## 📊 STRUKTUR DATA DALAM AKSI

### 1. Linked List (Items dalam Order)

```
Order #1 Items:
head → [Nasi Goreng|25000] → [Es Teh|5000] → NULL

Operasi:
- Insert: tambahItem() - O(n)
- Traversal: tampilkanItems() - O(n)
- Aggregate: hitungTotalHarga() - O(n)
```

### 2. Queue (Pending Orders)

```
FIFO - First In First Out

Front                                    Rear
  ↓                                       ↓
[Order #1] → [Order #2] → [Order #3] → NULL

Operasi:
- Enqueue: enqueueOrder() - O(n)
- Dequeue: dequeueOrder() - O(1)
- Peek: tampilkanPendingOrders() - O(n)
```

### 3. Stack (Completed Orders)

```
LIFO - Last In First Out

Top
 ↓
[Order #3] ← Terakhir selesai
    ↓
[Order #2]
    ↓
[Order #1] ← Pertama selesai
    ↓
  NULL

Operasi:
- Push: pushStack() - O(1)
- Pop: popStack() - O(1)
- Peek: tampilkanHistory() - O(n)
```

### 4. Array (Drivers)

```
Static Array - Max 5 driver

Index:  0      1      2      3      4
      [Budi] [Siti] [Andi] [NULL] [NULL]

Operasi:
- Insert: tambahDriver() - O(1)
- Access: drivers[i] - O(1)
- Traversal: tampilkanDrivers() - O(n)
```

---

## 🧮 ALGORITMA DALAM AKSI

### 1. Bubble Sort (Sorting Driver by Jarak)

```
Data awal:
[Andi: 5.39km] [Siti: 5.83km] [Budi: 1.00km]

Pass 1:
[Andi: 5.39km] [Budi: 1.00km] [Siti: 5.83km]

Pass 2:
[Budi: 1.00km] [Andi: 5.39km] [Siti: 5.83km]

Hasil: Driver terdekat di index 0
Kompleksitas: O(n²)
```

### 2. Linear Search (Cari Order by ID)

```
Cari ID = 2

[Order #1] → [Order #2] ✓ FOUND
   ↓            ↓
  Skip       Return

Kompleksitas: O(n)
```

### 3. Euclidean Distance (Hitung Jarak)

```
Driver: (1, 0)
Customer: (4.5, 3.2)

Jarak = √[(1-4.5)² + (0-3.2)²]
      = √[12.25 + 10.24]
      = √22.49
      = 4.74 km

Kompleksitas: O(1)
```

---

## 💾 MEMORY MANAGEMENT

### Proper Memory Management

```cpp
// ✅ BENAR
Order* order = dequeueOrder();  // Alokasi copy
pushStack(*order);              // Copy ke stack
delete order;                   // Free memory

// ❌ SALAH (Memory Leak)
Order* order = dequeueOrder();
pushStack(*order);
// Tidak ada delete → MEMORY LEAK!
```

### Alur Memory dalam assignOrderToDriver()

```
1. dequeueOrder()
   - Buat copy order (new Order)
   - Delete node queue asli
   - Return pointer ke copy

2. assignOrderToDriver()
   - Proses copy order
   - pushStack(*order) → copy data ke stack
   - delete order → free copy

3. Hasil:
   - Node queue: ✅ Deleted
   - Copy order: ✅ Deleted
   - Stack node: ✅ Masih ada (data tersimpan)
   - Memory leak: ❌ Tidak ada
```

---

## 📈 KOMPLEKSITAS WAKTU

| Operasi                | Kompleksitas | Penjelasan                 |
| ---------------------- | ------------ | -------------------------- |
| Buat Order (Menu 1)    | O(n)         | n = jumlah items           |
| Lihat Pending (Menu 2) | O(n×m)       | n order, m items per order |
| Assign Order (Menu 3)  | O(n²)        | Bubble sort driver         |
| Lihat Driver (Menu 4)  | O(n)         | n = jumlah driver          |
| Lihat History (Menu 5) | O(n)         | n = jumlah order di stack  |
| Cari Order (Menu 6)    | O(n)         | Linear search              |
| Tambah Driver (Menu 7) | O(1)         | Direct array access        |
| Hapus History (Menu 8) | O(1)         | Pop from stack             |

---

## 🎓 KONSEP YANG DIIMPLEMENTASIKAN

### 1. Abstract Data Type (ADT)

- ✅ Queue dengan operasi enqueue/dequeue
- ✅ Stack dengan operasi push/pop
- ✅ Linked List dengan operasi insert/traversal

### 2. Dynamic Memory Allocation

- ✅ `new` untuk alokasi
- ✅ `delete` untuk dealokasi
- ✅ Proper memory management

### 3. Pointer Manipulation

- ✅ Reference pointer (`MenuItem*& head`)
- ✅ Pointer dereferencing (`temp->next`)
- ✅ Pointer arithmetic

### 4. Algorithm Design

- ✅ Greedy (pilih driver terdekat)
- ✅ Sorting (Bubble Sort)
- ✅ Searching (Linear Search)
- ✅ Distance Calculation (Euclidean)

### 5. Data Structure Integration

- ✅ Linked List dalam Queue
- ✅ Linked List dalam Stack
- ✅ Linked List dalam Order (items)
- ✅ Array untuk Driver

---

## 🔧 TIPS PENGGUNAAN

### 1. Membuat Order

- Gunakan koordinat yang realistis (0-10)
- Tambahkan minimal 1 item
- Ketik "selesai" untuk stop input items

### 2. Assign Order

- Pastikan ada order di queue (Menu 2)
- Pastikan ada driver available (Menu 4)
- Driver terdekat akan dipilih otomatis

### 3. Lihat History

- History menampilkan order yang sudah selesai
- Urutan LIFO (terakhir selesai di atas)
- Gunakan Menu 8 untuk hapus order terakhir

### 4. Tambah Driver

- Maksimal 5 driver
- Posisi driver akan update setelah antar order
- Status "available" atau "busy"

---

## ⚠️ CATATAN PENTING

### Batasan Program

- ❗ Maksimal 5 driver (static array)
- ❗ Tidak ada validasi input angka negatif
- ❗ Simulasi sederhana (driver langsung available setelah antar)

### Kelebihan Program

- ✅ Memory safe (proper new/delete)
- ✅ Implementasi lengkap ADT
- ✅ Algoritma efisien untuk dataset kecil
- ✅ User-friendly menu

### Pengembangan Lebih Lanjut

- 🔄 Dynamic array untuk driver (unlimited)
- 🔄 Priority queue berdasarkan waktu
- 🔄 Validasi input yang lebih ketat
- 🔄 Save/load data ke file
- 🔄 GUI interface

---

## 📝 KESIMPULAN

Program **Food Delivery Route Optimizer** berhasil mengimplementasikan:

1. **4 Struktur Data Utama**
   - Linked List (items)
   - Queue (pending orders)
   - Stack (history)
   - Array (drivers)

2. **3 Algoritma Penting**
   - Bubble Sort (O(n²))
   - Linear Search (O(n))
   - Euclidean Distance (O(1))

3. **Memory Management**
   - Proper allocation/deallocation
   - No memory leaks
   - Safe pointer operations

4. **User Experience**
   - Menu interaktif
   - Clear output
   - Error handling

Program ini mendemonstrasikan bagaimana struktur data dan algoritma bekerja bersama untuk menyelesaikan masalah nyata dalam sistem pengiriman makanan.

---

**Dibuat untuk:** Final Project Struktur Data  
**Bahasa:** C++  
**Compiler:** g++ (C++11 atau lebih baru)  
**Tanggal:** 19 Januari 2026
