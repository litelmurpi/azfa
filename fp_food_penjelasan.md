# 📚 PENJELASAN DETAIL KODE PROGRAM

## Food Delivery Route Optimizer

---

# BAGIAN 1: HEADER DAN NAMESPACE

```cpp
#include <iostream>
#include <string>
#include <cmath>
#include <iomanip>
using namespace std;
```

| Baris | Kode                   | Penjelasan                                                                                |
| ----- | ---------------------- | ----------------------------------------------------------------------------------------- |
| 1     | `#include <iostream>`  | Mengimpor library untuk input/output standar (`cin`, `cout`)                              |
| 2     | `#include <string>`    | Mengimpor library untuk tipe data `string`                                                |
| 3     | `#include <cmath>`     | Mengimpor library matematika untuk fungsi `sqrt()` dan `pow()`                            |
| 4     | `#include <iomanip>`   | Mengimpor library untuk formatting output (`setprecision`, `fixed`)                       |
| 5     | `using namespace std;` | Menggunakan namespace standar agar tidak perlu menulis `std::` sebelum `cout`, `cin`, dll |

---

# BAGIAN 2: DEFINISI STRUCT

## 2.1 Struct MenuItem

```cpp
struct MenuItem {
    string namaItem;
    int harga;
    MenuItem* next;
};
```

| Member     | Tipe        | Penjelasan                                             |
| ---------- | ----------- | ------------------------------------------------------ |
| `namaItem` | `string`    | Menyimpan nama item makanan (contoh: "Nasi Goreng")    |
| `harga`    | `int`       | Menyimpan harga item dalam Rupiah                      |
| `next`     | `MenuItem*` | Pointer ke item berikutnya → membentuk **Linked List** |

**Fungsi:** Struct ini merepresentasikan satu item dalam pesanan. Menggunakan pointer `next` untuk membuat linked list item-item dalam satu order.

---

## 2.2 Struct Location

```cpp
struct Location {
    string alamat;
    float x, y;  // koordinat
};
```

| Member   | Tipe     | Penjelasan                                                         |
| -------- | -------- | ------------------------------------------------------------------ |
| `alamat` | `string` | Menyimpan alamat dalam bentuk teks (contoh: "Jl. Sudirman No. 10") |
| `x`      | `float`  | Koordinat X (posisi horizontal)                                    |
| `y`      | `float`  | Koordinat Y (posisi vertikal)                                      |

**Fungsi:** Menyimpan informasi lokasi untuk menghitung jarak menggunakan koordinat kartesian.

---

## 2.3 Struct Order

```cpp
struct Order {
    int orderID;
    string customerName;
    Location lokasi;
    MenuItem* items;  // LinkedList items
    int totalHarga;
    string status;  // "pending", "on delivery", "completed"
    int timestamp;  // dalam menit sejak buka
    Order* next;
};
```

| Member         | Tipe        | Penjelasan                                                     |
| -------------- | ----------- | -------------------------------------------------------------- |
| `orderID`      | `int`       | ID unik untuk setiap order (auto-increment)                    |
| `customerName` | `string`    | Nama pelanggan yang memesan                                    |
| `lokasi`       | `Location`  | Lokasi pengiriman (alamat + koordinat)                         |
| `items`        | `MenuItem*` | **Head pointer** ke linked list item makanan                   |
| `totalHarga`   | `int`       | Total harga semua item                                         |
| `status`       | `string`    | Status order: `"pending"`, `"on delivery"`, atau `"completed"` |
| `timestamp`    | `int`       | Waktu pemesanan dalam menit                                    |
| `next`         | `Order*`    | Pointer ke order berikutnya → untuk **Queue** linked list      |

**Fungsi:** Merepresentasikan satu pesanan lengkap dengan semua informasinya.

---

## 2.4 Struct Driver

```cpp
struct Driver {
    int driverID;
    string nama;
    Location posisiSaatIni;
    int kapasitas;  // max order yg bisa dibawa
    string status;  // "available", "busy"
    Order* currentOrders;  // LinkedList order yang sedang dibawa
};
```

