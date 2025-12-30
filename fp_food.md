<img src="https://r2cdn.perplexity.ai/pplx-full-logo-primary-dark%402x.png" style="height:64px;margin-right:32px"/>

# sebelum ada improvement, aku ingin kamu jelaskan programnya dengan detail dari alur sampai logika per code nya di markdown file

Berikut penjelasan program **Food Delivery Route Optimizer** dalam bentuk markdown yang bisa langsung kamu jadikan `.md` file. Penjelasan ini berdasarkan struktur program C++ yang sudah dibuat sebelumnya.

***

# Penjelasan Program Food Delivery Route Optimizer

## 1. Gambaran Umum Program

Program ini mensimulasikan sistem manajemen delivery makanan sederhana dengan fokus pada penerapan struktur data di C++:

- Array: menyimpan data driver.
- Struct: mendeskripsikan `Order`, `Driver`, `MenuItem`, `Location`, `StackNode`.
- Pointer: dipakai di semua node linked list dan akses dinamis.
- Linked List:
    - Antrian pending order (queue).
    - Daftar item dalam setiap order.
- Stack: riwayat order yang sudah selesai (completed orders).
- Queue: implementasi antrian order (FIFO) menggunakan linked list.
- Sorting: Bubble sort untuk mengurutkan driver berdasarkan jarak.
- Searching: Linear search untuk cari order berdasarkan ID.

Flow besarnya:

1. Program inisialisasi beberapa driver.
2. User bisa membuat order baru, melihat antrian, assign order ke driver, melihat driver, melihat history, mencari order, dan menambah driver.
3. Saat order di-assign, sistem memilih driver terdekat, mensimulasikan delivery, dan memindahkan order ke history.

***

## 2. Definisi Struct dan Global Variable

### 2.1. Struct Data Utama

```cpp
struct MenuItem {
    string namaItem;
    int harga;
    MenuItem* next;
};
```

- Mewakili satu item makanan.
- `next` menunjuk ke item berikutnya → membentuk **linked list** item per order.

```cpp
struct Location {
    string alamat;
    float x, y;  // koordinat
};
```

- Menyimpan alamat teks dan koordinat (X, Y) untuk perhitungan jarak.

```cpp
struct Order {
    int orderID;
    string customerName;
    Location lokasi;
    MenuItem* items;  // LinkedList items
    int totalHarga;
    string status;    // "pending", "on delivery", "completed"
    int timestamp;
    Order* next;
};
```

- Representasi satu pesanan.
- `items` adalah head dari linked list `MenuItem`.
- `next` digunakan untuk:
    - Node dalam **queue** pending orders (linked list).
- `status` menunjukkan state order.

```cpp
struct Driver {
    int driverID;
    string nama;
    Location posisiSaatIni;
    int kapasitas;
    string status;      // "available", "busy"
    Order* currentOrders;
};
```

- Menyimpan data driver.
- `currentOrders` disiapkan sebagai linked list order yang sedang dibawa (di versi ini belum digunakan penuh, tapi secara konsep untuk multiple orders).

```cpp
struct StackNode {
    Order orderData;
    StackNode* next;
};
```

- Node untuk **stack** riwayat order.
- `orderData` menyimpan salinan `Order`.
- `next` menunjuk ke node sebelumnya di stack (LIFO).


### 2.2. Global Variables

```cpp
Order* orderQueueHead = NULL;    // head queue pending orders (linked list)
Driver drivers[^5];               // array driver (maksimal 5)
int driverCount = 0;

StackNode* completedOrdersStack = NULL;  // stack history
Location popularLocations[^10];           // (belum dimanfaatkan penuh)
int locationCount = 0;

int nextOrderID = 1;                     // auto-increment ID
```

- `orderQueueHead`: pointer ke order pertama dalam antrian (queue).
- `drivers`: array statis untuk menyimpan driver.
- `completedOrdersStack`: top dari stack riwayat.
- `nextOrderID`: menjamin setiap order punya ID unik.

***

## 3. Fungsi Utility

### 3.1. Perhitungan Jarak

```cpp
float hitungJarak(Location a, Location b) {
    return sqrt(pow(a.x - b.x, 2) + pow(a.y - b.y, 2));
}
```

- Menggunakan rumus **Euclidean distance** $\sqrt{(x_1-x_2)^2 + (y_1-y_2)^2}$.
- Dipakai saat menghitung jarak driver ke lokasi tertentu.

