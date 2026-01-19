# 🎤 MATERI PRESENTASI KELOMPOK

## Food Delivery Route Optimizer

---

# 📋 GAMBARAN UMUM

## Nama Aplikasi

**Food Delivery Route Optimizer** - Sistem Manajemen Delivery Makanan

## Struktur Data yang Digunakan

| Struktur Data   | Implementasi                      | Fungsi                        |
| --------------- | --------------------------------- | ----------------------------- |
| **Struct**      | MenuItem, Order, Driver, Location | Merepresentasikan objek nyata |
| **Linked List** | Daftar item per order             | Data dinamis tanpa batas      |
| **Queue**       | Antrian order pending             | FIFO - First In First Out     |
| **Stack**       | Riwayat order selesai             | LIFO - Last In First Out      |
| **Array**       | Daftar driver                     | Penyimpanan statis (max 5)    |
| **Sorting**     | Bubble Sort                       | Urutkan driver by jarak       |
| **Searching**   | Linear Search                     | Cari order by ID              |

## Alur Presentasi

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   ORANG 1    │ ──► │   ORANG 2    │ ──► │   ORANG 3    │
│ Data & Input │     │ Queue & Stack│     │  Algorithm   │
│   (5 menit)  │     │   (5 menit)  │     │  (5 menit)   │
└──────────────┘     └──────────────┘     └──────────────┘
```

---

# � PEMBAGIAN PENANGGUNG JAWAB (PJ) KODE

## 📌 PJ 1: Data Structure & Input Functions

**Tanggung Jawab:** Struct definitions, Linked List operations, Input handling

### Fungsi yang Dikuasai:

- ✅ `struct Location` (Baris 17-20)
- ✅ `struct MenuItem` (Baris 10-14)
- ✅ `struct Order` (Baris 23-32)
- ✅ `struct Driver` (Baris 35-42)
- ✅ `tambahItem()` (Baris 70-85)
- ✅ `tampilkanItems()` (Baris 88-94)
- ✅ `hitungTotalHarga()` (Baris 97-105)
- ✅ `buatOrderBaru()` (Baris 334-375)
- ✅ `tambahDriver()` (Baris 215-232)

---

## 📌 PJ 2: Queue & Stack Management

**Tanggung Jawab:** Queue operations, Stack operations, Data flow management

### Fungsi yang Dikuasai:

- ✅ `struct StackNode` (Baris 45-48)
- ✅ `enqueueOrder()` (Baris 110-125)
- ✅ `dequeueOrder()` (Baris 128-144) - **UPDATED: Fixed memory leak**
- ✅ `tampilkanPendingOrders()` (Baris 147-165)
- ✅ `pushStack()` (Baris 170-175)
- ✅ `popStack()` (Baris 178-193) - **UPDATED: Fixed memory leak**
- ✅ `tampilkanHistory()` (Baris 196-210)

---

## 📌 PJ 3: Algorithms & Main Program

**Tanggung Jawab:** Sorting, Searching, Driver assignment logic, Main loop

### Fungsi yang Dikuasai:

- ✅ `hitungJarak()` (Baris 63-65)
- ✅ `sortDriversByDistance()` (Baris 247-259)
- ✅ `searchOrderByID()` (Baris 264-274)
- ✅ `binarySearchLocation()` (Baris 277-285)
- ✅ `assignOrderToDriver()` (Baris 290-326) - **UPDATED: Fixed memory leak**
- ✅ `tampilkanDrivers()` (Baris 235-242)
- ✅ `main()` (Baris 379-482)

---

# �👤 ORANG 1: Data Structure & Input

## 🎯 Tugas Utama

Membuka presentasi, menjelaskan apa saja **data** yang digunakan, dan bagaimana **user memasukkan pesanan**.

---

## 📝 Script Presentasi

### Pembukaan (30 detik)

> **[PJ 1]** "Selamat pagi/siang, perkenalkan kami dari kelompok [NAMA KELOMPOK]. Hari ini kami akan mempresentasikan program **Food Delivery Route Optimizer** - sebuah sistem manajemen delivery makanan yang mengimplementasikan berbagai struktur data."
>
> "Program ini mensimulasikan bagaimana aplikasi ojek online mengelola pesanan, dari customer melakukan order hingga driver mengantar makanan."

---

### Bagian 1: Struct sebagai Model Data (2 menit)

> **[PJ 1]** "Pertama, saya akan menjelaskan bagaimana kami merepresentasikan data dalam program ini menggunakan **Struct**."

#### 1.1 Struct Location

```cpp
struct Location {
    string alamat;
    float x, y;  // koordinat
};
```

> **[PJ 1]** "**Location** menyimpan informasi lokasi dengan 2 cara:
>
> - `alamat` → alamat dalam bentuk teks (misal: Jl. Sudirman No. 10)
> - `x, y` → koordinat untuk menghitung jarak"

#### 1.2 Struct MenuItem (⭐ Linked List)

```cpp
struct MenuItem {
    string namaItem;
    int harga;
    MenuItem* next;  // ← pointer ke item berikutnya
};
```

> **[PJ 1]** "**MenuItem** merepresentasikan satu item makanan. Yang special di sini adalah penggunaan **pointer `next`** yang menunjuk ke item berikutnya."
>
> "Kenapa pakai Linked List? Karena jumlah item yang dipesan customer bisa **berbeda-beda** - bisa 1 item, bisa 10 item. Dengan Linked List, kita tidak perlu menentukan batas di awal."

**Visualisasi:**

```
Order Customer A:
head → [Nasi Goreng|25000] → [Es Teh|5000] → [Kerupuk|3000] → NULL