| Member          | Tipe       | Penjelasan                                                |
| --------------- | ---------- | --------------------------------------------------------- |
| `driverID`      | `int`      | ID unik driver                                            |
| `nama`          | `string`   | Nama driver                                               |
| `posisiSaatIni` | `Location` | Posisi driver saat ini (berubah setelah delivery)         |
| `kapasitas`     | `int`      | Maksimal order yang bisa dibawa (default: 3)              |
| `status`        | `string`   | Status: `"available"` atau `"busy"`                       |
| `currentOrders` | `Order*`   | Linked list order yang sedang dibawa (untuk pengembangan) |

**Fungsi:** Menyimpan data driver termasuk posisi dan status ketersediaan.

---

## 2.5 Struct StackNode

```cpp
struct StackNode {
    Order orderData;
    StackNode* next;
};
```

| Member      | Tipe         | Penjelasan                              |
| ----------- | ------------ | --------------------------------------- |
| `orderData` | `Order`      | Salinan data order yang sudah selesai   |
| `next`      | `StackNode*` | Pointer ke node di bawahnya dalam stack |

**Fungsi:** Node untuk implementasi **Stack** riwayat order (LIFO - Last In First Out).

---

# BAGIAN 3: VARIABEL GLOBAL

```cpp
Order* orderQueueHead = NULL;  // LinkedList Queue untuk pending orders
Driver drivers[5];  // Array of drivers (max 5 driver)
int driverCount = 0;
StackNode* completedOrdersStack = NULL;  // Stack untuk history
Location popularLocations[10];  // Array lokasi populer
int locationCount = 0;
int nextOrderID = 1;
```

| Variabel               | Tipe           | Nilai Awal | Penjelasan                                     |
| ---------------------- | -------------- | ---------- | ---------------------------------------------- |
| `orderQueueHead`       | `Order*`       | `NULL`     | Head pointer untuk queue order pending         |
| `drivers`              | `Driver[5]`    | -          | Array statis untuk menyimpan maksimal 5 driver |
| `driverCount`          | `int`          | `0`        | Jumlah driver yang terdaftar saat ini          |
| `completedOrdersStack` | `StackNode*`   | `NULL`     | Top pointer untuk stack riwayat                |
| `popularLocations`     | `Location[10]` | -          | Array lokasi populer (belum digunakan penuh)   |
| `locationCount`        | `int`          | `0`        | Jumlah lokasi populer                          |
| `nextOrderID`          | `int`          | `1`        | ID untuk order berikutnya (auto-increment)     |

---

# BAGIAN 4: FUNGSI UTILITY

## 4.1 hitungJarak()

```cpp
float hitungJarak(Location a, Location b) {
    return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));
}
```

**Penjelasan baris per baris:**

| Baris | Kode                                                  | Penjelasan                                                 |
| ----- | ----------------------------------------------------- | ---------------------------------------------------------- |
| 1     | `float hitungJarak(Location a, Location b)`           | Deklarasi fungsi dengan 2 parameter Location, return float |
| 2     | `return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));` | Menghitung jarak Euclidean: √((x₁-x₂)² + (y₁-y₂)²)         |

**Rumus Matematika:**

```
Jarak = √[(x₁ - x₂)² + (y₁ - y₂)²]
```

**Contoh:**

- Lokasi A: (1, 1)
- Lokasi B: (4, 5)
- Jarak = √[(1-4)² + (1-5)²] = √[9 + 16] = √25 = **5 km**

---

# BAGIAN 5: OPERASI MENU ITEM (LINKED LIST)

## 5.1 tambahItem()

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

**Penjelasan baris per baris:**

| Baris | Kode                                                       | Penjelasan                                                                                                 |
| ----- | ---------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| 1     | `void tambahItem(MenuItem*& head, string nama, int harga)` | Parameter `head` menggunakan **reference pointer** (`*&`) agar perubahan head berpengaruh ke variabel asli |
| 2     | `MenuItem* newItem = new MenuItem;`                        | Alokasi memori dinamis untuk node baru                                                                     |
| 3     | `newItem->namaItem = nama;`                                | Mengisi nama item                                                                                          |
| 4     | `newItem->harga = harga;`                                  | Mengisi harga item                                                                                         |
| 5     | `newItem->next = NULL;`                                    | Set next ke NULL (node terakhir)                                                                           |
| 7-8   | `if (head == NULL) { head = newItem; }`                    | Jika list kosong, head langsung menunjuk ke node baru                                                      |
| 9-13  | `else { ... temp->next = newItem; }`                       | Jika tidak kosong, traverse ke akhir list lalu sambungkan                                                  |

