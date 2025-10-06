# Materi Pembelajaran Pemrograman Web Lanjut (SI118)

## **Gambaran Umum Mata Kuliah**

**Mata Kuliah**: Pemrograman Web Lanjut  
**Kode**: SI118  
**SKS**: 2  
**Semester**: 3  
**Prasyarat**: Pengenalan Perancangan Web (SI071)  

**Deskripsi**: Mata kuliah ini fokus pada pengembangan hard skill pemrograman web sisi server menggunakan PHP dan framework CodeIgniter, serta soft skill pemecahan masalah dalam lingkup pemrograman web.

---

## **Topik 1: Web Server dan Server Side Scripting**
*Pertemuan 1-2*

### **Materi Dasar:**
- **Perbedaan Web Statis vs Web Dinamis**
  - Web statis: konten tetap, tidak berubah
  - Web dinamis: konten dapat berubah berdasarkan input user
  
- **Server Side vs Client Side Scripting**
  - Server Side: diproses di server (PHP, Python, Java)
  - Client Side: diproses di browser (JavaScript)

- **Web Server dan Konfigurasi**
  - Pengertian web server (Apache, Nginx)
  - Instalasi dan konfigurasi XAMPP
  - Struktur direktori web server

- **Dasar-dasar PHP**
  - Sintaks dasar PHP (`<?php ?>`)
  - Cara menjalankan file PHP
  - Konfigurasi PHP.ini

### **Latihan Praktis:**
1. Install XAMPP dan konfigurasi
2. Buat file PHP sederhana dengan output "Hello World"
3. Eksplorasi struktur direktori htdocs
4. Test koneksi server lokal

---

## **Topik 2: Struktur Logika PHP**
*Pertemuan 3-4*

### **Materi Dasar:**
- **Variabel dan Konstanta**
  ```php
  $nama = "John";
  define("PI", 3.14);
  ```

- **Tipe Data PHP**
  - String, Integer, Float, Boolean
  - Array, Object, NULL

- **Operator**
  - Aritmatika (+, -, *, /, %)
  - Assignment (=, +=, -=)
  - Increment/Decrement (++, --)
  - Perbandingan (==, !=, <, >)
  - Logika (&&, ||, !)

- **Form Parameter**
  - Method GET vs POST
  - Mengambil data dari form
  ```php
  $_GET['nama'];
  $_POST['nama'];
  ```

### **Latihan Praktis:**
1. Buat form HTML sederhana
2. Proses data form dengan PHP
3. Implementasi berbagai operator
4. Eksperimen dengan tipe data

---

## **Topik 3: Struktur Kendali Percabangan dan Perulangan**
*Pertemuan 5-6*

### **Materi Percabangan:**
- **If Statement**
  ```php
  if ($nilai >= 80) {
      echo "A";
  } elseif ($nilai >= 70) {
      echo "B";
  } else {
      echo "C";
  }
  ```

- **Switch Statement**
  ```php
  switch ($hari) {
      case "Senin":
          echo "Hari kerja";
          break;
      default:
          echo "Hari lain";
  }
  ```

### **Materi Perulangan:**
- **While Loop**
  ```php
  $i = 1;
  while ($i <= 10) {
      echo $i;
      $i++;
  }
  ```

- **For Loop**
  ```php
  for ($i = 1; $i <= 10; $i++) {
      echo $i;
  }
  ```

- **Foreach Loop**
  ```php
  foreach ($array as $value) {
      echo $value;
  }
  ```

### **Latihan Praktis:**
1. Buat kalkulator sederhana dengan percabangan
2. Implementasi tabel perkalian dengan perulangan
3. Validasi form dengan kondisi
4. Studi kasus: sistem grading

---

## **Topik 4: Array dan Function**
*Pertemuan 7-8*

### **Array:**
- **Jenis Array**
  - Indexed Array: `$buah = ["apel", "jeruk"]`
  - Associative Array: `$umur = ["John" => 25]`
  - Multidimensional Array

- **Fungsi Array**
  - `count()`, `array_push()`, `array_pop()`
  - `sort()`, `rsort()`, `asort()`
  - `in_array()`, `array_search()`

### **Function:**
- **Struktur Function**
  ```php
  function namaFunction($parameter) {
      return $hasil;
  }
  ```

- **Parameter dan Return Value**
- **Scope Variable (global, local)**
- **Built-in Functions vs Custom Functions**

### **Latihan Praktis:**
1. Manipulasi array mahasiswa
2. Buat fungsi kalkulator
3. Sistem pengelolaan data dengan array
4. Function untuk validasi input

---

## **Topik 5: Database dalam Aplikasi Web**
*Pertemuan 9*

### **Materi Database:**
- **Konsep Database dalam Web**
  - Relasi frontend-backend-database
  - RDBMS (MySQL)

- **phpMyAdmin**
  - Interface pengelolaan database
  - Membuat database dan tabel
  - Import/Export data

- **Koneksi PHP-MySQL**
  ```php
  $conn = mysqli_connect("localhost", "root", "", "database");
  if (!$conn) {
      die("Koneksi gagal: " . mysqli_connect_error());
  }
  ```

- **Session dan Cookie**
  - `session_start()`
  - `$_SESSION['user']`
  - `setcookie()`, `$_COOKIE`

### **Latihan Praktis:**
1. Desain database sederhana
2. Implementasi koneksi database
3. Pengelolaan session login
4. Eksperimen cookie

---

## **Topik 6: Operasi CRUD**
*Pertemuan 10-12*

### **CRUD Operations:**
- **Create (Insert)**
  ```php
  $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
  mysqli_query($conn, $sql);
  ```

- **Read (Select)**
  ```php
  $result = mysqli_query($conn, "SELECT * FROM users");
  while($row = mysqli_fetch_assoc($result)) {
      echo $row['name'];
  }
  ```

