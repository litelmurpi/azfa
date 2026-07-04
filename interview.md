# Panel Interview Simulation Script: PT Mindo Small Business Solutions (Technical Analyst)

This document contains a simulated panel (group) interview script for the **Technical Analyst** position at **PT Mindo Small Business Solutions (Yogyakarta - Hybrid)**. The evaluation and dialogue are designed to be highly objective, testing candidates on tech support workflows (TicketOS), API debugging, SQL querying, English communication, and their ability to commit to a hybrid setup in Yogyakarta.

---

## Job Requirements & Context / Kebutuhan Lowongan & Konteks
* **Position:** Technical Analyst
* **Company:** PT Mindo Small Business Solutions (Yogyakarta, Indonesia)
* **Type:** Full-time, Hybrid (Yogyakarta)
* **Required Technical Skills:** SQL, APIs, Google Workspace. Familiarity with Python, PHP, or AWS is a plus.
* **Experience Required:** At least 1 year in tech support, QA/testing, software development, SaaS, or similar.
* **Required Soft Skills:** Curious and analytical mind, clear communication (English & Bahasa Indonesia).
* **Salary:** IDR 4,000,000 – IDR 6,000,000.
* **Candidate Fit Analysis:**
  - **Yudistira** is a **very strong fit**. His 12-month internship managing **TicketOS** (IT helpdesk) and developing ERP systems maps directly to the technical support, QA, and PHP pluses of the role.
  - **Adam** is a **good fit**. His database schema design experience and project leadership in TANAMI align well with the data validation and analytical requirements.
  - **Evan** is a **partial fit**. He meets the education criteria (CS degree) and has good communication skills, but lacks hands-on SQL and API troubleshooting experience.

---

# 🇮🇩 Versi Indonesia: Transkrip Wawancara

### **[Sesi Dimulai]**

**Wasima (HRD):** "Selamat sore rekan-rekan. Terima kasih sudah hadir di interview panel PT Mindo Small Business Solutions. Saya Wasima dari HRD, dan di sebelah saya ada Mas Aliv selaku Lead Technical Analyst. 

Mindo melayani klien global di berbagai industri, termasuk industri *vacation rental* (penyewaan vila/liburan). Peran **Technical Analyst** di sini berfokus pada investigasi masalah teknis, validasi data integrasi (tarif, pajak), dan dokumentasi. Sistem kerja kami adalah **hybrid** di Yogyakarta. 

Karena klien kami internasional, kami membutuhkan komunikasi bahasa Inggris yang baik. *To begin, please introduce yourselves in English and explain how your background aligns with a Technical Analyst role. Yudistira, please start.*"

**Yudistira:** "Good afternoon, Mrs. Wasima and Mr. Aliv. My name is Yudistira Azfa Dani Wibowo, a student of Information Systems at Amikom. I believe my background fits this role perfectly. During my one-year internship at Quick Tractor, I maintained and managed **TicketOS**, which was our internal IT helpdesk ticketing system. This role required me to analyze user-reported bugs, replicate technical issues, trace log files, and write documentation for bug fixes. I am also highly familiar with database queries in MySQL and PostgreSQL, and I have hands-on experience designing REST APIs using PHP/Laravel."

**Wasima (HRD):** "*Excellent alignment with TicketOS. Thank you, Yudistira. Adam, please introduce yourself.*"

**Adam:** "Good afternoon. My name is Muhammad Adam Siswantoro, majoring in Information Systems at Amikom. My alignment with this role comes from my analytical mindset and experience as the Founder & Project Manager of TANAMI. I was responsible for designing our relational database schema and mapping how data flowed between IoT sensors, the backend, and our e-commerce platform. I enjoy diagnosing system discrepancies and identifying why data is not synchronizing correctly, which matches the proactive monitoring required for this role."

**Wasima (HRD):** "*Thank you, Adam. And lastly, Evan.*"