**Visualisasi:**

```
Sebelum: head → [Item1] → [Item2] → NULL
Setelah: head → [Item1] → [Item2] → [NewItem] → NULL
```

---

## 5.2 tampilkanItems()

```cpp
void tampilkanItems(MenuItem* head) {
    MenuItem* temp = head;
    while (temp != NULL) {
        cout << "   - " << temp->namaItem << " (Rp" << temp->harga << ")" << endl;
        temp = temp->next;
    }
}
```

| Baris | Kode                     | Penjelasan                                        |
| ----- | ------------------------ | ------------------------------------------------- |
| 2     | `MenuItem* temp = head;` | Gunakan pointer sementara agar head tidak berubah |
| 3     | `while (temp != NULL)`   | Loop selama belum mencapai akhir list             |
| 4     | `cout << ...`            | Print nama dan harga item                         |
| 5     | `temp = temp->next;`     | Pindah ke node berikutnya                         |

**Kompleksitas:** O(n) - harus traverse semua node

---

## 5.3 hitungTotalHarga()

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

| Baris | Kode                              | Penjelasan                             |
| ----- | --------------------------------- | -------------------------------------- |
| 2     | `int total = 0;`                  | Inisialisasi akumulator                |
| 4-6   | `while ... total += temp->harga;` | Traverse dan jumlahkan harga tiap item |
| 7     | `return total;`                   | Kembalikan total harga                 |

---

# BAGIAN 6: OPERASI QUEUE (LINKED LIST)

## 6.1 enqueueOrder()

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
        temp->next = newOrder;
    }
    cout << "✓ Order #" << orderBaru.orderID << " ditambahkan ke queue!" << endl;
}
```

| Baris | Kode                                  | Penjelasan                                  |
| ----- | ------------------------------------- | ------------------------------------------- |
| 1     | `void enqueueOrder(Order orderBaru)`  | Menerima order by value (copy)              |
| 2     | `Order* newOrder = new Order;`        | Alokasi memori untuk node baru              |
| 3     | `*newOrder = orderBaru;`              | Copy semua data dari parameter ke node baru |
| 4     | `newOrder->next = NULL;`              | Node baru akan jadi yang terakhir           |
| 6-7   | `if (orderQueueHead == NULL)`         | Jika queue kosong, head = node baru         |
| 8-13  | `else { ... temp->next = newOrder; }` | Jika tidak, tambahkan di akhir (FIFO)       |

**Prinsip Queue (FIFO):** Order baru masuk dari belakang.

---

## 6.2 dequeueOrder()

```cpp
Order* dequeueOrder() {
    if (orderQueueHead == NULL) {
        return NULL;
    }
    Order* temp = orderQueueHead;
    orderQueueHead = orderQueueHead->next;
    return temp;
}
```

| Baris | Kode                                       | Penjelasan                     |
| ----- | ------------------------------------------ | ------------------------------ |
| 2-4   | `if (orderQueueHead == NULL) return NULL;` | Jika queue kosong, return NULL |
| 5     | `Order* temp = orderQueueHead;`            | Simpan pointer ke node pertama |
| 6     | `orderQueueHead = orderQueueHead->next;`   | Geser head ke node kedua       |
| 7     | `return temp;`                             | Kembalikan node yang diambil   |

**Prinsip Queue (FIFO):** Order diambil dari depan.

**Visualisasi:**

```
Sebelum: head → [Order1] → [Order2] → NULL
                   ↑
               (diambil)
