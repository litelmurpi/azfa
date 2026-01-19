# 📚 PENJELASAN PROGRAM FOOD DELIVERY ROUTE OPTIMIZER

## 🎯 Deskripsi Program

**Food Delivery Route Optimizer** adalah sistem manajemen pengiriman makanan yang mensimulasikan cara kerja aplikasi ojek online seperti GoFood atau GrabFood. Program ini mengimplementasikan berbagai struktur data untuk mengelola pesanan, driver, dan riwayat pengiriman secara efisien.

---

## 📊 STRUKTUR DATA YANG DIGUNAKAN

### 1. **STRUCT** - Model Data

Struct digunakan untuk merepresentasikan objek-objek dalam dunia nyata sebagai tipe data terstruktur.

#### 1.1 Struct Location

```cpp
struct Location {
    string alamat;
    float x, y;  // koordinat
};
```

**Fungsi:**

- Menyimpan informasi lokasi dalam 2 bentuk:
  - `alamat`: Alamat dalam bentuk teks
  - `x, y`: Koordinat untuk perhitungan jarak

**Contoh Penggunaan:**

```cpp
Location restaurant = {"Restaurant", 0, 0};
Location customer = {"Jl. Sudirman No. 10", 4.5, 3.2};
```

#### 1.2 Struct MenuItem

```cpp
struct MenuItem {
    string namaItem;
    int harga;
    MenuItem* next;  // pointer ke item berikutnya
};
```

**Fungsi:**

- Merepresentasikan satu item makanan dalam pesanan
- `next`: Pointer untuk membentuk **Linked List**

**Metode Struktur Data:** **Singly Linked List**

**Operasi yang Didukung:**

- Insert at tail (tambah item di akhir)
- Traversal (tampilkan semua item)
- Aggregate (hitung total harga)

#### 1.3 Struct Order

```cpp
struct Order {
    int orderID;
    string customerName;
    Location lokasi;
    MenuItem* items;  // HEAD linked list items
    int totalHarga;
    string status;    // "pending", "on delivery", "completed"
    int timestamp;
    Order* next;      // pointer untuk Queue
};
```

**Fungsi:**

- Menyimpan informasi lengkap pesanan
- `items`: HEAD pointer ke linked list MenuItem
- `next`: Pointer untuk membentuk Queue

**Metode Struktur Data:** **Singly Linked List** (untuk Queue)

#### 1.4 Struct Driver

```cpp
struct Driver {
    int driverID;
    string nama;
    Location posisiSaatIni;
    int kapasitas;
    string status;  // "available", "busy"
    Order* currentOrders;
};
```

**Fungsi:**

- Menyimpan data driver/kurir
- `posisiSaatIni`: Lokasi driver yang berubah setelah pengantaran

**Metode Struktur Data:** **Array** (max 5 driver)

#### 1.5 Struct StackNode

```cpp
struct StackNode {
    Order orderData;
    StackNode* next;
};
```

**Fungsi:**

- Node untuk Stack yang menyimpan riwayat order selesai

**Metode Struktur Data:** **Stack (LIFO)**

---

### 2. **LINKED LIST** - Data Dinamis

Linked List digunakan untuk menyimpan data yang jumlahnya tidak bisa diprediksi.

#### 2.1 Linked List untuk MenuItem

**Implementasi:**

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

**Metode:**

- **Insert at Tail**: Menambah node di akhir list
- **Traversal**: Menelusuri semua node

**Kompleksitas:**

- Insert: O(n) - harus traverse ke akhir
- Traversal: O(n)

**Visualisasi:**

```
head → [Nasi Goreng|25000] → [Es Teh|5000] → [Kerupuk|3000] → NULL
```

#### 2.2 Fungsi Pendukung Linked List

**Tampilkan Items:**