Order Customer B:
head → [Mie Ayam|20000] → NULL
```

#### 1.3 Struct Order

```cpp
struct Order {
    int orderID;
    string customerName;
    Location lokasi;
    MenuItem* items;  // ← HEAD linked list items
    int totalHarga;
    string status;    // "pending", "on delivery", "completed"
    Order* next;      // ← untuk Queue
};
```

> **[PJ 1]** "**Order** menyimpan semua informasi pesanan:
>
> - ID unik untuk tracking
> - Nama customer
> - Lokasi pengiriman
> - `items` adalah **HEAD pointer** ke linked list MenuItem
> - Total harga (dihitung dari semua items)
> - Status pesanan
> - `next` untuk membentuk **Queue** (akan dijelaskan Orang 2)"

#### 1.4 Struct Driver

```cpp
struct Driver {
    int driverID;
    string nama;
    Location posisiSaatIni;
    int kapasitas;
    string status;  // "available", "busy"
};
```

> **[PJ 1]** "**Driver** menyimpan data kurir termasuk posisi saat ini yang akan berubah setelah setiap pengantaran."

---

### Bagian 2: Fungsi Input Order (2 menit)

#### 2.1 Fungsi tambahItem()

```cpp
void tambahItem(MenuItem*& head, string nama, int harga) {
    MenuItem* newItem = new MenuItem;
    newItem->namaItem = nama;
    newItem->harga = harga;
    newItem->next = NULL;

    if (head == NULL) {
        head = newItem;
    } else {
        MenuItem* temp = head;
        while (temp->next != NULL) {
            temp = temp->next;
        }
        temp->next = newItem;
    }
}
```

> **[PJ 1]** "Fungsi ini menambahkan item ke **akhir** linked list. Perhatikan parameter `MenuItem*& head` menggunakan **reference pointer** agar perubahan head berpengaruh ke variabel asli."

**Langkah-langkah:**

1. Buat node baru dengan `new MenuItem`
2. Isi data nama dan harga
3. Jika list kosong → head langsung menunjuk node baru
4. Jika tidak → traverse ke akhir, sambungkan node baru

#### 2.2 Fungsi buatOrderBaru()

```cpp
void buatOrderBaru() {
    Order newOrder;
    newOrder.orderID = nextOrderID++;

    cout << "Nama Customer: ";
    cin.ignore();  // ← PENTING!
    getline(cin, newOrder.customerName);

    cout << "Alamat: ";
    getline(cin, newOrder.lokasi.alamat);

    // ... input koordinat dan items

    enqueueOrder(newOrder);  // → masuk ke Queue (Orang 2)
}
```

> **[PJ 1]** "Fungsi ini mengambil input dari user untuk membuat order baru."

**⚠️ Highlight Teknis:**

> **[PJ 1]** "Perhatikan penggunaan `cin.ignore()` sebelum `getline()`. Ini **PENTING** karena:
>
> - `cin >>` meninggalkan karakter newline (`\n`) di buffer
> - `getline()` akan langsung membaca newline tersebut dan skip
> - `cin.ignore()` membersihkan buffer terlebih dahulu"

---

### Demo Menu 1 (30 detik)

> **[PJ 1]** "Mari kita lihat demo singkat cara membuat order..."

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
Nama item: selesai

✓ Order #1 ditambahkan ke queue!
```