Setelah: head → [Order2] → NULL
```

---

## 6.3 tampilkanPendingOrders()

```cpp
void tampilkanPendingOrders() {
    if (orderQueueHead == NULL) {
        cout << "Tidak ada order pending." << endl;
        return;
    }

    cout << "\n===== PENDING ORDERS =====" << endl;
    Order* temp = orderQueueHead;
    int count = 1;
    while (temp != NULL) {
        cout << count++ << ". Order #" << temp->orderID << " - " << temp->customerName << endl;
        cout << "   Alamat: " << temp->lokasi.alamat << " (" << temp->lokasi.x << "," << temp->lokasi.y << ")" << endl;
        cout << "   Items:" << endl;
        tampilkanItems(temp->items);
        cout << "   Total: Rp" << temp->totalHarga << endl;
        cout << "   Waktu: " << temp->timestamp << " menit" << endl << endl;
        temp = temp->next;
    }
}
```

| Baris | Kode                                           | Penjelasan                                            |
| ----- | ---------------------------------------------- | ----------------------------------------------------- |
| 2-5   | `if (orderQueueHead == NULL)`                  | Guard clause jika queue kosong                        |
| 8-9   | `Order* temp = orderQueueHead; int count = 1;` | Inisialisasi traversal dan counter                    |
| 10-17 | `while (temp != NULL) { ... }`                 | Loop semua order dan print detailnya                  |
| 13    | `tampilkanItems(temp->items);`                 | Panggil fungsi untuk print items (nested linked list) |

---

# BAGIAN 7: OPERASI STACK (HISTORY)

## 7.1 pushStack()

```cpp
void pushStack(Order order) {
    StackNode* newNode = new StackNode;
    newNode->orderData = order;
    newNode->next = completedOrdersStack;
    completedOrdersStack = newNode;
}
```

| Baris | Kode                                    | Penjelasan                     |
| ----- | --------------------------------------- | ------------------------------ |
| 2     | `StackNode* newNode = new StackNode;`   | Alokasi node baru              |
| 3     | `newNode->orderData = order;`           | Copy data order ke node        |
| 4     | `newNode->next = completedOrdersStack;` | Node baru menunjuk ke top lama |
| 5     | `completedOrdersStack = newNode;`       | Top stack digeser ke node baru |

**Prinsip Stack (LIFO):** Node baru selalu di atas (top).

**Visualisasi:**

```
Sebelum:     top → [Order2] → [Order1] → NULL
Setelah: newTop → [Order3] → [Order2] → [Order1] → NULL
```

---

## 7.2 popStack()

```cpp
Order* popStack() {
    if (completedOrdersStack == NULL) {
        return NULL;
    }
    StackNode* temp = completedOrdersStack;
    completedOrdersStack = completedOrdersStack->next;
    Order* order = &(temp->orderData);
    return order;
}
```

| Baris | Kode                                                 | Penjelasan                     |
| ----- | ---------------------------------------------------- | ------------------------------ |
| 2-4   | `if (completedOrdersStack == NULL)`                  | Jika stack kosong, return NULL |
| 5     | `StackNode* temp = completedOrdersStack;`            | Simpan pointer ke top          |
| 6     | `completedOrdersStack = completedOrdersStack->next;` | Geser top ke bawah             |
| 7     | `Order* order = &(temp->orderData);`                 | Ambil alamat data order        |
| 8     | `return order;`                                      | Kembalikan pointer ke order    |

---

## 7.3 tampilkanHistory()

```cpp
void tampilkanHistory() {
    if (completedOrdersStack == NULL) {
        cout << "Belum ada order yang selesai." << endl;
        return;
    }

    cout << "\n===== HISTORY COMPLETED ORDERS =====" << endl;
    StackNode* temp = completedOrdersStack;
    int count = 1;
    while (temp != NULL) {
        cout << count++ << ". Order #" << temp->orderData.orderID << " - " << temp->orderData.customerName << endl;
        cout << "   Total: Rp" << temp->orderData.totalHarga << endl;
        temp = temp->next;
    }
}
```

**Catatan:** Order terbaru muncul di atas karena sifat LIFO stack.

---

# BAGIAN 8: MANAJEMEN DRIVER (ARRAY)

## 8.1 tambahDriver()

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
    drivers[driverCount].posisiSaatIni.alamat = "Starting Point";
    drivers[driverCount].kapasitas = 3;
    drivers[driverCount].status = "available";
    drivers[driverCount].currentOrders = NULL;
    driverCount++;

    cout << "✓ Driver " << nama << " ditambahkan!" << endl;
}
```

