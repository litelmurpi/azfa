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

# 👤 ORANG 1: Data Structure & Input

## 🎯 Tugas Utama

Membuka presentasi, menjelaskan apa saja **data** yang digunakan, dan bagaimana **user memasukkan pesanan**.

---

## 📝 Script Presentasi

### Pembukaan (30 detik)

> "Selamat pagi/siang, perkenalkan kami dari kelompok [NAMA KELOMPOK]. Hari ini kami akan mempresentasikan program **Food Delivery Route Optimizer** - sebuah sistem manajemen delivery makanan yang mengimplementasikan berbagai struktur data."
>
> "Program ini mensimulasikan bagaimana aplikasi ojek online mengelola pesanan, dari customer melakukan order hingga driver mengantar makanan."

---

### Bagian 1: Struct sebagai Model Data (2 menit)

> "Pertama, saya akan menjelaskan bagaimana kami merepresentasikan data dalam program ini menggunakan **Struct**."

#### 1.1 Struct Location

```cpp
struct Location {
    string alamat;
    float x, y;  // koordinat
};
```

> "**Location** menyimpan informasi lokasi dengan 2 cara:
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

> "**MenuItem** merepresentasikan satu item makanan. Yang special di sini adalah penggunaan **pointer `next`** yang menunjuk ke item berikutnya."
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

> "**Order** menyimpan semua informasi pesanan:
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

> "**Driver** menyimpan data kurir termasuk posisi saat ini yang akan berubah setelah setiap pengantaran."

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

> "Fungsi ini menambahkan item ke **akhir** linked list. Perhatikan parameter `MenuItem*& head` menggunakan **reference pointer** agar perubahan head berpengaruh ke variabel asli."

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

> "Fungsi ini mengambil input dari user untuk membuat order baru."

**⚠️ Highlight Teknis:**

> "Perhatikan penggunaan `cin.ignore()` sebelum `getline()`. Ini **PENTING** karena:
>
> - `cin >>` meninggalkan karakter newline (`\n`) di buffer
> - `getline()` akan langsung membaca newline tersebut dan skip
> - `cin.ignore()` membersihkan buffer terlebih dahulu"

---

### Demo Menu 1 (30 detik)

> "Mari kita lihat demo singkat cara membuat order..."

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

> "Seperti yang kita lihat, setelah data order dibuat, order tersebut **tidak langsung dikirim**, tapi masuk ke **antrian** dengan pesan 'ditambahkan ke queue'. Teman saya [NAMA ORANG 2] akan menjelaskan bagaimana antrian ini bekerja."

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

> "Terima kasih [NAMA ORANG 1]. Sekarang saya akan menjelaskan bagaimana order yang sudah dibuat tadi dikelola menggunakan **Queue** dan **Stack**."

---

### Bagian 1: Konsep Queue - Antrian Order (2 menit)

#### 1.1 Apa itu Queue?

> "**Queue** adalah struktur data yang bekerja dengan prinsip **FIFO - First In First Out**. Seperti antrian di kasir: yang datang duluan, dilayani duluan."

```
Visualisasi Queue:
                    FRONT (keluar)                    REAR (masuk)
                         ↓                                ↓
orderQueueHead → [Order #1] → [Order #2] → [Order #3] → NULL
                 (pertama)                   (terakhir)
```

> "Variabel `orderQueueHead` adalah pointer ke order **pertama** dalam antrian."

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

> "Ketika ada order baru, kita **tambahkan di belakang** antrian. Ini memastikan prinsip FIFO terjaga."

**Langkah-langkah:**

1. Buat node baru di memori
2. Copy data order ke node baru
3. Jika queue kosong → head langsung menunjuk node baru
4. Jika tidak → traverse ke akhir, sambungkan

#### 1.3 Fungsi dequeueOrder() - Keluar Antrian

```cpp
Order* dequeueOrder() {
    if (orderQueueHead == NULL) {
        return NULL;
    }
    Order* temp = orderQueueHead;
    orderQueueHead = orderQueueHead->next;  // geser head
    return temp;  // return order yang diambil
}
```

> "Ketika order akan diproses, kita **ambil dari depan** antrian. Head digeser ke node berikutnya."

**Visualisasi:**