**Evan:** "Good afternoon, everyone. My name is Evan Aubin Wibowo, majoring in Computer Science with a specialization in Digital Media. While my experience is primarily in creative video production and editing, I possess a strong computer science foundation. I have excellent structured communication skills, which I use to coordinate with multiple stakeholders under tight deadlines. I have an analytical mind and am comfortable with basic systems and Linux configurations. I am eager to transition my career back to a technical, support-oriented role like this."

**Aliv (Technical Lead):** "Terima kasih atas perkenalannya. Sekarang kita lanjutkan dengan Bahasa Indonesia ya. 

Yudistira, pengalamanmu mengelola **TicketOS** sangat relevan. Di Mindo, kami sering menerima laporan 'reaktif' dari user. Misalnya, ada laporan bahwa tarif kamar di platform mitra (seperti Airbnb atau Booking.com) tidak sinkron dengan sistem internal *vacation rental* kami. 
Sebagai orang yang biasa menangani tiket masalah, bagaimana langkah sistematis pertamamu untuk melacak dan mencari akar masalah (*root cause*) dari *bug* sinkronisasi data tarif tersebut?"

**Yudistira:** "Baik, Mas Aliv. Jika saya menerima laporan tarif tidak sinkron, langkah pertama saya adalah **mereplikasi skenario** tersebut. Saya akan memeriksa data mentah di database internal untuk melihat apakah tarif yang tersimpan sudah benar. Selanjutnya, saya akan melakukan **API testing** (misalnya menggunakan Postman atau memeriksa log API *gateway*) untuk melihat isi *payload request* dan *response* dari integrasi pihak ketiga. 
Saya akan menganalisis apakah kegagalan terjadi karena kesalahan perhitungan formula pajak/fee di sistem kami (sisi PHP/backend), atau karena respons error dari API platform mitra (misalnya masalah otentikasi token atau perubahan skema data). Setelah akar masalahnya ditemukan, saya akan mendokumentasikannya secara terstruktur dan merumuskan spesifikasi perbaikan untuk tim developer."

**Aliv (Technical Lead):** "Sangat runut dan terstruktur. Bagus. 

Sekarang untuk Adam. Di posisi ini, kita harus proaktif memantau keakuratan data. Kamu pernah merancang skema database relational di TANAMI. Jika saya meminta kamu menulis query SQL untuk memvalidasi apakah ada data transaksi pembayaran yang total tagihannya tidak cocok dengan jumlah rincian (harga produk + pajak + biaya layanan), bagaimana logika query SQL yang akan kamu buat?"

**Adam:** "Untuk validasi tersebut, saya akan menggunakan query dengan fungsi agregasi dan klausa `HAVING`. Logikanya, saya akan melakukan `SELECT` pada ID Transaksi dan Total Tagihan dari tabel master transaksi. Kemudian saya lakukan `JOIN` dengan tabel detail transaksi. 
Saya akan mengelompokkan data berdasarkan ID Transaksi (`GROUP BY`), menjumlahkan subtotal produk, pajak, dan biaya layanan menggunakan fungsi `SUM()`. Terakhir, saya gunakan `HAVING` untuk menyaring baris di mana `Total Tagihan` di tabel master tidak sama dengan hasil penjumlahan `SUM()` di tabel detail tersebut. Baris yang muncul dari query ini adalah data transaksi yang tidak sinkron dan perlu diinvestigasi."

**Aliv (Technical Lead):** "Tepat sekali. Pemahaman relasi datamu cukup kuat. 

Sekarang ke Evan. Di CV kamu tidak tertulis pengalaman praktis menggunakan database SQL atau pengujian API, sementara itu adalah kualifikasi wajib kami. Sebagai lulusan ilmu komputer, bisakah kamu jelaskan pemahaman teoritismu tentang apa itu REST API dan bagaimana sebuah data dikirimkan melalui API?"

