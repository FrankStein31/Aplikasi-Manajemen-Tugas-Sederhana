# M-Tugas — Aplikasi Manajemen Tugas Sederhana

M-Tugas adalah aplikasi manajemen tugas berbasis web yang dirancang untuk mendistribusikan, memantau, dan mengelola pekerjaan karyawan secara terstruktur dan transparan. Aplikasi ini dibangun menggunakan **Laravel 13** dengan frontend yang terintegrasi secara modular menggunakan template **SB Admin 2**.

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