```cpp
void tampilkanItems(MenuItem* head) {
    MenuItem* temp = head;
    while (temp != NULL) {
        cout << "   - " << temp->namaItem << " (Rp" << temp->harga << ")" << endl;
        temp = temp->next;
    }
}
```

**Hitung Total Harga:**

```cpp
int hitungTotalHarga(MenuItem* head) {
    int total = 0;
    MenuItem* temp = head;
    while (temp != NULL) {
        total += temp->harga;
        temp = temp->next;
    }
    return total;
}
```

**Metode:** **Aggregate Function** - Menghitung nilai total dari semua node

---

### 3. **QUEUE** - Antrian Order (FIFO)

Queue diimplementasikan menggunakan Linked List dengan prinsip **First In First Out**.

#### 3.1 Struktur Queue

```
                    FRONT (keluar)                    REAR (masuk)
                         ↓                                ↓
orderQueueHead → [Order #1] → [Order #2] → [Order #3] → NULL
```

**Variabel Global:**

```cpp
Order* orderQueueHead = NULL;  // Pointer ke order pertama
```

#### 3.2 Operasi Enqueue (Masuk Antrian)

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
        temp->next = newOrder;  // Tambah di BELAKANG
    }
}
```

**Metode:** **Enqueue** - Insert at rear
**Kompleksitas:** O(n) - harus traverse ke akhir

**Proses:**

1. Alokasi memory untuk node baru
2. Copy data order ke node baru
3. Jika queue kosong → head = node baru
4. Jika tidak → traverse ke akhir, sambungkan node baru

#### 3.3 Operasi Dequeue (Keluar Antrian)

```cpp
Order* dequeueOrder() {
    if (orderQueueHead == NULL) {
        return NULL;
    }
    Order* temp = orderQueueHead;
    orderQueueHead = orderQueueHead->next;  // Geser head

    // Buat copy dari order data
    Order* order = new Order;
    *order = *temp;
    order->next = NULL;  // Putus link ke queue

    // Hapus node asli untuk mencegah memory leak
    delete temp;

    return order;
}
```

**Metode:** **Dequeue** - Remove from front
**Kompleksitas:** O(1) - langsung akses head

**Proses:**

1. Simpan pointer head ke temp
2. Geser head ke node berikutnya
3. **Buat copy** dari data order
4. **Delete node asli** (memory management)
5. Return pointer ke copy

**⚠️ Penting:** Fungsi ini mengembalikan **copy** dan menghapus node asli untuk mencegah memory leak.

#### 3.4 Operasi Peek (Lihat Tanpa Hapus)

```cpp
void tampilkanPendingOrders() {
    Order* temp = orderQueueHead;
    while (temp != NULL) {
        // Tampilkan detail order
        temp = temp->next;
    }
}
```

**Metode:** **Traversal** - Melihat semua elemen tanpa menghapus
**Kompleksitas:** O(n)

---

### 4. **STACK** - Riwayat Order (LIFO)

Stack diimplementasikan menggunakan Linked List dengan prinsip **Last In First Out**.

#### 4.1 Struktur Stack

```
   TOP (masuk & keluar)
          ↓