**Evan:** "Secara teoritis, REST API adalah jembatan komunikasi antar aplikasi yang berbeda menggunakan protokol HTTP standar. Data biasanya dikirim dalam format JSON karena ringan dan mudah dibaca oleh manusia maupun mesin. 
Proses pengirimannya menggunakan metode atau *HTTP Methods* seperti GET untuk mengambil data, POST untuk mengirim data baru, PUT/PATCH untuk memperbarui, dan DELETE untuk menghapus. Di dalam request tersebut, terdapat *header* (yang biasanya berisi token autentikasi) dan *body* yang berisi data aktual yang dikirimkan. Meskipun saya belum menggunakannya di pekerjaan videografi, secara konsep akademis saya memahaminya dan siap mempraktikkannya menggunakan Google Workspace atau *scripting* dasar."

**Aliv (Technical Lead):** "Oke, penjelasan konsepnya cukup bersih, Evan."

**Wasima (HRD):** "Mindo menawarkan sistem kerja **hybrid** (beberapa hari WFH dan beberapa hari onsite di kantor kami di Yogyakarta). Kami juga menyediakan kursus Bahasa Inggris gratis bagi karyawan. Apakah ada kendala dengan sistem kerja hybrid ini, dan berapa ekspektasi gaji kalian?"

**Yudistira:** "Sistem hybrid sangat ideal bagi saya karena saya bisa menyeimbangkan kehadiran fisik di kantor Sleman dengan sisa kuliah saya. Ekspektasi gaji saya berada di angka Rp 5.000.000, sesuai dengan rata-rata posisi Technical Analyst pemula di Yogyakarta."

**Adam:** "Saya juga tidak ada kendala dengan hybrid. Ekspektasi saya di angka Rp 4.500.000."

**Evan:** "Sistem hybrid sangat cocok untuk saya. Ekspektasi saya di angka Rp 5.000.000."

**Wasima (HRD):** "Baik, terima kasih banyak atas kehadiran dan pemaparan rekan-rekan sekalian. Kami akan memproses hasil evaluasi ini dan menghubungi kalian dalam waktu dekat. Selamat sore."

### **[Sesi Selesai]**

---

# 💬 Diskusi Pasca-Wawancara (Pewawancara Only)

**Wasima (HRD):** "Gimana menurutmu, Liv, secara teknis dari mereka bertiga? Ada yang benar-benar sreg?"

**Aliv (Technical Lead):** "Jujur, Yudistira paling menonjol dan siap pakai. Pas saya tanya soal penanganan *bug* sinkronisasi tarif, langkah-langkahnya taktis. Dia langsung mikir untuk cek integritas data di DB lokal, lalu lakukan testing API pakai Postman. Ditambah dia punya pengalaman 1 tahun pegang TicketOS pas magang, jadi dia tahu persis alur kerja *troubleshooting* tiket."

**Wasima (HRD):** "Iya, saya juga sepakat. Respon dia sangat taktis. Tapi masalahnya dia masih kuliah aktif angkatan 2024 di Amikom. Walau dia bilang bisa ambil kelas malam atau online, posisi ini kan *hybrid* dan butuh kehadiran fisik di Jogja secara teratur. Kita harus pastikan dulu jadwal kuliahnya nggak bentrok dengan jam operasional kantor kita."

**Aliv (Technical Lead):** "Betul, Was. Kita perlu verifikasi jadwal kuliahnya. Kalau Adam gimana menurutmu?"

**Wasima (HRD):** "Adam komunikasinya bagus banget pas perkenalan bahasa Inggris tadi. Jiwa kepemimpinannya juga kelihatan karena dia pernah jadi Founder & PM proyek TANAMI. Tapi secara kompetensi praktis untuk Technical Analyst, dia masih di bawah Yudistira ya?"

**Aliv (Technical Lead):** "Iya. Dia paham query SQL, tadi logika HAVING dan SUM-nya tepat sasaran. Tapi dia belum punya pengalaman praktis menangani *user support* langsung atau pengujian sistem skala komersial. Dia lebih cocok jadi kandidat cadangan (*backup*) kita, atau diarahkan ke jalur Junior Product Management."