```
SEBELUM dequeue:
head → [Order #1] → [Order #2] → [Order #3] → NULL
           ↑
       (diambil)

SETELAH dequeue:
head → [Order #2] → [Order #3] → NULL
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

> "Fungsi ini melakukan **traversal** dari head sampai NULL untuk menampilkan semua order pending."

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

> "**Stack** bekerja dengan prinsip **LIFO - Last In First Out**. Seperti tumpukan piring: yang terakhir ditaruh, yang pertama diambil."

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

> "Order yang **baru saja selesai** akan muncul **paling atas** di history."

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

> "Ketika order selesai diantar, kita **push ke atas** stack."

**Visualisasi:**

```
SEBELUM push Order #4:
top → [Order #3] → [Order #2] → NULL

SETELAH push:
top → [Order #4] → [Order #3] → [Order #2] → NULL
      (baru)
```

#### 2.4 Fungsi tampilkanHistory()

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

### Demo Menu 5 (15 detik)

```
===== HISTORY COMPLETED ORDERS =====
1. Order #3 - Customer C     ← yang terakhir selesai
   Total: Rp45000
2. Order #2 - Customer B
   Total: Rp30000
3. Order #1 - Customer A     ← yang pertama selesai
   Total: Rp25000
```

> "Perhatikan order #3 muncul paling atas karena dia yang **terakhir selesai** (LIFO)."

---

### Bagian 3: Kenapa Linked List? (30 detik)

> "Pertanyaan: Kenapa kita pakai Linked List untuk Queue dan Stack, bukan Array?"

| Array                                   | Linked List          |
| --------------------------------------- | -------------------- |
| Ukuran tetap (harus ditentukan di awal) | Ukuran dinamis       |
| Insert/delete di tengah = O(n)          | Insert/delete = O(1) |
| Memory waste jika tidak penuh           | Memory efisien       |

> "Dengan Linked List, jumlah order **tidak dibatasi**. Bisa 10, bisa 1000, selama memory tersedia."

---

### 🔗 Kalimat Transisi ke Orang 3

> "Nah, setelah order diambil dari antrian dengan `dequeueOrder()`, sistem harus **pintar memilih driver** mana yang paling dekat. Bagian algoritma cerdas ini akan dijelaskan oleh teman saya [NAMA ORANG 3]."

---

## 📊 Ringkasan Orang 2

| Komponen       | Konsep                     | Prinsip           |
| -------------- | -------------------------- | ----------------- |
| Queue          | Antrian order pending      | FIFO              |
| enqueueOrder() | Masuk di belakang          | Insert at rear    |
| dequeueOrder() | Keluar dari depan          | Remove from front |
| Stack          | Riwayat order selesai      | LIFO              |
| pushStack()    | Taruh di atas              | Insert at top     |
| Linked List    | Implementasi Queue & Stack | Dinamis           |

---

---

# 👤 ORANG 3: Driver Logic, Algorithm & Main Loop

## 🎯 Tugas Utama

Menjelaskan fitur **"pintar"** aplikasi (Algoritma) dan **menutup presentasi**.

---

## 📝 Script Presentasi

### Pembukaan (15 detik)

> "Terima kasih [NAMA ORANG 2]. Sekarang saya akan menjelaskan bagaimana sistem kami secara **otomatis memilih driver terbaik** menggunakan algoritma."

---

### Bagian 1: Algoritma Perhitungan Jarak (1 menit)

#### 1.1 Rumus Euclidean Distance

```cpp
float hitungJarak(Location a, Location b) {
    return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));
}
```

> "Kita menggunakan rumus **Euclidean Distance** atau rumus Pythagoras untuk menghitung jarak antar dua titik koordinat."

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

> "Kita menggunakan **Bubble Sort** untuk mengurutkan driver dari yang **terdekat** ke **terjauh** dari restoran."

**Cara Kerja Bubble Sort:**

1. Bandingkan 2 elemen bersebelahan
2. Jika urutan salah → tukar posisi
3. Ulangi sampai tidak ada pertukaran

**Visualisasi:**

```
SEBELUM sort (target = restaurant di 0,0):
┌─────────┬─────────┬─────────┐
│  Andi   │  Siti   │  Budi   │
│ (4,2)   │ (2.5,3) │ (1,1)   │
│ jarak=  │ jarak=  │ jarak=  │
│  4.47   │  3.91   │  1.41   │
└─────────┴─────────┴─────────┘

SETELAH sort:
┌─────────┬─────────┬─────────┐
│  Budi   │  Siti   │  Andi   │
│ (1,1)   │ (2.5,3) │ (4,2)   │
│ jarak=  │ jarak=  │ jarak=  │
│  1.41   │  3.91   │  4.47   │
└─────────┴─────────┴─────────┘
  TERDEKAT           TERJAUH