---

### 🔗 Kalimat Transisi ke Orang 2

> **[PJ 1]** "Seperti yang kita lihat, setelah data order dibuat, order tersebut **tidak langsung dikirim**, tapi masuk ke **antrian** dengan pesan 'ditambahkan ke queue'. Teman saya [NAMA ORANG 2] akan menjelaskan bagaimana antrian ini bekerja."

---

## 📊 Ringkasan Orang 1

| Komponen                 | Yang Dijelaskan              |
| ------------------------ | ---------------------------- |
| Struct Location          | Menyimpan alamat + koordinat |
| Struct MenuItem          | Linked List items per order  |
| Struct Order             | Data pesanan lengkap         |
| Struct Driver            | Data kurir                   |
| tambahItem()             | Insert di akhir linked list  |
| buatOrderBaru()          | Input data dari user         |
| cin.ignore() + getline() | Handling input string        |

---

---

# 👤 ORANG 2: Queue & Stack Management

## 🎯 Tugas Utama

Menjelaskan **jantung** dari sistem ini - bagaimana data **bergerak masuk dan keluar** menggunakan struktur data dinamis.

---

## 📝 Script Presentasi

### Pembukaan (15 detik)

> **[PJ 2]** "Terima kasih [NAMA ORANG 1]. Sekarang saya akan menjelaskan bagaimana order yang sudah dibuat tadi dikelola menggunakan **Queue** dan **Stack**."

---

### Bagian 1: Konsep Queue - Antrian Order (2.5 menit)

#### 1.1 Apa itu Queue?

> **[PJ 2]** "**Queue** adalah struktur data yang bekerja dengan prinsip **FIFO - First In First Out**. Seperti antrian di kasir: yang datang duluan, dilayani duluan."

```
Visualisasi Queue:
                    FRONT (keluar)                    REAR (masuk)
                         ↓                                ↓
orderQueueHead → [Order #1] → [Order #2] → [Order #3] → NULL
                 (pertama)                   (terakhir)
```

> **[PJ 2]** "Variabel `orderQueueHead` adalah pointer ke order **pertama** dalam antrian."

#### 1.2 Fungsi enqueueOrder() - Masuk Antrian

```cpp
void enqueueOrder(Order orderBaru) {
    Order* newOrder = new Order;
    *newOrder = orderBaru;
    newOrder->next = NULL;

    if (orderQueueHead == NULL) {
        orderQueueHead = newOrder;
    } else {
        Order* temp = orderQueueHead;
        while (temp->next != NULL) {
            temp = temp->next;
        }
        temp->next = newOrder;  // tambah di BELAKANG
    }
}
```

> **[PJ 2]** "Ketika ada order baru, kita **tambahkan di belakang** antrian. Ini memastikan prinsip FIFO terjaga."

**Langkah-langkah:**

1. Buat node baru di memori
2. Copy data order ke node baru
3. Jika queue kosong → head langsung menunjuk node baru
4. Jika tidak → traverse ke akhir, sambungkan

#### 1.3 Fungsi dequeueOrder() - Keluar Antrian ⭐ UPDATED

```cpp
Order* dequeueOrder() {
    if (orderQueueHead == NULL) {
        return NULL;
    }
    Order* temp = orderQueueHead;
    orderQueueHead = orderQueueHead->next;  // geser head

    // Buat copy dari order data
    Order* order = new Order;
    *order = *temp;
    order->next = NULL;  // Putus link ke queue

    // Hapus node asli untuk mencegah memory leak
    delete temp;

    return order;  // return copy yang aman
}
```

> **[PJ 2]** "Ketika order akan diproses, kita **ambil dari depan** antrian. Yang penting di sini adalah:
>
> 1. Kita **membuat copy** dari data order
> 2. **Memutus link** `next` agar tidak terhubung ke queue
> 3. **Menghapus node asli** dengan `delete temp` untuk mencegah memory leak
> 4. Mengembalikan pointer ke copy yang aman"

