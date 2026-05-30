# M-Tugas — Aplikasi Manajemen Tugas Sederhana

M-Tugas adalah aplikasi manajemen tugas berbasis web yang dirancang untuk mendistribusikan, memantau, dan mengelola pekerjaan karyawan secara terstruktur dan transparan. Aplikasi ini dibangun menggunakan **Laravel 13** dengan frontend yang terintegrasi secara modular menggunakan template **SB Admin 2**.

---

## 📸 Dokumentasi & Screenshot

<details>
  <summary><b>Klik untuk melihat Galeri Screenshot Aplikasi</b></summary>
  <br>
  
  <table width="100%">
    <tr>
      <td width="50%" align="center"><b>Landing Page</b><br><br><img src="https://github.com/user-attachments/assets/c12ef3b1-f87b-4080-b7be-7a1c4b00fdf7" width="100%" /></td>
      <td width="50%" align="center"><b>Login Page</b><br><br><img src="https://github.com/user-attachments/assets/7d4a32d8-8508-4eec-bdf0-de57a187a1bb" width="100%" /></td>
    </tr>
    <tr>
      <td align="center"><br><b>Dashboard Admin</b><br><br><img src="https://github.com/user-attachments/assets/42d39e0c-694c-41bd-8faf-0a30c2c09e0b" width="100%" /></td>
      <td align="center"><br><b>Edit Password Admin</b><br><br><img src="https://github.com/user-attachments/assets/34d7577e-ea54-401d-a88e-56163a42cece" width="100%" /></td>
    </tr>
    <tr>
      <td align="center"><br><b>Kelola Data User</b><br><br><img src="https://github.com/user-attachments/assets/57c7ffa4-0e8c-47da-b57a-7a25604542c5" width="100%" /></td>
      <td align="center"><br><b>Kelola Data Tugas</b><br><br><img src="https://github.com/user-attachments/assets/eb4c4e09-8bde-41e2-8f06-20098bbbc41f" width="100%" /></td>
    </tr>
    <tr>
      <td align="center"><br><b>Dashboard Karyawan</b><br><br><img src="https://github.com/user-attachments/assets/e189d43e-2818-4e44-b43b-669b1c1e0f64" width="100%" /></td>
      <td align="center"><br><b>Halaman Data Tugas Karyawan</b><br><br><img src="https://github.com/user-attachments/assets/5983ecc6-0b7d-4e84-941c-10e7541b3ba8" width="100%" /></td>
    </tr>
  </table>
</details>

---

## 🚀 Fitur Utama

### 🌐 Landing Page (Umum)
*   **Beranda**: Tampilan antarmuka yang bersih dan interaktif dilengkapi tombol pintas login atau dashboard jika sesi aktif terdeteksi.
*   **Tentang Kami**: Penjelasan singkat mengenai sistem, fungsi, dan poin keunggulan aplikasi.
*   **Kontak**: Informasi kontak statis (alamat, WhatsApp, email, dan Google Maps).

### 🔑 Autentikasi & Sesi
*   Sistem login & logout dengan validasi form yang aman.
*   Menggunakan session-based authentication berbasis file (`SESSION_DRIVER=file`) untuk manajemen sesi mandiri yang ringan dan andal.

### 👤 Modul Admin
*   **Dashboard**: Statistik total user, total admin, total karyawan, serta jumlah karyawan berstatus "Ditugaskan" dan "Belum Ditugaskan".
*   **Kelola Data User (CRUD)**:
    *   Pengelolaan data pengguna (nama, email, jabatan, status, password).
    *   Integrasi pencarian & penomoran halaman menggunakan **DataTables**.
    *   Ekspor data ke format **Excel** dan **PDF** dengan desain kustom yang rapi.
    *   Popup konfirmasi penghapusan data kustom interaktif.
    *   Pengalihan halaman (bukan modal) untuk form tambah dan ubah data.
*   **Kelola Data Tugas (CRUD)**:
    *   Penugasan tugas baru kepada karyawan.
    *   Perubahan status otomatis karyawan secara real-time (*belum ditugaskan* $\leftrightarrow$ *ditugaskan*).
    *   Popup modal informasi detail tugas.
    *   Ekspor data tugas ke format **Excel** dan **PDF**.
*   **Edit Password**: Halaman ganti password dengan validasi verifikasi kecocokan password lama.

### 💼 Modul Karyawan
*   **Dashboard**: Menampilkan informasi ringkasan status tugas pribadi (apakah sudah ditugaskan atau belum).
*   **Data Tugas**:
    *   Detail tugas yang sedang dikerjakan (nama, email, deskripsi tugas, tanggal mulai, dan tanggal selesai).
    *   Cetak tugas pribadi langsung ke format **PDF** sesuai template resmi.

---

## 🛠️ Spesifikasi Teknologi
*   **Framework Backend**: Laravel 13 (PHP 8.2+)
*   **Framework CSS**: Bootstrap 4.6 (SB Admin 2)
*   **Libraries**:
    *   `barryvdh/laravel-dompdf` (Ekspor PDF)
    *   `maatwebsite/excel` / `PhpSpreadsheet` (Ekspor Excel)
    *   `DataTables` & `jQuery` (Interaktivitas tabel)
    *   `Font Awesome` (Icons)

---

## ⚙️ Langkah Pemasangan & Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/FrankStein31/Aplikasi-Manajemen-Tugas-Sederhana.git
    cd Aplikasi-Manajemen-Tugas-Sederhana
    ```

2.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Salin dan Sesuaikan Environment**
    Salin file `.env.example` ke `.env`:
    ```bash
    cp .env.example .env
    ```
    Buka `.env` dan konfigurasikan koneksi database Anda:
    ```env
    APP_NAME=M-Tugas
    APP_URL=http://127.0.0.1:8000

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    
    SESSION_DRIVER=file
    ```

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi & Database Seeder**
    Jalankan perintah ini untuk membuat tabel database beserta data akun demo bawaan:
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```
    Aplikasi dapat diakses di browser melalui tautan `http://127.0.0.1:8000`.

---

## 🔑 Akun Demo Pengujian
Gunakan kredensial berikut untuk melakukan login pengujian:

*   **Akun Admin**:
    *   **Email**: `admin@gmail.com`
    *   **Password**: `password`
*   **Akun Karyawan**:
    *   **Email**: `karyawan@gmail.com`
    *   **Password**: `password`

---

## 📂 Struktur Direktori Utama View
Struktur view Blade yang terorganisir dengan rapi dan modular:
```text
resources/views/
├── admin/
│   ├── dashboard/
│   ├── profile/
│   ├── tugas/
│   └── user/
├── karyawan/
│   ├── dashboard/
│   └── tugas/
├── auth/
├── landing/
└── layouts/
    ├── admin/
    └── karyawan/
```

---
*M-Tugas — Dikembangkan untuk memenuhi kebutuhan manajemen tugas internal secara andal.*