| Baris | Kode                                               | Penjelasan                       |
| ----- | -------------------------------------------------- | -------------------------------- |
| 2-5   | `if (driverCount >= 5)`                            | Cek batas maksimal array         |
| 7     | `drivers[driverCount].driverID = driverCount + 1;` | ID mulai dari 1                  |
| 8-14  | `drivers[driverCount]...`                          | Inisialisasi semua member struct |
| 15    | `driverCount++;`                                   | Increment counter driver         |

---

## 8.2 tampilkanDrivers()

```cpp
void tampilkanDrivers() {
    cout << "\n===== DAFTAR DRIVER =====" << endl;
    for (int i = 0; i < driverCount; i++) {
        cout << i+1 << ". " << drivers[i].nama << " (ID: " << drivers[i].driverID << ")" << endl;
        cout << "   Posisi: (" << drivers[i].posisiSaatIni.x << "," << drivers[i].posisiSaatIni.y << ")" << endl;
        cout << "   Status: " << drivers[i].status << endl << endl;
    }
}
```

**Traversal Array:** Menggunakan loop `for` dengan index.

---

# BAGIAN 9: SORTING (BUBBLE SORT)

## 9.1 sortDriversByDistance()

```cpp
void sortDriversByDistance(Location target) {
    for (int i = 0; i < driverCount - 1; i++) {
        for (int j = 0; j < driverCount - i - 1; j++) {
            float jarak1 = hitungJarak(drivers[j].posisiSaatIni, target);
            float jarak2 = hitungJarak(drivers[j+1].posisiSaatIni, target);

            if (jarak1 > jarak2) {
                Driver temp = drivers[j];
                drivers[j] = drivers[j+1];
                drivers[j+1] = temp;
            }
        }
    }
}
```

| Baris | Kode                                            | Penjelasan                          |
| ----- | ----------------------------------------------- | ----------------------------------- |
| 2     | `for (int i = 0; i < driverCount - 1; i++)`     | Outer loop: jumlah pass             |
| 3     | `for (int j = 0; j < driverCount - i - 1; j++)` | Inner loop: compare adjacent pairs  |
| 4-5   | `float jarak1 = ...; float jarak2 = ...;`       | Hitung jarak kedua driver ke target |
| 7-11  | `if (jarak1 > jarak2) { swap }`                 | Jika urutan salah, tukar posisi     |

**Algoritma Bubble Sort:**

1. Bandingkan elemen bersebelahan
2. Tukar jika urutan salah
3. Ulangi sampai tidak ada pertukaran

**Kompleksitas:** O(n²)

**Hasil:** Driver diurutkan dari yang **terdekat** ke target.

---

# BAGIAN 10: SEARCHING (LINEAR SEARCH)

## 10.1 searchOrderByID()

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

| Baris | Kode                                    | Penjelasan                    |
| ----- | --------------------------------------- | ----------------------------- |
| 2     | `Order* temp = orderQueueHead;`         | Mulai dari head queue         |
| 3     | `while (temp != NULL)`                  | Traverse semua node           |
| 4-6   | `if (temp->orderID == id) return temp;` | Jika ID cocok, return pointer |
| 7     | `temp = temp->next;`                    | Pindah ke node berikutnya     |
| 9     | `return NULL;`                          | Tidak ditemukan               |

**Kompleksitas:** O(n) - worst case harus cek semua node

---

## 10.2 binarySearchLocation()

```cpp
int binarySearchLocation(string namaLokasi) {
    // Simple linear search karena array kecil
    for (int i = 0; i < locationCount; i++) {
        if (popularLocations[i].alamat == namaLokasi) {
            return i;
        }
    }
    return -1;
}
```

**Catatan:** Meskipun namanya binary search, implementasinya adalah **linear search** karena data kecil.

---

# BAGIAN 11: ASSIGN ORDER KE DRIVER (CORE LOGIC)