**Visualisasi:**

```
SEBELUM dequeue:
head → [Order #1] → [Order #2] → [Order #3] → NULL
           ↑
       (diambil & di-copy)

SETELAH dequeue:
head → [Order #2] → [Order #3] → NULL

Return: Copy of Order #1 (node asli sudah di-delete)
```

#### 1.4 Fungsi tampilkanPendingOrders()

```cpp
void tampilkanPendingOrders() {
    Order* temp = orderQueueHead;
    while (temp != NULL) {
        // print detail order
        temp = temp->next;
    }
}
```

> **[PJ 2]** "Fungsi ini melakukan **traversal** dari head sampai NULL untuk menampilkan semua order pending."

---

### Demo Menu 2 (15 detik)

```
===== PENDING ORDERS =====
1. Order #1 - Budi Santoso
   Alamat: Jl. Merdeka No. 15 (4.5, 3.2)
   Items:
   - Nasi Goreng (Rp25000)
   - Es Teh (Rp5000)
   Total: Rp30000
   Waktu: 10 menit

2. Order #2 - Siti Rahayu
   Alamat: Jl. Sudirman No. 5 (2.0, 4.0)
   ...
```

---

### Bagian 2: Konsep Stack - Riwayat Order (2 menit)

#### 2.1 Apa itu Stack?

> **[PJ 2]** "**Stack** bekerja dengan prinsip **LIFO - Last In First Out**. Seperti tumpukan piring: yang terakhir ditaruh, yang pertama diambil."

```
Visualisasi Stack:
   TOP (masuk & keluar)
          ↓
completedOrdersStack → [Order #3] ← yang terakhir selesai
                           ↓
                       [Order #2]
                           ↓
                       [Order #1] ← yang pertama selesai
                           ↓
                         NULL
```

> **[PJ 2]** "Order yang **baru saja selesai** akan muncul **paling atas** di history."

#### 2.2 Struct StackNode

```cpp
struct StackNode {
    Order orderData;      // data order
    StackNode* next;      // pointer ke node di bawah
};
```

#### 2.3 Fungsi pushStack() - Tambah ke History

```cpp
void pushStack(Order order) {
    StackNode* newNode = new StackNode;
    newNode->orderData = order;
    newNode->next = completedOrdersStack;  // tunjuk ke top lama
    completedOrdersStack = newNode;        // top = node baru
}
```

> **[PJ 2]** "Ketika order selesai diantar, kita **push ke atas** stack."

**Visualisasi:**

```
SEBELUM push Order #4:
top → [Order #3] → [Order #2] → NULL

SETELAH push:
top → [Order #4] → [Order #3] → [Order #2] → NULL
      (baru)
```

#### 2.4 Fungsi popStack() - Hapus dari History ⭐ UPDATED

```cpp
Order* popStack() {
    if (completedOrdersStack == NULL) {
        return NULL;
    }
    StackNode* temp = completedOrdersStack;
    completedOrdersStack = completedOrdersStack->next;

    // Buat copy dari order data
    Order* order = new Order;
    *order = temp->orderData;

    // Hapus node untuk mencegah memory leak
    delete temp;

    return order;
}
```

> **[PJ 2]** "Fungsi `popStack()` digunakan untuk mengambil dan menghapus order terakhir dari history. Sama seperti `dequeueOrder()`, kita:
>
> 1. **Membuat copy** dari data order
> 2. **Menghapus node asli** untuk mencegah memory leak
> 3. Mengembalikan pointer ke copy yang aman"

#### 2.5 Fungsi tampilkanHistory()

```cpp
void tampilkanHistory() {
    StackNode* temp = completedOrdersStack;
    while (temp != NULL) {
        // print dari top ke bawah
        temp = temp->next;
    }
}
```

---

### Demo Menu 5 & 8 (20 detik)