completedOrdersStack → [Order #3] ← terakhir selesai
                           ↓
                       [Order #2]
                           ↓
                       [Order #1] ← pertama selesai
                           ↓
                         NULL
```

**Variabel Global:**

```cpp
StackNode* completedOrdersStack = NULL;  // Pointer ke top
```

#### 4.2 Operasi Push (Masuk Stack)

```cpp
void pushStack(Order order) {
    StackNode* newNode = new StackNode;
    newNode->orderData = order;
    newNode->next = completedOrdersStack;  // Tunjuk ke top lama
    completedOrdersStack = newNode;        // Top = node baru
}
```

**Metode:** **Push** - Insert at top
**Kompleksitas:** O(1) - langsung insert di head

**Proses:**

1. Alokasi memory untuk node baru
2. Copy data order ke node
3. Node baru menunjuk ke top lama
4. Update top ke node baru

**Visualisasi:**

```
SEBELUM push Order #4:
top → [Order #3] → [Order #2] → NULL

SETELAH push:
top → [Order #4] → [Order #3] → [Order #2] → NULL
      (baru)
```

#### 4.3 Operasi Pop (Keluar Stack)

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

**Metode:** **Pop** - Remove from top
**Kompleksitas:** O(1) - langsung akses top

**Proses:**

1. Simpan pointer top ke temp
2. Geser top ke node berikutnya
3. **Buat copy** dari data order
4. **Delete node asli** (memory management)
5. Return pointer ke copy

#### 4.4 Operasi Peek (Lihat Tanpa Hapus)

```cpp
void tampilkanHistory() {
    StackNode* temp = completedOrdersStack;
    while (temp != NULL) {
        // Tampilkan detail order
        temp = temp->next;
    }
}
```

**Metode:** **Traversal** - Melihat semua elemen dari top ke bottom
**Kompleksitas:** O(n)

---

### 5. **ARRAY** - Penyimpanan Driver

Array digunakan untuk menyimpan data driver dengan ukuran tetap.

```cpp
Driver drivers[5];  // Array of drivers (max 5 driver)
int driverCount = 0;
```

**Metode:** **Static Array**
**Kapasitas:** Maksimal 5 driver

#### 5.1 Operasi Insert

```cpp
void tambahDriver(string nama, float x, float y) {
    if (driverCount >= 5) {
        cout << "Driver sudah penuh (max 5)!" << endl;
        return;
    }

    drivers[driverCount].driverID = driverCount + 1;
    drivers[driverCount].nama = nama;
    drivers[driverCount].posisiSaatIni.x = x;
    drivers[driverCount].posisiSaatIni.y = y;
    drivers[driverCount].status = "available";
    driverCount++;
}
```

**Kompleksitas:** O(1) - direct access

#### 5.2 Operasi Traversal

```cpp
void tampilkanDrivers() {
    for (int i = 0; i < driverCount; i++) {
        cout << drivers[i].nama << endl;
        cout << "Posisi: (" << drivers[i].posisiSaatIni.x << ","
             << drivers[i].posisiSaatIni.y << ")" << endl;
    }
}
```

**Kompleksitas:** O(n)

---

## 🔍 ALGORITMA YANG DIGUNAKAN

### 1. **SORTING - Bubble Sort**

Digunakan untuk mengurutkan driver berdasarkan jarak ke lokasi tertentu.

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

**Metode:** **Bubble Sort**
**Kompleksitas:** O(n²)
**Pendekatan:** **Greedy Algorithm** - Pilih driver terdekat

**Cara Kerja:**

1. Bandingkan 2 elemen bersebelahan
2. Jika urutan salah (jarak1 > jarak2) → tukar posisi
3. Ulangi untuk semua pasangan
4. Elemen terbesar "menggelembung" ke akhir

**Visualisasi:**

```
SEBELUM sort (target = 0,0):
[Andi (5,2) = 5.39km] [Siti (3,5) = 5.83km] [Budi (1,0) = 1.00km]

Pass 1: Bandingkan & swap
[Andi (5,2)] [Budi (1,0)] [Siti (3,5)]

Pass 2: Bandingkan & swap
[Budi (1,0)] [Andi (5,2)] [Siti (3,5)]

SETELAH sort:
[Budi (1,0) = 1.00km] [Andi (5,2) = 5.39km] [Siti (3,5) = 5.83km]
  TERDEKAT                                      TERJAUH
```

**Kenapa Bubble Sort?**

- Jumlah driver maksimal hanya 5 (dataset kecil)
- Kompleksitas O(n²) tidak masalah untuk n kecil
- Mudah diimplementasikan dan dipahami

---

### 2. **SEARCHING - Linear Search**

Digunakan untuk mencari order berdasarkan ID.

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

**Metode:** **Linear Search (Sequential Search)**
**Kompleksitas:** O(n)

**Cara Kerja:**

1. Mulai dari head
2. Periksa setiap node satu per satu
3. Jika ID cocok → return pointer ke node
4. Jika sampai akhir tidak ketemu → return NULL

**Kenapa Linear Search?**

- Data disimpan dalam Linked List (tidak bisa random access)
- Binary Search tidak bisa digunakan karena data tidak sorted by ID
- Untuk dataset kecil, Linear Search cukup efisien

---

### 3. **DISTANCE CALCULATION - Euclidean Distance**

Digunakan untuk menghitung jarak antara dua titik koordinat.

```cpp
float hitungJarak(Location a, Location b) {
    return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));
}
```

**Metode:** **Euclidean Distance (Rumus Pythagoras)**
**Kompleksitas:** O(1)

**Rumus Matematika:**

```
Jarak = √[(x₁ - x₂)² + (y₁ - y₂)²]
```

**Contoh Perhitungan:**

```
Driver Budi: (1, 1)
Customer: (4, 5)

Jarak = √[(1-4)² + (1-5)²]
      = √[(-3)² + (-4)²]
      = √[9 + 16]
      = √25
      = 5 km
```

---

## 🔄 ALUR KERJA PROGRAM

### 1. **Inisialisasi**

```cpp
int main() {
    // Inisialisasi driver
    tambahDriver("Budi", 1.0, 0.0);
    tambahDriver("Siti", 3.0, 5.0);
    tambahDriver("Andi", 5.0, 2.0);

    // Loop menu utama
    while (true) {
        // Tampilkan menu dan proses pilihan
    }
}
```

### 2. **Buat Order Baru (Menu 1)**

**Alur:**

```
User Input → buatOrderBaru() → enqueueOrder() → Queue
```

**Proses:**

1. Input data customer (nama, alamat, koordinat)
2. Input items (linked list)
3. Hitung total harga
4. Masukkan ke queue dengan `enqueueOrder()`

**Struktur Data Terlibat:**

- Linked List (untuk items)
- Queue (untuk pending orders)

### 3. **Assign Order ke Driver (Menu 3)**

**Alur:**

```
Queue → dequeueOrder() → sortDriversByDistance() →
assignToDriver() → pushStack() → Stack
```

**Proses Detail:**

```cpp
void assignOrderToDriver() {
    // 1. Validasi
    if (orderQueueHead == NULL) return;

    // 2. Ambil order dari Queue
    Order* order = dequeueOrder();

    // 3. Sort driver berdasarkan jarak
    Location restaurant = {"Restaurant", 0, 0};
    sortDriversByDistance(restaurant);

    // 4. Cari driver available
    for (int i = 0; i < driverCount; i++) {
        if (drivers[i].status == "available") {
            // 5. Hitung jarak ke customer
            float jarak = hitungJarak(drivers[i].posisiSaatIni, order->lokasi);

            // 6. Assign order
            drivers[i].status = "busy";
            order->status = "completed";

            // 7. Push ke Stack history
            pushStack(*order);

            // 8. Update posisi driver
            drivers[i].posisiSaatIni = order->lokasi;
            drivers[i].status = "available";

            break;
        }
    }

    // 9. Hapus order untuk cegah memory leak
    delete order;
}
```

**Struktur Data Terlibat:**

- Queue (dequeue order)
- Array (driver list)
- Sorting Algorithm (bubble sort)
- Distance Calculation (euclidean)
- Stack (push completed order)

**Diagram Alur:**

```
┌─────────────────────────────────────────────┐
│         assignOrderToDriver()               │
├─────────────────────────────────────────────┤
│                                             │
│  [Queue] → dequeue() → [Order Copy]         │
│                            ↓                │
│                    sortDriversByDistance()  │
│                            ↓                │
│                    Loop Drivers             │
│                            ↓                │
│                    hitungJarak()            │
│                            ↓                │
│                    Assign to Driver         │
│                            ↓                │
│                    pushStack()              │
│                            ↓                │
│                    [Stack History]          │
│                            ↓                │
│                    delete order             │
│                                             │
└─────────────────────────────────────────────┘
```

### 4. **Lihat History (Menu 5)**

**Alur:**

```
Stack → tampilkanHistory() → Display (tanpa hapus)
```

**Metode:** Traversal Stack (LIFO order)

### 5. **Hapus Order dari History (Menu 8)**

**Alur:**

```
Stack → popStack() → Display → Delete
```

**Proses:**

1. Pop order terakhir dari stack
2. Tampilkan detail order
3. Delete order untuk free memory

---

## 💾 MEMORY MANAGEMENT

Program ini mengimplementasikan **proper memory management** untuk mencegah memory leak.

### Prinsip Dasar

```
Setiap `new` HARUS ada `delete` yang sesuai
```

### Implementasi

#### 1. **Dequeue Order**

```cpp
Order* dequeueOrder() {
    Order* temp = orderQueueHead;           // Simpan node asli
    orderQueueHead = orderQueueHead->next;  // Geser head

    Order* order = new Order;               // Alokasi untuk copy
    *order = *temp;                         // Copy data
    order->next = NULL;                     // Putus link

    delete temp;                            // Hapus node asli ✅

    return order;                           // Return copy
}
```

**Kenapa perlu copy?**

- Node asli di queue akan dihapus
- Jika return pointer ke node asli → dangling pointer
- Copy memastikan data tetap valid setelah node dihapus

#### 2. **Pop Stack**

```cpp
Order* popStack() {
    StackNode* temp = completedOrdersStack;
    completedOrdersStack = completedOrdersStack->next;

    Order* order = new Order;
    *order = temp->orderData;

    delete temp;  // Hapus node asli ✅

    return order;
}
```

#### 3. **Assign Order**

```cpp
void assignOrderToDriver() {
    Order* order = dequeueOrder();  // Dapat copy

    // ... proses assignment ...

    pushStack(*order);  // Copy data ke stack

    delete order;  // Hapus copy ✅
}
```

**Alur Memory:**

```
1. dequeueOrder() → Buat copy, delete node queue
2. assignOrderToDriver() → Proses copy
3. pushStack() → Copy data ke stack node
4. delete order → Hapus copy yang sudah tidak perlu
```

### Konsekuensi Tanpa Memory Management

**Tanpa `delete`:**

```cpp
Order* order = dequeueOrder();  // Alokasi memory
pushStack(*order);              // Copy ke stack
// Tidak ada delete order → MEMORY LEAK!
```

**Dampak:**

- Memory tidak dikembalikan ke sistem
- Setiap order yang diproses = memory leak
- Program bisa crash jika dijalankan lama
- Memory usage terus meningkat

**Dengan `delete`:**

```cpp
Order* order = dequeueOrder();
pushStack(*order);
delete order;  // ✅ Memory dikembalikan
```

---

## 📈 KOMPLEKSITAS ALGORITMA

| Operasi                  | Struktur Data | Kompleksitas Waktu | Kompleksitas Ruang |
| ------------------------ | ------------- | ------------------ | ------------------ |
| tambahItem()             | Linked List   | O(n)               | O(1)               |
| tampilkanItems()         | Linked List   | O(n)               | O(1)               |
| hitungTotalHarga()       | Linked List   | O(n)               | O(1)               |
| enqueueOrder()           | Queue         | O(n)               | O(1)               |
| dequeueOrder()           | Queue         | O(1)               | O(1)               |
| tampilkanPendingOrders() | Queue         | O(n)               | O(1)               |
| pushStack()              | Stack         | O(1)               | O(1)               |
| popStack()               | Stack         | O(1)               | O(1)               |
| tampilkanHistory()       | Stack         | O(n)               | O(1)               |
| tambahDriver()           | Array         | O(1)               | O(1)               |
| tampilkanDrivers()       | Array         | O(n)               | O(1)               |
| sortDriversByDistance()  | Array         | O(n²)              | O(1)               |
| searchOrderByID()        | Linked List   | O(n)               | O(1)               |
| hitungJarak()            | -             | O(1)               | O(1)               |
| assignOrderToDriver()    | Multiple      | O(n²)              | O(1)               |

**Keterangan:**

- n = jumlah elemen dalam struktur data
- Kompleksitas `assignOrderToDriver()` adalah O(n²) karena ada sorting di dalamnya

---

## 🎓 KONSEP PENTING YANG DIIMPLEMENTASIKAN

### 1. **Abstract Data Type (ADT)**

- Queue: FIFO operations (enqueue, dequeue)
- Stack: LIFO operations (push, pop)
- Linked List: Dynamic data structure

### 2. **Dynamic Memory Allocation**

```cpp
MenuItem* newItem = new MenuItem;  // Alokasi
delete temp;                       // Dealokasi
```

### 3. **Pointer Manipulation**

```cpp
MenuItem*& head  // Reference to pointer
temp->next       // Pointer dereferencing
```

### 4. **Greedy Algorithm**

- Selalu pilih driver terdekat untuk efisiensi

### 5. **Data Encapsulation**

- Struct menggabungkan data terkait dalam satu unit

### 6. **Traversal Techniques**

- Iterative traversal untuk linked list
- Loop-based traversal untuk array

---

## 🔧 FITUR PROGRAM

### Menu Utama

```
1. Buat Order Baru           → Input + Enqueue
2. Lihat Pending Orders      → Queue Traversal
3. Assign Order ke Driver    → Dequeue + Sort + Push
4. Lihat Daftar Driver       → Array Traversal
5. Lihat History             → Stack Traversal
6. Cari Order by ID          → Linear Search
7. Tambah Driver Baru        → Array Insert
8. Hapus Order dari History  → Pop Stack
0. Keluar                    → Exit
```

### Fitur Unggulan

✅ **Dynamic Order Items** - Linked List memungkinkan jumlah item tidak terbatas
✅ **FIFO Queue** - Order diproses sesuai urutan kedatangan
✅ **LIFO History** - Order terakhir selesai muncul paling atas
✅ **Smart Driver Selection** - Sorting untuk pilih driver terdekat
✅ **Distance Calculation** - Euclidean distance untuk akurasi
✅ **Memory Safe** - Proper allocation dan deallocation
✅ **Search Functionality** - Cari order berdasarkan ID

---

## 📝 KESIMPULAN

Program **Food Delivery Route Optimizer** adalah implementasi komprehensif dari berbagai struktur data dan algoritma:

### Struktur Data:

1. **Struct** - Model data terstruktur
2. **Linked List** - Data dinamis (items, queue, stack)
3. **Queue** - Antrian order (FIFO)
4. **Stack** - Riwayat order (LIFO)
5. **Array** - Penyimpanan driver (static)

### Algoritma:

1. **Bubble Sort** - Urutkan driver by jarak
2. **Linear Search** - Cari order by ID
3. **Euclidean Distance** - Hitung jarak koordinat
4. **Greedy Approach** - Pilih driver terdekat

### Konsep Lanjutan:

1. **Memory Management** - Proper new/delete
2. **Pointer Manipulation** - Reference & dereferencing
3. **Dynamic Allocation** - Runtime memory allocation
4. **Data Flow** - Queue → Process → Stack

Program ini mendemonstrasikan bagaimana berbagai struktur data bekerja bersama untuk menyelesaikan masalah nyata dalam sistem pengiriman makanan.

---

**Dibuat untuk:** Final Project Struktur Data
**Bahasa:** C++
**Compiler:** g++ (C++11 atau lebih baru)