- **Update**
  ```php
  $sql = "UPDATE users SET name='$name' WHERE id=$id";
  mysqli_query($conn, $sql);
  ```

- **Delete**
  ```php
  $sql = "DELETE FROM users WHERE id=$id";
  mysqli_query($conn, $sql);
  ```

### **Fitur Tambahan:**
- **File Upload/Download**
- **Halaman Home dengan navigasi**
- **Pagination**
- **Search functionality**

### **Latihan Praktis:**
1. Sistem manajemen mahasiswa (CRUD lengkap)
2. Upload foto profil
3. Implementasi pencarian data
4. Pagination hasil query

---

## **Topik 7: Object Oriented Programming & MVC**
*Pertemuan 16-17*

### **OOP PHP:**
- **Class dan Object**
  ```php
  class User {
      public $name;
      
      public function __construct($name) {
          $this->name = $name;
      }
      
      public function getName() {
          return $this->name;
      }
  }
  ```

- **Inheritance, Encapsulation, Polymorphism**
- **Visibility (public, private, protected)**

### **Konsep MVC:**
- **Model**: Logika data dan database
- **View**: Tampilan/interface
- **Controller**: Logika bisnis dan kontrol alur

### **Framework CodeIgniter:**
- **Instalasi dan konfigurasi CI**
- **Struktur direktori CI**
- **Routing system**

### **Latihan Praktis:**
1. Buat class sederhana dengan OOP
2. Install CodeIgniter
3. Buat controller dan view pertama
4. Implementasi routing

---

## **Topik 8: Framework CodeIgniter**
*Pertemuan 18-21*

### **Komponen CI:**
- **Routes**
  ```php
  $route['products'] = 'ProductController/index';
  ```

- **Helpers dan Libraries**
  - URL Helper, Form Helper
  - Database Library, Session Library

- **Models dalam CI**
  ```php
  class User_model extends CI_Model {
      public function get_users() {
          return $this->db->get('users')->result();
      }
  }
  ```

### **Form Processing:**
- **Form Validation**
- **Active Record untuk database**
- **CRUD dengan CI framework**

### **Latihan Praktis:**
1. Refactor CRUD ke struktur MVC
2. Implementasi login system dengan CI
3. Validasi form dengan CI
4. Dashboard admin sederhana

---

## **Topik 9: Application Programming Interface (API)**
*Pertemuan 22*

### **Konsep API:**
- **REST API principles**
- **HTTP Methods (GET, POST, PUT, DELETE)**
- **JSON response format**

### **Membuat API dengan CI:**
```php
public function users_get() {
    $users = $this->User_model->get_all();
    $this->response($users, 200);
}
```

### **Testing API:**
- **Postman untuk testing**
- **cURL commands**
- **Konsumsi API dari aplikasi lain**

### **Latihan Praktis:**
1. Buat REST API sederhana
2. Test dengan Postman
3. Konsumsi API dari aplikasi web
4. Implementasi authentication API

---

## **Topik 10: Final Project**
*Pertemuan 23-29*

### **Sistem Informasi Web Dinamis:**
- **Perencanaan sistem**
- **Database design**
- **Implementation dengan CI**
- **Testing dan debugging**

### **Contoh Project:**
1. Sistem Perpustakaan Online
2. E-Commerce Sederhana
3. Sistem Manajemen Sekolah
4. Blog/CMS Sederhana

### **Deliverables:**
- Source code lengkap
- Database script
- Dokumentasi teknis
- Presentasi demo

---

## **Evaluasi dan Penilaian**

### **Komponen Penilaian:**
- **Laporan Praktikum**: 19.5%
- **Kuis**: 5.5%
- **Responsi**: 20%
- **UTS**: 15%
- **Final Project**: 25%
- **UAS**: 15%

### **Timeline Evaluasi:**
- Laporan praktikum: setiap pertemuan praktikum
- Kuis: pertemuan 5, 7, 18, 20
- Responsi: pertemuan 14
- UTS: pertemuan 15
- Final Project: pertemuan 23-29
- UAS: pertemuan 30

---

## **Sumber Belajar**

### **Buku Utama:**
1. Arief, M.Rudyanto. (2011). *Pemrograman Web Dinamis Menggunakan PHP dan MySQL*

### **Referensi Online:**
1. [W3Schools PHP Tutorial](http://www.w3schools.com/php)
2. [CodeIgniter Documentation](https://codeigniter.com/docs)
3. [PHP Official Documentation](https://www.php.net/manual/)

### **Tools yang Dibutuhkan:**
1. XAMPP (Apache, MySQL, PHP)
2. Text Editor (VS Code, Sublime Text)
3. Browser (Chrome, Firefox)
4. Postman (untuk testing API)

---

## **Tips Sukses**

1. **Praktik Konsisten**: Latihan coding setiap hari
2. **Pahami Konsep**: Jangan hanya menghafal syntax
3. **Debugging Skills**: Belajar mencari dan memperbaiki error
4. **Version Control**: Gunakan Git untuk tracking progress
5. **Community**: Bergabung dengan forum PHP/CodeIgniter

### **Roadmap Pembelajaran:**
```
Minggu 1-2: Dasar PHP & Server Setup
Minggu 3-4: Logika & Struktur Kontrol  
Minggu 5-6: Array & Function
Minggu 7-8: Database Integration
Minggu 9-10: CRUD Operations
Minggu 11-12: OOP & MVC Concepts
Minggu 13-14: CodeIgniter Framework
Minggu 15-16: API Development
Minggu 17-20: Final Project
```

Semoga materi pembelajaran ini membantu Anda menguasai Pemrograman Web Lanjut dengan baik!