```
===== HISTORY COMPLETED ORDERS =====
1. Order #3 - Customer C     ← yang terakhir selesai
   Total: Rp45000
2. Order #2 - Customer B
   Total: Rp30000
3. Order #1 - Customer A     ← yang pertama selesai
   Total: Rp25000

Pilihan: 8

Order terakhir dihapus dari history:
Order #3 - Customer C
Total: Rp45000
Items:
- Ayam Bakar (Rp40000)
- Es Jeruk (Rp5000)
```

> **[PJ 2]** "Perhatikan order #3 muncul paling atas karena dia yang **terakhir selesai** (LIFO). Menu 8 memungkinkan kita menghapus order terakhir dari history."

---

### Bagian 3: Memory Management (30 detik)

> **[PJ 2]** "Penting untuk diperhatikan: dalam program ini, kami sudah mengimplementasikan **proper memory management**:
>
> - Setiap `new` pasti ada `delete` yang sesuai
> - `dequeueOrder()` dan `popStack()` mengembalikan **copy** dan menghapus node asli
> - Ini mencegah **memory leak** yang bisa membuat program crash jika dijalankan lama"

---

### 🔗 Kalimat Transisi ke Orang 3

> **[PJ 2]** "Nah, setelah order diambil dari antrian dengan `dequeueOrder()`, sistem harus **pintar memilih driver** mana yang paling dekat. Bagian algoritma cerdas ini akan dijelaskan oleh teman saya [NAMA ORANG 3]."

---

## 📊 Ringkasan Orang 2

| Komponen       | Konsep                     | Prinsip           | Memory Safe |
| -------------- | -------------------------- | ----------------- | ----------- |
| Queue          | Antrian order pending      | FIFO              | ✅          |
| enqueueOrder() | Masuk di belakang          | Insert at rear    | ✅          |
| dequeueOrder() | Keluar dari depan          | Remove from front | ✅ Fixed    |
| Stack          | Riwayat order selesai      | LIFO              | ✅          |
| pushStack()    | Taruh di atas              | Insert at top     | ✅          |
| popStack()     | Ambil dari atas            | Remove from top   | ✅ Fixed    |
| Linked List    | Implementasi Queue & Stack | Dinamis           | ✅          |

---

---

# 👤 ORANG 3: Driver Logic, Algorithm & Main Loop

## 🎯 Tugas Utama

Menjelaskan fitur **"pintar"** aplikasi (Algoritma) dan **menutup presentasi**.

---

## 📝 Script Presentasi

### Pembukaan (15 detik)

> **[PJ 3]** "Terima kasih [NAMA ORANG 2]. Sekarang saya akan menjelaskan bagaimana sistem kami secara **otomatis memilih driver terbaik** menggunakan algoritma."

---

### Bagian 1: Algoritma Perhitungan Jarak (1 menit)

#### 1.1 Rumus Euclidean Distance

```cpp
float hitungJarak(Location a, Location b) {
    return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));
}
```

> **[PJ 3]** "Kita menggunakan rumus **Euclidean Distance** atau rumus Pythagoras untuk menghitung jarak antar dua titik koordinat."

**Rumus Matematika:**

```
Jarak = √[(x₁ - x₂)² + (y₁ - y₂)²]
```

**Contoh Perhitungan:**

```
Driver Budi ada di posisi (1, 1)
Customer ada di posisi (4, 5)

Jarak = √[(1-4)² + (1-5)²]
      = √[(-3)² + (-4)²]
      = √[9 + 16]
      = √25
      = 5 km
```

---

### Bagian 2: Algoritma Sorting - Bubble Sort (1.5 menit)

#### 2.1 Fungsi sortDriversByDistance()

```cpp
void sortDriversByDistance(Location target) {
    for (int i = 0; i < driverCount - 1; i++) {
        for (int j = 0; j < driverCount - i - 1; j++) {
            float jarak1 = hitungJarak(drivers[j].posisiSaatIni, target);
            float jarak2 = hitungJarak(drivers[j+1].posisiSaatIni, target);

            if (jarak1 > jarak2) {
                // Swap driver
                Driver temp = drivers[j];
                drivers[j] = drivers[j+1];
                drivers[j+1] = temp;
            }
        }
    }
}
```

> **[PJ 3]** "Kita menggunakan **Bubble Sort** untuk mengurutkan driver dari yang **terdekat** ke **terjauh** dari restoran."

**Cara Kerja Bubble Sort:**