## 11.1 assignOrderToDriver()

```cpp
void assignOrderToDriver() {
    if (orderQueueHead == NULL) {
        cout << "Tidak ada order untuk di-assign!" << endl;
        return;
    }

    if (driverCount == 0) {
        cout << "Tidak ada driver tersedia!" << endl;
        return;
    }

    Order* order = dequeueOrder();

    // Sort drivers berdasarkan jarak ke lokasi restaurant (asumsi 0,0)
    Location restaurant = {"Restaurant", 0, 0};
    sortDriversByDistance(restaurant);

    // Cari driver available
    bool assigned = false;
    for (int i = 0; i < driverCount; i++) {
        if (drivers[i].status == "available") {
            cout << "\n✓ Order #" << order->orderID << " di-assign ke " << drivers[i].nama << endl;
            float jarak = hitungJarak(drivers[i].posisiSaatIni, order->lokasi);
            cout << "  Jarak: " << fixed << setprecision(2) << jarak << " km" << endl;
            cout << "  Estimasi: " << (int)(jarak * 5) << " menit" << endl;

            drivers[i].status = "busy";
            order->status = "on delivery";

            // Simulasi: setelah delivery, pindahkan ke completed stack
            order->status = "completed";
            pushStack(*order);
            drivers[i].status = "available";
            drivers[i].posisiSaatIni = order->lokasi;

            assigned = true;
            break;
        }
    }

    if (!assigned) {
        cout << "Semua driver sedang busy! Order dikembalikan ke queue." << endl;
        enqueueOrder(*order);
    }
}
```

**Alur Logika:**

```
┌─────────────────────────────────────┐
│ 1. Cek ada order di queue?          │
│    ├─ Tidak → "Tidak ada order"     │
│    └─ Ya → Lanjut                   │
├─────────────────────────────────────┤
│ 2. Cek ada driver?                  │
│    ├─ Tidak → "Tidak ada driver"    │
│    └─ Ya → Lanjut                   │
├─────────────────────────────────────┤
│ 3. Dequeue order dari queue         │
├─────────────────────────────────────┤
│ 4. Sort driver by distance          │
│    (Bubble Sort)                    │
├─────────────────────────────────────┤
│ 5. Loop cari driver available       │
│    ├─ Ditemukan:                    │
│    │   ├─ Hitung jarak              │
│    │   ├─ Tampilkan info            │
│    │   ├─ Simulasi delivery         │
│    │   ├─ Push ke stack history     │
│    │   └─ Update posisi driver      │
│    └─ Tidak ditemukan:              │
│        └─ Kembalikan order ke queue │
└─────────────────────────────────────┘
```

| Baris | Kode                                       | Penjelasan                                        |
| ----- | ------------------------------------------ | ------------------------------------------------- |
| 2-5   | `if (orderQueueHead == NULL)`              | Validasi: ada order?                              |
| 7-10  | `if (driverCount == 0)`                    | Validasi: ada driver?                             |
| 12    | `Order* order = dequeueOrder();`           | Ambil order pertama dari queue                    |
| 15-16 | `Location restaurant... sortDrivers...`    | Sort driver berdasarkan jarak ke restaurant       |
| 20    | `for (int i = 0; i < driverCount; i++)`    | Loop semua driver                                 |
| 21    | `if (drivers[i].status == "available")`    | Cari yang available                               |
| 23-25 | `hitungJarak... cout...`                   | Hitung dan tampilkan jarak + estimasi             |
| 27-28 | `drivers[i].status = "busy"`               | Update status                                     |
| 31-34 | `pushStack... drivers[i].posisiSaatIni...` | Simulasi selesai: push ke history, update posisi  |
| 41-43 | `if (!assigned)... enqueueOrder...`        | Jika tidak ada driver available, kembalikan order |

---

# BAGIAN 12: BUAT ORDER BARU

## 12.1 buatOrderBaru()

