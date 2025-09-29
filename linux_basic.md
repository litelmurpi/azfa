## 1. Apa itu Linux?

-   **Definisi:** Linux adalah sistem operasi berbasis UNIX yang bersifat **open source**. Artinya, kode sumbernya dapat dilihat, dimodifikasi, dan didistribusikan secara bebas oleh siapa saja.
-   **Lisensi:** Didistribusikan di bawah *General Public License* (GPL), yang memastikan bahwa sistem operasi ini akan tetap gratis.
-   **Sejarah & Peran:** Mulai dikembangkan pada tahun 1990-an oleh Linus Torvalds. Kini, Linux menjadi tulang punggung dari sebagian besar infrastruktur internet global, termasuk server web, database, dan layanan cloud. Banyak perusahaan teknologi besar seperti Google, Amazon, IBM, dan Oracle sangat bergantung pada Linux.

---

## 2. Jenis dan Distribusi (Distro) Linux

Linux bukanlah satu sistem operasi tunggal, melainkan sebuah kernel yang menjadi dasar bagi banyak sistem operasi lain yang disebut **distribusi (distro)**.

### Jenis Penggunaan Linux:
-   **Desktop OS:** Untuk penggunaan sehari-hari layaknya Windows atau macOS. Contoh: Ubuntu Desktop, Linux Mint.
-   **Server OS:** Versi yang dioptimalkan untuk berjalan sebagai server, biasanya tanpa antarmuka grafis (GUI) untuk efisiensi.
-   **Network Device OS:** Digunakan pada perangkat jaringan seperti router dan switch.
-   **Mobile Device OS:** **Android** adalah contoh paling terkenal, yang dibangun di atas kernel Linux.
-   **Cloud OS:** Distro yang disesuaikan khusus untuk berjalan efisien di lingkungan *cloud computing*.

### Keluarga Distro Populer:
Setiap distro memiliki manajer paket, komunitas, dan filosofinya sendiri.
-   **Debian-based:** Dikenal stabil dan memiliki repositori perangkat lunak yang sangat besar.
    -   *Contoh:* **Debian**, **Ubuntu** (turunan paling populer), **Linux Mint**.
-   **Red Hat-based:** Fokus pada lingkungan enterprise dan komersial.
    -   *Contoh:* **Red Hat Enterprise Linux (RHEL)**, **Fedora** (untuk inovasi), **CentOS Stream** (pengembangan untuk RHEL).
-   **Arch-based:** Dikenal dengan filosofi "Keep It Simple" dan memberikan kontrol penuh kepada pengguna.
    -   *Contoh:* **Arch Linux**, **Manjaro**.

---

## 3. Mengapa Perlu Belajar Linux?

-   **Gratis dan Open Source:** Tidak ada biaya lisensi untuk menggunakan atau mendistribusikannya.
-   **Stabil dan Aman:** Arsitekturnya yang berbasis UNIX membuatnya sangat stabil dan lebih kebal terhadap malware dibandingkan sistem operasi lain.
-   **Fleksibel dan Ringan:** Dapat berjalan di berbagai perangkat keras, dari superkomputer hingga perangkat kecil seperti Raspberry Pi, dan dapat diinstal tanpa GUI untuk menghemat sumber daya.
-   **Standar Industri Teknologi:** Pemahaman Linux adalah syarat mutlak untuk banyak profesi di bidang IT, seperti:
    -   **System Administrator & Infrastructure Engineer:** Mengelola server fisik dan virtual.
    -   **DevOps & Automation Engineer:** Otomatisasi *deployment* dan manajemen infrastruktur.
    -   **Cloud Engineer:** Bekerja dengan layanan cloud (AWS, Google Cloud, Azure) yang mayoritas berjalan di atas Linux.
    -   **Cybersecurity Specialist:** Melakukan analisis keamanan dan *penetration testing*.
    -   **Software Developer:** Mengembangkan dan men-deploy aplikasi.

---

## 4. Demonstrasi Praktis & Konsep Penting

Bagian kedua video berfokus pada simulasi penggunaan **Ubuntu Desktop** melalui **VMware**.

### a. Struktur Direktori Linux (File System Hierarchy)

Linux menggunakan struktur hierarki tunggal yang dimulai dari **root (`/`)**. Semua file, folder, dan perangkat dianggap sebagai file dalam hierarki ini.

-   `/` : **Root Directory**, titik awal dari semua file dan direktori.
-   `/bin` : (*Binary*) Berisi perintah-perintah esensial yang bisa digunakan oleh semua pengguna.
-   `/sbin` : (*System Binary*) Perintah esensial untuk administrasi sistem, biasanya hanya bisa dijalankan oleh *root*.
-   `/home` : Direktori yang berisi folder pribadi untuk setiap pengguna (misal: `/home/budi`).
-   `/etc` : (*Etcetera*) Berisi semua file konfigurasi untuk sistem dan aplikasi.
-   `/var` : (*Variable*) Menyimpan data yang sering berubah, seperti *log* sistem (`/var/log`), web, dan database.
-   `/tmp` : (*Temporary*) Digunakan untuk menyimpan file-file sementara yang akan dihapus saat sistem *reboot*.
-   `/usr` : (*User System Resources*) Berisi aplikasi, pustaka (*libraries*), dan dokumentasi yang diinstal oleh pengguna.
-   `/root` : Direktori *home* khusus untuk pengguna **root**.
-   `/dev` : (*Devices*) Berisi file-file yang merepresentasikan perangkat keras (seperti hard disk, keyboard).