1. Bandingkan 2 elemen bersebelahan
2. Jika urutan salah → tukar posisi
3. Ulangi sampai tidak ada pertukaran

**Visualisasi:**

```
SEBELUM sort (target = restaurant di 0,0):
┌─────────┬─────────┬─────────┐
│  Andi   │  Siti   │  Budi   │
│ (5,2)   │ (3,5)   │ (1,0)   │
│ jarak=  │ jarak=  │ jarak=  │
│  5.39   │  5.83   │  1.00   │
└─────────┴─────────┴─────────┘

SETELAH sort:
┌─────────┬─────────┬─────────┐
│  Budi   │  Andi   │  Siti   │
│ (1,0)   │ (5,2)   │ (3,5)   │
│ jarak=  │ jarak=  │ jarak=  │
│  1.00   │  5.39   │  5.83   │
└─────────┴─────────┴─────────┘
  TERDEKAT           TERJAUH
```

> **[PJ 3]** "Ini adalah pendekatan **Greedy** - selalu pilih driver terdekat untuk efisiensi."

---

### Bagian 3: Proses Assign Order ke Driver (1.5 menit)

#### 3.1 Fungsi assignOrderToDriver() ⭐ UPDATED

```cpp
void assignOrderToDriver() {
    // 1. Validasi
    if (orderQueueHead == NULL) {
        cout << "Tidak ada order!" << endl;
        return;
    }

    // 2. Ambil order dari Queue (dari Orang 2)
    Order* order = dequeueOrder();

    // 3. Sort driver by jarak
    Location restaurant = {"Restaurant", 0, 0};
    sortDriversByDistance(restaurant);

    // 4. Cari driver available
    bool assigned = false;
    for (int i = 0; i < driverCount; i++) {
        if (drivers[i].status == "available") {
            // 5. Assign order
            float jarak = hitungJarak(drivers[i].posisiSaatIni, order->lokasi);
            cout << "Order #" << order->orderID << " di-assign ke " << drivers[i].nama << endl;
            cout << "Jarak: " << jarak << " km" << endl;
            cout << "Estimasi: " << (int)(jarak * 5) << " menit" << endl;

            // 6. Update status
            drivers[i].status = "busy";
            order->status = "completed";

            // 7. Push ke Stack history (dari Orang 2)
            pushStack(*order);

            // 8. Update posisi driver
            drivers[i].posisiSaatIni = order->lokasi;
            drivers[i].status = "available";

            assigned = true;
            break;
        }
    }

    if (!assigned) {
        cout << "Semua driver sedang busy! Order dikembalikan ke queue." << endl;
        enqueueOrder(*order);
    }

    // 9. Hapus order setelah diproses untuk mencegah memory leak
    delete order;
}
```

> **[PJ 3]** "Perhatikan di akhir fungsi, kita **menghapus order** dengan `delete order`. Ini penting karena:
>
> - Order sudah di-copy ke stack dengan `pushStack(*order)` atau di-enqueue kembali
> - Pointer asli tidak lagi dibutuhkan
> - Tanpa `delete`, akan terjadi memory leak"

**Alur Proses (Diagram):**