***

## 4. Operasi pada MenuItem (Linked List)

### 4.1. Menambah Item ke Order

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

- Alur:

1. Alokasi node baru.
2. Kalau list kosong → `head` langsung menunjuk ke node baru.
3. Kalau tidak → traverse sampai node terakhir lalu sambungkan `next` ke node baru.
- Ini membangun **linked list** item makanan untuk satu order.


### 4.2. Menampilkan Items

```cpp
void tampilkanItems(MenuItem* head) {
    MenuItem* temp = head;
    while (temp != NULL) {
        cout << "   - " << temp->namaItem << " (Rp" << temp->harga << ")" << endl;
        temp = temp->next;
    }
}
```

- Melakukan traversal dari `head` sampai `NULL` dan mencetak setiap item.


### 4.3. Menghitung Total Harga

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

- Menjumlahkan `harga` dari tiap node di linked list.

***

## 5. Queue Pending Orders (Linked List)

### 5.1. Enqueue Order

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

- Logika:

1. Menduplikasi struct `orderBaru` ke dynamic node baru.
2. Kalau queue kosong → `orderQueueHead` jadi node baru.
3. Kalau tidak → traverse ke akhir, append node baru.
- Queue diimplementasikan sebagai **linked list** dengan prinsip FIFO.


### 5.2. Dequeue Order

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

- Mengambil node pertama:
    - Simpan pointer ke head.
    - Geser `orderQueueHead` ke node berikutnya.
    - Return pointer ke node lama (order yang sedang diproses).


### 5.3. Menampilkan Pending Orders

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

- Traversal queue dan print detail setiap order beserta daftar itemnya.

***

## 6. Stack Completed Orders

### 6.1. Push ke Stack

```cpp
void pushStack(Order order) {
    StackNode* newNode = new StackNode;
    newNode->orderData = order;
    newNode->next = completedOrdersStack;
    completedOrdersStack = newNode;
}
```

- Menambahkan order selesai ke atas stack:

1. Buat node baru.
2. `next` menunjuk ke top lama.
3. `completedOrdersStack` digeser ke node baru.
- Menghasilkan perilaku **LIFO**.


### 6.2. Pop dari Stack (tidak dipakai penuh di main, tapi konsepnya)

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

- Mengambil elemen paling atas:
    - Pindahkan top ke `next` dan return data lama.