### b. Penggunaan Terminal dan Perbedaan User

-   **User Biasa (`$`):** Memiliki hak akses terbatas untuk melindungi sistem dari perubahan yang tidak disengaja. Ditandai dengan simbol dolar (`$`).
-   **Super User / Root (`#`):** Memiliki hak akses penuh ke seluruh sistem. Bisa memodifikasi file apa pun dan melakukan konfigurasi sistem. Ditandai dengan simbol pagar (`#`).
-   **Peralihan User:**
    -   `sudo <perintah>`: Menjalankan satu perintah spesifik dengan hak akses *root*.
    -   `sudo su` atau `sudo -i`: Beralih sesi menjadi *user root* secara permanen hingga keluar.

---

## 5. Perintah-Perintah yang Paling Sering Digunakan

Berikut adalah daftar perintah yang diperluas, mencakup yang ada di video dan perintah esensial lainnya yang wajib diketahui.

### Navigasi & Manajemen File/Direktori
| Perintah | Fungsi | Contoh Penggunaan |
| :--- | :--- | :--- |
| `ls` | Menampilkan isi direktori. | `ls -al` (menampilkan semua file, termasuk yang tersembunyi, dalam format daftar) |
| `cd` | Berpindah direktori. | `cd /home/user/Documents`, `cd ..` (kembali), `cd ~` (ke home) |
| `pwd` | Menampilkan path direktori saat ini. | `pwd` |
| `cp` | Menyalin file atau direktori. | `cp file.txt /tujuan/`, `cp -r folder/ /tujuan/` (-r untuk direktori) |
| `mv` | Memindahkan atau mengubah nama file/direktori. | `mv file.txt /tujuan/`, `mv lama.txt baru.txt` (rename) |
| `rm` | Menghapus file atau direktori. | `rm file.txt`, `rm -rf folder/` (-rf untuk menghapus paksa direktori) **(Hati-hati!)** |
| `mkdir` | Membuat direktori baru. | `mkdir folder_baru` |
| `touch` | Membuat file kosong atau memperbarui timestamp. | `touch file_baru.txt` |
| `find` | Mencari file atau direktori. | `find /home -name "*.txt"` (mencari semua file .txt di /home) |
| `grep` | Mencari teks di dalam file. | `grep "kata_kunci" file.log` |

### Melihat & Mengedit File
| Perintah | Fungsi | Contoh Penggunaan |
| :--- | :--- | :--- |
| `cat` | Menampilkan seluruh isi file ke layar. | `cat /etc/os-release` |
| `less` | Menampilkan isi file per halaman (lebih interaktif). | `less file_besar.log` (Gunakan panah untuk navigasi, 'q' untuk keluar) |
| `head` | Menampilkan 10 baris pertama dari sebuah file. | `head file.txt`, `head -n 20 file.txt` (20 baris pertama) |
| `tail` | Menampilkan 10 baris terakhir dari sebuah file. | `tail file.log`, `tail -f file.log` (-f untuk memantau file secara live) |
| `nano` | Editor teks yang ramah pemula di terminal. | `nano konfigurasi.conf` |
| `vim` | Editor teks yang sangat *powerful* (membutuhkan sedikit pembelajaran). | `vim skrip.sh` |

### Manajemen Sistem & Proses
| Perintah | Fungsi | Contoh Penggunaan |
| :--- | :--- | :--- |
| `ps` | Menampilkan proses yang sedang berjalan. | `ps aux` (melihat semua proses dari semua user) |
| `top` / `htop` | Memantau penggunaan CPU, RAM, dan proses secara *real-time*. | `htop` (*htop* lebih interaktif dan visual, mungkin perlu diinstal dulu) |
| `kill` | Menghentikan sebuah proses. | `kill 1234` (1234 adalah ID proses) |
| `df` | Menampilkan penggunaan ruang disk. | `df -h` (-h untuk format *human-readable*) |
| `du` | Menampilkan ukuran file/direktori. | `du -sh /home/user` (-sh untuk total ukuran) |
| `chmod` | Mengubah hak akses (*permission*) file/direktori. | `chmod +x skrip.sh` (memberikan izin eksekusi) |
| `chown` | Mengubah pemilik file/direktori. | `sudo chown user:user file.txt` |
| `systemctl` | Mengontrol layanan (*services*) sistem (di distro modern). | `sudo systemctl status apache2`, `sudo systemctl restart network` |
| `apt` / `yum` | Manajer paket untuk menginstal/menghapus aplikasi. | `sudo apt update`, `sudo apt install htop` (Debian/Ubuntu) |

### Jaringan
| Perintah | Fungsi | Contoh Penggunaan |
| :--- | :--- | :--- |
| `ip` | Menampilkan dan mengelola informasi jaringan. | `ip a` (melihat alamat IP) |
| `ping` | Menguji konektivitas ke sebuah host. | `ping google.com` |
| `ssh` | Terhubung ke server lain secara aman. | `ssh user@192.168.1.100` |
| `wget`/`curl` | Mengunduh file dari internet. | `wget https://example.com/file.zip` |