```
┌─────────────────────────────────────────────────────────────┐
│                    assignOrderToDriver()                    │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌─────────────┐                                            │
│  │ Ada order?  │──No──► "Tidak ada order!"                  │
│  └──────┬──────┘                                            │
│         │Yes                                                │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │ dequeue()   │ ← Ambil order pertama dari Queue           │
│  └──────┬──────┘   (copy & delete node asli)               │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │ Bubble Sort │ ← Urutkan driver by jarak                  │
│  └──────┬──────┘                                            │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │ Loop Driver │ ← Cari yang "available"                    │
│  └──────┬──────┘                                            │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │ Hitung Jarak│ ← Euclidean distance                       │
│  └──────┬──────┘                                            │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │ pushStack() │ ← Masukkan ke history (Stack)              │
│  └──────┬──────┘                                            │
│         ▼                                                   │
│  ┌─────────────┐                                            │
│  │delete order │ ← Hapus copy untuk cegah memory leak       │
│  └─────────────┘                                            │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

> **[PJ 3]** "Fungsi ini menghubungkan semua komponen:
>
> - Mengambil order dari **Queue** (yang dijelaskan Orang 2)
> - Menggunakan **Sorting** untuk pilih driver terbaik
> - Menyimpan hasil ke **Stack** history
> - **Membersihkan memory** dengan proper deletion"

---

### Bagian 4: Searching (30 detik)

```cpp
Order* searchOrderByID(int id) {
    Order* temp = orderQueueHead;
    while (temp != NULL) {
        if (temp->orderID == id) {
            return temp;
        }
        temp = temp->next;
    }
    return NULL;
}
```

> **[PJ 3]** "Kita juga punya fitur **Linear Search** untuk mencari order berdasarkan ID. Kompleksitasnya O(n) karena harus traverse linked list."

---

### Bagian 5: Main Loop (30 detik)

```cpp
int main() {
    // Inisialisasi driver
    tambahDriver("Budi", 1.0, 0.0);
    tambahDriver("Siti", 3.0, 5.0);
    tambahDriver("Andi", 5.0, 2.0);

    while (true) {
        // Tampilkan menu
        cout << "1. Buat Order Baru" << endl;
        cout << "2. Lihat Pending Orders" << endl;
        cout << "3. Assign Order ke Driver" << endl;
        cout << "4. Lihat Daftar Driver" << endl;
        cout << "5. Lihat History Completed Orders" << endl;
        cout << "6. Cari Order by ID" << endl;
        cout << "7. Tambah Driver Baru" << endl;
        cout << "8. Hapus Order Terakhir dari History" << endl;
        cout << "0. Keluar" << endl;

        switch (pilihan) {
            case 1: buatOrderBaru(); break;
            case 2: tampilkanPendingOrders(); break;
            case 3: assignOrderToDriver(); break;
            case 4: tampilkanDrivers(); break;
            case 5: tampilkanHistory(); break;
            case 6: /* search by ID */ break;
            case 7: /* tambah driver */ break;
            case 8: /* pop stack */ break;
            case 0: return 0;
        }
    }
}
```

> **[PJ 3]** "Fungsi `main()` adalah **pusat navigasi** program yang menghubungkan semua fitur melalui switch-case. Perhatikan ada menu baru (8) untuk menghapus order dari history."

---

### Demo Menu 3 & 4 (30 detik)

```
===== DAFTAR DRIVER (SEBELUM) =====
1. Budi (ID: 1)
   Posisi: (1, 0)
   Status: available

Pilihan: 3

✓ Order #1 di-assign ke Budi
  Jarak: 4.30 km
  Estimasi: 21 menit

===== DAFTAR DRIVER (SESUDAH) =====
1. Budi (ID: 1)
   Posisi: (4.5, 3.2)  ← posisi berubah!
   Status: available