**Wasima (HRD):** "Oke, berarti Yudistira prioritas utama kita, Adam jadi cadangan. Nah, kalau untuk Evan... Kasihan juga ya, dia bergelar Sarjana Komputer tapi portofolionya video semua."

**Aliv (Technical Lead):** "Hahaha, iya. Pas saya tanya soal REST API, dia jawabnya teoritis banget kayak baca buku teks kuliah. Dia jujur sih kalau nggak punya pengalaman SQL/API praktis. Secara kompetensi teknis, dia belum siap untuk langsung pegang data integrasi kita yang lumayan sensitif di industri *vacation rental* ini."

**Wasima (HRD):** "Tapi pembawaannya tenang dan komunikasinya terstruktur ya. Sayang banget kalau dilepas begitu saja. Mungkin kita bisa simpan CV-nya untuk posisi Video Editor atau QA manual tester pemula kalau ke depan ada kebutuhan di proyek lain."

**Aliv (Technical Lead):** "Setuju, Was. Untuk sekarang kita tawarkan ke Yudistira dulu dengan catatan dia harus membuktikan jadwal kuliahnya aman untuk jam kerja kita."

---

# 🇬🇧 English Version: Interview Transcript

### **[Session Starts]**

**Wasima (HR):** "Good afternoon, everyone. Thank you for attending this panel interview for PT Mindo Small Business Solutions. I am Wasima from HR, and next to me is Mr. Aliv, our Lead Technical Analyst.

Mindo serves global clients across various industries, including the vacation rental sector. The Technical Analyst role here focuses on investigating technical issues, validating system integration data (pricing, taxes), and maintaining documentation. Our work arrangement is hybrid, based in Yogyakarta.

Since our clients are international, we require strong English communication skills. To begin, please introduce yourselves in English and explain how your background aligns with a Technical Analyst role. Yudistira, please start."

**Yudistira:** "Good afternoon, Mrs. Wasima and Mr. Aliv. My name is Yudistira Azfa Dani Wibowo, a student of Information Systems at Amikom. I believe my background fits this role perfectly. During my one-year internship at Quick Tractor, I maintained and managed **TicketOS**, which was our internal IT helpdesk ticketing system. This role required me to analyze user-reported bugs, replicate technical issues, trace log files, and write documentation for bug fixes. I am also highly familiar with database queries in MySQL and PostgreSQL, and I have hands-on experience designing REST APIs using PHP/Laravel."

**Wasima (HR):** "Excellent alignment with TicketOS. Thank you, Yudistira. Adam, please introduce yourself."

**Adam:** "Good afternoon. My name is Muhammad Adam Siswantoro, majoring in Information Systems at Amikom. My alignment with this role comes from my analytical mindset and experience as the Founder & Project Manager of TANAMI. I was responsible for designing our relational database schema and mapping how data flowed between IoT sensors, the backend, and our e-commerce platform. I enjoy diagnosing system discrepancies and identifying why data is not synchronizing correctly, which matches the proactive monitoring required for this role."

**Wasima (HR):** "Thank you, Adam. And lastly, Evan."

**Evan:** "Good afternoon, everyone. My name is Evan Aubin Wibowo, majoring in Computer Science with a specialization in Digital Media. While my experience is primarily in creative video production and editing, I possess a strong computer science foundation. I have excellent structured communication skills, which I use to coordinate with multiple stakeholders under tight deadlines. I have an analytical mind and am comfortable with basic systems and Linux configurations. I am eager to transition my career back to a technical, support-oriented role like this."

**Aliv (Technical Lead):** "Thank you for the introductions. Now let's dive into the technical details.