```cpp
void buatOrderBaru() {
    Order newOrder;
    newOrder.orderID = nextOrderID++;

    cout << "\n===== BUAT ORDER BARU =====" << endl;
    cout << "Nama Customer: ";
    cin.ignore();
    getline(cin, newOrder.customerName);

    cout << "Alamat: ";
    getline(cin, newOrder.lokasi.alamat);

    cout << "Koordinat X: ";
    cin >> newOrder.lokasi.x;
    cout << "Koordinat Y: ";
    cin >> newOrder.lokasi.y;

    newOrder.items = NULL;
    newOrder.status = "pending";
    newOrder.timestamp = nextOrderID * 5;  // simulasi waktu

    cout << "\nTambah Items (ketik 'selesai' untuk berhenti):" << endl;
    while (true) {
        string namaItem;
        cout << "Nama item: ";
        cin.ignore();
        getline(cin, namaItem);

        if (namaItem == "selesai") break;

        int harga;
        cout << "Harga: Rp";
        cin >> harga;

        tambahItem(newOrder.items, namaItem, harga);
    }

    newOrder.totalHarga = hitungTotalHarga(newOrder.items);
    newOrder.next = NULL;

    enqueueOrder(newOrder);
}
```

| Baris | Kode                                                         | Penjelasan                                   |
| ----- | ------------------------------------------------------------ | -------------------------------------------- |
| 2     | `Order newOrder;`                                            | Buat struct Order di stack (local variable)  |
| 3     | `newOrder.orderID = nextOrderID++;`                          | Assign ID lalu increment (post-increment)    |
| 7     | `cin.ignore();`                                              | Hapus newline dari buffer sebelum `getline`  |
| 8     | `getline(cin, newOrder.customerName);`                       | Baca string dengan spasi                     |
| 18-20 | `newOrder.items = NULL;... status = "pending";`              | Inisialisasi default                         |
| 23-35 | `while (true) { ... if (namaItem == "selesai") break; ... }` | Loop input items sampai user ketik "selesai" |
| 37    | `newOrder.totalHarga = hitungTotalHarga(newOrder.items);`    | Hitung total dari linked list items          |
| 40    | `enqueueOrder(newOrder);`                                    | Masukkan ke queue                            |

---

# BAGIAN 13: FUNGSI MAIN

## 13.1 main()

```cpp
int main() {
    int pilihan;

    // Inisialisasi beberapa driver
    tambahDriver("Budi", 1.0, 1.0);
    tambahDriver("Siti", 2.5, 3.0);
    tambahDriver("Andi", 4.0, 2.0);

    cout << "========================================" << endl;
    cout << "  FOOD DELIVERY ROUTE OPTIMIZER" << endl;
    cout << "  Sistem Manajemen Delivery Makanan" << endl;
    cout << "========================================" << endl;

    while (true) {
        cout << "\n===== MENU UTAMA =====" << endl;
        cout << "1. Buat Order Baru" << endl;
        cout << "2. Lihat Pending Orders" << endl;
        cout << "3. Assign Order ke Driver" << endl;
        cout << "4. Lihat Daftar Driver" << endl;
        cout << "5. Lihat History Completed Orders" << endl;
        cout << "6. Cari Order by ID" << endl;
        cout << "7. Tambah Driver Baru" << endl;
        cout << "0. Keluar" << endl;
        cout << "\nPilihan: ";
        cin >> pilihan;

        switch (pilihan) {
            case 1:
                buatOrderBaru();
                break;
            case 2:
                tampilkanPendingOrders();
                break;
            case 3:
                assignOrderToDriver();
                break;
            case 4:
                tampilkanDrivers();
                break;
            case 5:
                tampilkanHistory();
                break;
            case 6: {
                int id;
                cout << "Masukkan Order ID: ";
                cin >> id;
                Order* found = searchOrderByID(id);
                if (found) {
                    cout << "\n✓ Order ditemukan!" << endl;
                    cout << "Order #" << found->orderID << " - " << found->customerName << endl;
                    cout << "Status: " << found->status << endl;
                } else {
                    cout << "✗ Order tidak ditemukan!" << endl;
                }
                break;
            }
            case 7: {
                string nama;
                float x, y;
                cout << "Nama driver: ";
                cin.ignore();
                getline(cin, nama);
                cout << "Posisi X: ";
                cin >> x;
                cout << "Posisi Y: ";
                cin >> y;
                tambahDriver(nama, x, y);
                break;
            }
            case 0:
                cout << "\nTerima kasih telah menggunakan sistem!" << endl;
                return 0;
            default:
                cout << "Pilihan tidak valid!" << endl;
        }
    }

    return 0;
}
```