```

---

### 🔚 Penutupan Presentasi

> **[PJ 3]** "Demikianlah presentasi kami tentang program **Food Delivery Route Optimizer**."

> "Program ini menggabungkan berbagai struktur data:
>
> - **Struct** untuk merepresentasikan objek
> - **Linked List** untuk data dinamis
> - **Queue** untuk antrian dengan prinsip FIFO
> - **Stack** untuk history dengan prinsip LIFO
> - **Array** untuk menyimpan driver
> - **Bubble Sort** untuk mengurutkan driver
> - **Linear Search** untuk mencari order
> - **Proper Memory Management** untuk mencegah memory leak"

> "Sekian presentasi dari kami. Terima kasih atas perhatiannya. Ada pertanyaan?"

---

## 📊 Ringkasan Orang 3

| Komponen                | Algoritma          | Kompleksitas | Memory Safe |
| ----------------------- | ------------------ | ------------ | ----------- |
| hitungJarak()           | Euclidean Distance | O(1)         | ✅          |
| sortDriversByDistance() | Bubble Sort        | O(n²)        | ✅          |
| searchOrderByID()       | Linear Search      | O(n)         | ✅          |
| assignOrderToDriver()   | Kombinasi semua    | -            | ✅ Fixed    |
| main()                  | Switch-case menu   | -            | ✅          |

---

---

# 📋 CHECKLIST PRESENTASI

## Sebelum Presentasi

- [ ] Compile program dan pastikan tidak error
- [ ] Siapkan beberapa test case untuk demo
- [ ] Bagi waktu: masing-masing 5 menit
- [ ] Latihan transisi antar presenter
- [ ] Pastikan setiap PJ paham fungsi yang menjadi tanggung jawabnya

## Urutan Demo

| Demo | Menu                     | Presenter |
| ---- | ------------------------ | --------- |
| 1    | Menu 1 - Buat Order      | Orang 1   |
| 2    | Menu 2 - Lihat Pending   | Orang 2   |
| 3    | Menu 5 - Lihat History   | Orang 2   |
| 4    | Menu 8 - Pop Stack (NEW) | Orang 2   |
| 5    | Menu 4 - Lihat Driver    | Orang 3   |
| 6    | Menu 3 - Assign Order    | Orang 3   |

## Tips Presentasi

### Untuk PJ 1:

- Fokus pada **konsep struct** dan **linked list**
- Jelaskan **kenapa** pakai pointer, bukan hanya **bagaimana**
- Demo input harus lancar (latih `cin.ignore()`)

### Untuk PJ 2:

- Tekankan perbedaan **FIFO vs LIFO**
- Visualisasi sangat penting - gunakan diagram
- Jelaskan **memory management** dengan jelas (ini yang membedakan program bagus vs biasa)
- Demo menu 8 untuk tunjukkan `popStack()` bekerja

### Untuk PJ 3:

- Jelaskan **algoritma** dengan contoh konkret
- Tunjukkan **kompleksitas** waktu
- Hubungkan semua komponen di `assignOrderToDriver()`
- Tutup dengan kuat - ringkas semua yang sudah dijelaskan

---

# 🎯 PERTANYAAN YANG MUNGKIN MUNCUL

## Q1: Kenapa pakai Linked List, bukan Array?

**Jawab (PJ 1/2):**

> "Karena jumlah order dan item tidak bisa diprediksi. Dengan Linked List, kita bisa menambah data sebanyak mungkin tanpa batasan di awal. Array harus tentukan ukuran dari awal dan tidak bisa berubah."

## Q2: Kenapa Bubble Sort, bukan Quick Sort?

**Jawab (PJ 3):**

> "Karena jumlah driver maksimal hanya 5, jadi kompleksitas O(n²) tidak masalah. Bubble Sort lebih mudah diimplementasikan dan dipahami untuk dataset kecil."

## Q3: Apa bedanya `delete` dengan `free()`?

**Jawab (PJ 2):**

> "Dalam C++, kita pakai `delete` untuk memory yang dialokasikan dengan `new`. `free()` adalah untuk C yang pakai `malloc()`. Keduanya tidak bisa dicampur."

## Q4: Kenapa perlu `cin.ignore()`?

**Jawab (PJ 1):**

> "Karena `cin >>` meninggalkan karakter newline di buffer. Tanpa `cin.ignore()`, `getline()` akan langsung membaca newline tersebut dan melewatkan input user."

## Q5: Apa yang terjadi kalau tidak `delete` node?

**Jawab (PJ 2):**

> "Akan terjadi **memory leak** - memory yang sudah tidak dipakai tidak dikembalikan ke sistem. Kalau program jalan lama, bisa kehabisan memory dan crash."

## Q6: Bagaimana kalau semua driver busy?

**Jawab (PJ 3):**

> "Order akan dikembalikan ke queue dengan `enqueueOrder(*order)` dan menunggu sampai ada driver yang available."

---

# 📝 CATATAN PENTING

## ✅ Update Terbaru (Sudah Diimplementasikan)

1. **Fixed `dequeueOrder()`** - Sekarang membuat copy dan delete node asli
2. **Fixed `popStack()`** - Sekarang membuat copy dan delete node asli
3. **Fixed `assignOrderToDriver()`** - Menambahkan `delete order` di akhir
4. **Added Menu 8** - Fitur untuk menghapus order terakhir dari history
5. **Proper Memory Management** - Semua fungsi sudah bebas memory leak

## 🎓 Pembelajaran Utama

Program ini mengajarkan:

- **Struct** untuk model data
- **Linked List** untuk data dinamis
- **Queue (FIFO)** untuk antrian
- **Stack (LIFO)** untuk history
- **Sorting** untuk optimasi
- **Searching** untuk pencarian
- **Memory Management** untuk program yang robust

---

**GOOD LUCK! 🚀**