Yudistira, your experience managing TicketOS is highly relevant. At Mindo, we frequently receive reactive reports from users. For example, a report stating that room rates on partner platforms (like Airbnb or Booking.com) are out of sync with our internal vacation rental system.
As someone accustomed to handling issue tickets, what would be your first systematic step to trace and find the root cause of this pricing synchronization bug?"

**Yudistira:** "Alright, Mr. Aliv. If I receive a report about pricing out of sync, my first step would be to replicate the scenario. I would check the raw data in our internal database to verify if the stored rates are correct. Next, I would perform API testing (for instance, using Postman or checking the API gateway logs) to inspect the payload request and response from the third-party integration.
I would analyze whether the failure occurred due to a tax/fee calculation formula error on our system side (PHP/backend) or a response error from the partner platform's API (such as token authentication issues or data schema changes). Once the root cause is found, I would document it structurally and write the fix specifications for the development team."

**Aliv (Technical Lead):** "Very structured and logical. Great.

Now, for Adam. In this role, we must proactively monitor data accuracy. You designed the relational database schema in TANAMI. If I ask you to write a SQL query to validate if there are any payment transactions where the total billed amount does not match the sum of its details (product price + tax + service fee), what SQL query logic would you create?"

**Adam:** "For that validation, I would use a query with aggregation functions and a `HAVING` clause. The logic would be to `SELECT` the Transaction ID and Total Billed from the master transaction table, then perform a `JOIN` with the transaction details table.
I would group the data by Transaction ID (`GROUP BY`) and sum up the product subtotal, tax, and service fee using the `SUM()` function. Finally, I would use `HAVING` to filter rows where the `Total Billed` in the master table does not equal the summed calculation from the details table. The rows returned by this query would represent the unsynced transactions that need investigation."

**Aliv (Technical Lead):** "Exactly. Your grasp of data relationships is quite strong.

Now to Evan. Your CV does not show practical experience with SQL databases or API testing, which are mandatory qualifications for us. As a computer science graduate, can you explain your theoretical understanding of what a REST API is and how data is transmitted through it?"

**Evan:** "Theoretically, a REST API is a communication bridge between different applications using standard HTTP protocols. Data is typically sent in JSON format because it is lightweight and easy for both humans and machines to read.
The transmission uses HTTP methods like GET to retrieve data, POST to send new data, PUT/PATCH to update it, and DELETE to remove it. Within the request, there are headers (usually containing authentication tokens) and a body that holds the actual data being sent. Although I haven't used this in my videography work, I understand it from an academic standpoint and am ready to apply it using Google Workspace or basic scripting."

**Aliv (Technical Lead):** "Okay, the conceptual explanation is clean, Evan."

**Wasima (HR):** "Mindo offers a hybrid work arrangement (a mix of WFH days and onsite days at our Yogyakarta office). We also provide free English courses for employees. Do you have any constraints with this hybrid setup, and what are your salary expectations?"

**Yudistira:** "The hybrid system is ideal for me because I can balance my physical presence at the Sleman office with my remaining studies. My salary expectation is IDR 5,000,000, which is in line with the average for entry-level Technical Analysts in Yogyakarta."

**Adam:** "I also have no issues with the hybrid setup. My expectation is IDR 4,500,000."

**Evan:** "The hybrid setup suits me perfectly. My expectation is IDR 5,000,000."

**Wasima (HR):** "Great, thank you all for your time and presentations this afternoon. We will discuss these evaluation results and get back to you shortly. Good afternoon."

### **[Session Ends]**

---

# 💬 Post-Interview Discussion (Interviewers Only)

**Wasima (HR):** "So, what did you think, Aliv? From a technical standpoint, did anyone stand out?"

**Aliv (Technical Lead):** "Honestly, Yudistira is the strongest and most ready. When I asked about tracing the out-of-sync pricing bug, his troubleshooting steps were very practical. He immediately knew to check database logs and perform API testing using Postman. Plus, his 1-year experience managing TicketOS during his internship gives him a solid understanding of ticketing support workflows."