### 6.3. Menampilkan History

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
        cout << count++ << ". Order #" << temp->orderData.orderID 
             << " - " << temp->orderData.customerName << endl;
        cout << "   Total: Rp" << temp->orderData.totalHarga << endl;
        temp = temp->next;
    }
}
```

- Traversal dari top stack ke bawah, sehingga order terbaru tampil di atas.

***

## 7. Manajemen Driver (Array + Sorting)

### 7.1. Menambah Driver

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

- Menunjukkan penggunaan **array of struct** dan `driverCount` sebagai ukuran efektif.


### 7.2. Menampilkan Driver

```cpp
void tampilkanDrivers() {
    cout << "\n===== DAFTAR DRIVER =====" << endl;
    for (int i = 0; i < driverCount; i++) {
        cout << i+1 << ". " << drivers[i].nama << " (ID: " << drivers[i].driverID << ")" << endl;
        cout << "   Posisi: (" << drivers[i].posisiSaatIni.x << "," 
             << drivers[i].posisiSaatIni.y << ")" << endl;
        cout << "   Status: " << drivers[i].status << endl << endl;
    }
}
```

- Loop sederhana di array driver.


### 7.3. Bubble Sort Driver berdasarkan Jarak

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

- Implementasi klasik **Bubble Sort**:
    - Membandingkan pasangan `(j, j+1)` dan swap jika jarak `j` lebih besar.
    - Setelah selesai, driver terdekat terhadap `target` ada di index `0`.

***

## 8. Searching

### 8.1. Linear Search Order by ID

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

- Traversal linked list dari head queue.
- Mengembalikan pointer ke order jika ditemukan; `NULL` jika tidak.


### 8.2. Binary Search Location (di sini disimplify sebagai linear)

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

- Secara nama, fungsi ini `binarySearchLocation`, tapi implementasinya linear search karena data kecil.
- Bisa mudah di-upgrade menjadi binary search jika array sudah di-sort.

***

## 9. Assign Order ke Driver (Core Logic)

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

    // Asumsi restaurant di koordinat (0,0)
    Location restaurant = {"Restaurant", 0, 0};
    sortDriversByDistance(restaurant);

    bool assigned = false;
    for (int i = 0; i < driverCount; i++) {
        if (drivers[i].status == "available") {
            cout << "\n✓ Order #" << order->orderID 
                 << " di-assign ke " << drivers[i].nama << endl;
            float jarak = hitungJarak(drivers[i].posisiSaatIni, order->lokasi);
            cout << "  Jarak: " << fixed << setprecision(2) << jarak << " km" << endl;
            cout << "  Estimasi: " << (int)(jarak * 5) << " menit" << endl;

            drivers[i].status = "busy";
            order->status = "on delivery";

            // Simulasi: selesai langsung
            order->status = "completed";
            pushStack(*order);                   // masuk history
            drivers[i].status = "available";     // driver kembali available
            drivers[i].posisiSaatIni = order->lokasi;  // posisi update

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

**Alur logika:**

1. Cek dulu apakah ada order dan driver.
2. Ambil order pertama dari queue (`dequeueOrder`).
3. Urutkan driver berdasarkan jarak ke **restaurant** (asumsi titik awal).
4. Loop driver:
    - Pilih driver yang statusnya `"available"`.
    - Hitung jarak driver → customer, tampilkan info.
    - Set status driver `busy` dan order `on delivery`.
    - Dalam versi sederhana ini, delivery langsung dianggap selesai:
        - Status order → `"completed"`.
        - Masukkan order ke stack history (`pushStack`).
        - Driver kembali `available` dan posisinya di-update ke lokasi customer.
5. Jika tidak ada driver available, order dikembalikan ke queue.

***

## 10. Pembuatan Order Baru

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

- Membuat struct `Order` baru di stack (bukan dynamic).
- `nextOrderID` di-increment untuk unique ID.
- Input string memakai `getline`, sehingga perlu `cin.ignore()` untuk membersihkan buffer.
- Loop penambahan item:
    - User memasukkan `namaItem` dan `harga`.
    - Jika nama `"selesai"` → keluar loop.
    - `tambahItem` menambahkan item ke linked list.
- Total harga dihitung dari linked list items.
- Order dimasukkan ke queue menggunakan `enqueueOrder`.

*(Catatan: penggunaan `cin.ignore()` berulang bisa menimbulkan bug input; ini salah satu titik yang bisa di-improve.)*

***

## 11. Fungsi `main` dan Alur Menu

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

**Alur menu:**

1. **Inisialisasi driver**: tiga driver default dibuat di awal.
2. Loop menu:
    - `[^1]` → input order baru, masuk queue.
    - `[^2]` → lihat semua order pending.
    - `[^3]` → ambil satu order dari queue, assign ke driver terdekat, lalu masukkan ke history.
    - `[^4]` → lihat posisi dan status driver.
    - `[^5]` → lihat stack riwayat order selesai.
    - `[^6]` → linear search order di queue berdasarkan ID.
    - `[^7]` → tambah driver baru ke array.
    - `[^0]` → exit program.

***

## 12. Ringkasan Keterkaitan Alur \& Struktur Data

- **Saat order dibuat**:
    - Struct `Order` diisi data.
    - Struct `MenuItem` berantai dalam linked list.
    - Order masuk ke **queue** (linked list).
- **Saat assign order**:
    - Order keluar dari queue (dequeue).
    - Driver dipilih dengan **Bubble Sort** berdasarkan jarak dari array driver.
    - Jarak dihitung dengan fungsi utility.
    - Order dianggap selesai dan masuk ke **Stack** riwayat.
- **Saat lihat history**:
    - Stack node ditraverse dari top → menunjukkan bahwa struktur **LIFO** bekerja.
- **Saat cari order**:
    - Linked list queue discan menggunakan **Linear Search**.

Program ini sudah menunjukkan integrasi banyak konsep dasar struktur data dalam satu studi kasus yang koheren: food delivery. Kamu bisa menaruh isi file ini sebagai `Penjelasan_Program.md` atau bagian dokumentasi laporan.

<div align="center">⁂</div>

[^1]: https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/images/38127017/9eeb4b6a-353e-4c8e-b288-c503388152b5/image.jpg

[^2]: https://ppl-ai-file-upload.s3.amazonaws.com/web/direct-files/attachments/images/38127017/3dc34878-b5e1-49b0-988c-e3d22a335220/image.jpg

