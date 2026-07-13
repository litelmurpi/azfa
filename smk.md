### 1. IaaS (Infrastruktur) \rightarrow Ngulik Cisco, VLAN, dan Routing
Di level SMK, sebelum ngomongin server cloud yang abstrak, kita harus bikin "jalan tol" datanya dulu.
 * **Praktik Nyata:** Di sinilah Anda bakal pusing ngapalin perintah CLI Cisco, nyetting *Switching*, *Routing (Static/Dynamic)*, bikin *VLAN*, sampai konfigurasi *Trunking*. Intinya, ngebangun infrastruktur jaringan fisiknya dulu pakai perangkat Cisco atau sejenisnya.
### 2. PaaS (Platform) \rightarrow VirtualBox, DNS, dan Web Server
Setelah jalurnya (Cisco) beres, Anda butuh tempat buat naruh aplikasi. Di SMK, inilah arti "Platform".
 * **Praktik Nyata:** Anda bakal buka **VirtualBox** atau **VMware**, install Linux Server (Debian/Ubuntu), lalu mulai ngulik **DNS Server (Bind9)** dan **Web Server (Apache/Nginx)**. Tujuannya supaya server lokal itu siap jadi platform yang bisa diakses dan menampung file web.
### 3. Sistem Keamanan Jaringan \rightarrow Makanan Sehari-hari bareng MikroTik
MikroTik sering banget jadi "pintu gerbang" keamanan di lab SMK karena fiturnya yang kaya dan visual (tinggal klik-klik di Winbox).
 * **Praktik Nyata:** Di mapel ini, Anda bakal sering ngulik *Firewall*, bikin aturan *Filter Rules* (buat ngeblokir situs atau IP nakal), nyetting *NAT*, sampai ngatur *Bandwidth Management* supaya internet lab nggak habis buat satu orang.
### 4. SaaS \rightarrow Pengelolaan Database & Aplikasi Siap Pakai
Karena tingkatannya sudah "Software", fokusnya bergeser ke bagaimana mengelola data dan aplikasi agar langsung bisa dipakai user.
 * **Praktik Nyata:** Mengulik manajemen **Database Server** (seperti MySQL atau phpMyAdmin), mengatur hak akses user database, serta melakukan *backup-restore* data. Kadang juga dipakai buat belajar install CMS atau aplikasi instan siap pakai lainnya.
### 5. IoT (Internet of Things) \rightarrow Dari Basic, LED, sampai Seven Segment
Di SMK, IoT nggak langsung lompat ke sistem AI yang rumit. Belajarnya dirunut dari dasar elektronika dan logika pemrograman dasar.
 * **Praktik Nyata:** Dimulai dari hal-hal basic seperti menyalakan LED (Blink), memprogram **Seven Segment** untuk bikin penghitung angka, memunculkan teks di LCD, hingga membaca sensor suhu sederhana sebelum akhirnya data itu dikirim ke internet.