**Struktur Switch-Case:**

| Case    | Fungsi yang Dipanggil      | Deskripsi                   |
| ------- | -------------------------- | --------------------------- |
| 1       | `buatOrderBaru()`          | Input order baru ke queue   |
| 2       | `tampilkanPendingOrders()` | Tampilkan isi queue         |
| 3       | `assignOrderToDriver()`    | Proses order ke driver      |
| 4       | `tampilkanDrivers()`       | Tampilkan array driver      |
| 5       | `tampilkanHistory()`       | Tampilkan stack history     |
| 6       | `searchOrderByID()`        | Linear search order         |
| 7       | `tambahDriver()`           | Tambah driver baru ke array |
| 0       | `return 0`                 | Keluar program              |
| default | -                          | Pesan error                 |

---

# BAGIAN 14: RINGKASAN STRUKTUR DATA

## 14.1 Tabel Penggunaan Struktur Data

| Struktur Data   | Digunakan Untuk                                             | Operasi Utama              |
| --------------- | ----------------------------------------------------------- | -------------------------- |
| **Array**       | Menyimpan driver (`drivers[5]`)                             | Insert, Traverse, Sort     |
| **Struct**      | Mendefinisikan Order, Driver, MenuItem, Location, StackNode | Data encapsulation         |
| **Pointer**     | Menghubungkan node dalam linked list dan stack              | Reference, dereference     |
| **Linked List** | Queue order pending, Daftar item per order                  | Enqueue, Dequeue, Traverse |
| **Stack**       | Riwayat order selesai                                       | Push, Pop, Traverse        |
| **Queue**       | Antrian order (FIFO)                                        | Enqueue, Dequeue           |

## 14.2 Tabel Algoritma

| Algoritma              | Fungsi                    | Kompleksitas |
| ---------------------- | ------------------------- | ------------ |
| **Bubble Sort**        | `sortDriversByDistance()` | O(n²)        |
| **Linear Search**      | `searchOrderByID()`       | O(n)         |
| **Euclidean Distance** | `hitungJarak()`           | O(1)         |

---

# BAGIAN 15: DIAGRAM ALUR PROGRAM

```
┌──────────────────────────────────────────────────────────┐
│                      PROGRAM START                        │
└──────────────────────────────────────────────────────────┘
                              │
                              ▼
               ┌──────────────────────────┐
               │ Inisialisasi 3 Driver    │
               │ (Budi, Siti, Andi)       │
               └──────────────────────────┘
                              │
                              ▼
               ┌──────────────────────────┐
               │    TAMPILKAN MENU        │◄────────────────┐
               └──────────────────────────┘                 │
                              │                             │
                              ▼                             │
                    ┌─────────────┐                         │
                    │ Input Menu  │                         │
                    └─────────────┘                         │
                              │                             │
         ┌────────────────────┼────────────────────┐        │
         ▼                    ▼                    ▼        │
    ┌─────────┐          ┌─────────┐          ┌─────────┐   │
    │ Menu 1  │          │ Menu 3  │          │ Menu 0  │   │
    │  Order  │          │ Assign  │          │  Exit   │   │
    └─────────┘          └─────────┘          └─────────┘   │
         │                    │                    │        │
         ▼                    ▼                    ▼        │
    ┌─────────┐          ┌─────────┐          ┌─────────┐   │
    │Enqueue  │          │Dequeue  │          │ END     │   │
    │to Queue │          │+ Sort   │          │PROGRAM  │   │
    └─────────┘          │+ Push   │          └─────────┘   │
         │               │to Stack │                        │
         │               └─────────┘                        │
         │                    │                             │
         └────────────────────┴─────────────────────────────┘
```

---

**© 2026 - Dokumentasi Program Food Delivery Route Optimizer**