```

> "Ini adalah pendekatan **Greedy** - selalu pilih driver terdekat untuk efisiensi."

---

### Bagian 3: Proses Assign Order ke Driver (1.5 menit)

#### 3.1 Fungsi assignOrderToDriver()

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

            break;
        }
    }
}
```

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
│  └──────┬──────┘                                            │
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
│  └─────────────┘                                            │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

> "Fungsi ini menghubungkan semua komponen:
>
> - Mengambil order dari **Queue** (yang dijelaskan Orang 2)
> - Menggunakan **Sorting** untuk pilih driver terbaik
> - Menyimpan hasil ke **Stack** history"

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

> "Kita juga punya fitur **Linear Search** untuk mencari order berdasarkan ID. Kompleksitasnya O(n) karena harus traverse linked list."

---

### Bagian 5: Main Loop (30 detik)

```cpp
int main() {
    // Inisialisasi driver
    tambahDriver("Budi", 1.0, 1.0);
    tambahDriver("Siti", 2.5, 3.0);
    tambahDriver("Andi", 4.0, 2.0);

    while (true) {
        // Tampilkan menu
        cout << "1. Buat Order Baru" << endl;
        cout << "2. Lihat Pending Orders" << endl;
        // ...

        switch (pilihan) {
            case 1: buatOrderBaru(); break;
            case 2: tampilkanPendingOrders(); break;
            case 3: assignOrderToDriver(); break;
            // ...
        }
    }
}
```

> "Fungsi `main()` adalah **pusat navigasi** program yang menghubungkan semua fitur melalui switch-case."

---

### Demo Menu 3 & 4 (30 detik)

```
===== DAFTAR DRIVER (SEBELUM) =====
1. Budi (ID: 1)
   Posisi: (1, 1)
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

> "Demikianlah presentasi kami tentang program **Food Delivery Route Optimizer**."

> "Program ini menggabungkan berbagai struktur data:
>
> - **Struct** untuk merepresentasikan objek
> - **Linked List** untuk data dinamis
> - **Queue** untuk antrian dengan prinsip FIFO
> - **Stack** untuk history dengan prinsip LIFO
> - **Array** untuk menyimpan driver
> - **Bubble Sort** untuk mengurutkan driver
> - **Linear Search** untuk mencari order"

> "Sekian presentasi dari kami. Terima kasih atas perhatiannya. Ada pertanyaan?"

---

## 📊 Ringkasan Orang 3

| Komponen                | Algoritma          | Kompleksitas |
| ----------------------- | ------------------ | ------------ |
| hitungJarak()           | Euclidean Distance | O(1)         |
| sortDriversByDistance() | Bubble Sort        | O(n²)        |
| searchOrderByID()       | Linear Search      | O(n)         |
| assignOrderToDriver()   | Kombinasi semua    | -            |
| main()                  | Switch-case menu   | -            |

---

---

# 📋 CHECKLIST PRESENTASI

## Sebelum Presentasi

- [ ] Compile program dan pastikan tidak error
- [ ] Siapkan beberapa test case untuk demo
- [ ] Bagi waktu: masing-masing 5 menit
- [ ] Latihan transisi antar presenter

## Urutan Demo

| Demo | Menu                   | Presenter |
| ---- | ---------------------- | --------- |
| 1    | Menu 1 - Buat Order    | Orang 1   |
| 2    | Menu 2 - Lihat Pending | Orang 2   |
| 3    | Menu 5 - Lihat History | Orang 2   |
| 4    | Menu 4 - Lihat Driver  | Orang 3   |
| 5    | Menu 3 - Assign Order  | Orang 3   |

## Pertanyaan yang Mungkin Ditanyakan

| Pertanyaan                      | Jawaban                                       |
| ------------------------------- | --------------------------------------------- |
| Kenapa pakai Bubble Sort?       | Simple untuk data kecil, mudah diimplementasi |
| Kenapa Queue pakai Linked List? | Memory dinamis, tidak perlu tentukan ukuran   |
| Apa bedanya Queue dan Stack?    | Queue = FIFO, Stack = LIFO                    |
| Kompleksitas Bubble Sort?       | O(n²) worst case                              |
| Kenapa posisi driver berubah?   | Simulasi driver pindah ke lokasi customer     |

---

# 🏆 TIPS SUKSES PRESENTASI

1. **Jangan baca slide** - pahami konsepnya
2. **Gunakan visualisasi** - gambar linked list, stack, queue
3. **Demo yang smooth** - siapkan input sebelumnya
4. **Transisi natural** - jangan lupa kalimat penghubung
5. **Siap jawab pertanyaan** - pahami kode masing-masing

---

**Semoga sukses presentasinya! 🎉**