**Wasima (HR):** "I agree. He was very tactical. But the main issue is that he is still an active student from the 2024 batch at Amikom. Although he says he can manage with evening or online classes, our Yogyakarta office requires regular hybrid presence. We must verify his class schedule first to ensure there are no major conflicts with our office hours."

**Aliv (Technical Lead):** "True, Was. We need to verify that. What about Adam?"

**Wasima (HR):** "Adam's English during the introduction was very impressive. His leadership as the founder of Tanami really showed. But technically, is he behind Yudistira?"

**Aliv (Technical Lead):** "Yes. He understands SQL logic—his HAVING and SUM explanation was spot on. But he lacks hands-on experience with ticketing support or commercial QA testing. He is better suited as a backup candidate, or perhaps geared towards a junior Product Management track."

**Wasima (HR):** "Alright, so Yudistira is our primary choice, and Adam is the backup. Now, regarding Evan... It's a bit of a shame. He has a CS degree, but his portfolio is entirely creative video production."

**Aliv (Technical Lead):** "Haha, yes. When I asked about REST APIs, his answer was purely academic, straight out of a textbook. I appreciate his honesty about not having practical SQL or API experience. Technically, he isn't ready for our sensitive vacation rental integration data."

**Wasima (HR):** "But his demeanor was calm, and his communication was highly structured. It's a waste to let him go completely. Maybe we can keep his CV on file for a Video Editor or entry-level manual QA tester role if a need arises in other projects."

**Aliv (Technical Lead):** "Agreed, Was. For now, let's proceed with Yudistira, provided he can prove his class schedule won't conflict with our hybrid work hours."

---

## 📊 Objective Assessment & Debrief / Evaluasi Objektif

### **Wasima's (HR) Perspective:**
*   **Location Fit:** Excellent. Since PT Mindo is based in Yogyakarta and offers a **hybrid** arrangement, all candidates can easily manage their work and remaining university schedules at Amikom Yogyakarta.
*   **English & Communication:** All three performed well. Yudistira showed high confidence, which is vital since this role coordinates directly with global vacation rental platforms and users.

### **Aliv's (Technical Lead) Perspective:**
*   **Yudistira (Strongest Match):** 100% fit for the role requirements. His 12-month experience maintaining **TicketOS** means he is already familiar with ticket handling, bug reproduction, and documentation. His SQL database and API integration skills are solid, and he has PHP experience (listed as a plus).
*   **Adam (Good Analytical Potential):** He answered the SQL aggregation and validation query logic flawlessly. He has a strong analytical mind, but lacks direct technical support/SaaS ticketing experience compared to Yudistira.
*   **Evan (Lack of Practical Tech Skills):** He understands the basic concepts of APIs and databases theoretically, but hiring him would require significant training to bring his SQL and tool usage to an operational level.

---

### **Final Verdict & Decision Matrix**

| Candidate | Tech Support / QA Experience | SQL & API Competency | Hybrid & Commitment Fit | Final Recommendation |
| :--- | :---: | :---: | :---: | :--- |
| **Yudistira Azfa** | **Excellent** <br> (1 year TicketOS management) | **Very Good** <br> (Laravel/React developer, REST API) | **High** <br> (Yogyakarta resident, student-friendly hybrid) | **Hire (Primary Choice)** <br> The perfect candidate for this role. He can start troubleshooting ticketing systems and validating data configurations with minimal onboarding. |
| **Muhammad Adam** | **Medium** <br> (PM/Startup context, no support experience) | **Very Good** <br> (Analytical SQL logic) | **High** <br> (Yogyakarta resident) | **Backup Candidate** <br> Consider if Yudistira declines the offer. He has high potential for data analysis and proactive monitoring. |
| **Evan Aubin** | **None** | **Low (Theoretical only)** | **High** <br> (Highly flexible schedule) | **Reject** <br> His practical skills remain too media-focused for a structured Technical Analyst role. |
