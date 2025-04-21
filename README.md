# Blog Dinamis

Sebuah aplikasi blog web dinamis yang dibangun dengan PHP dan MySQL. Blog ini memungkinkan pengguna untuk mendaftar, masuk, dan membuat artikel dengan kategori dan penulis yang berbeda.

## Fitur

- Sistem autentikasi pengguna (registrasi, login, logout)
- Manajemen artikel (tambah, lihat)
- Dukungan untuk multi-penulis
- Kategorisasi artikel
- Tampilan artikel dengan gambar
- Halaman detail artikel

## Kebutuhan Sistem

- PHP 7.0 atau lebih tinggi
- MySQL 5.6 atau lebih tinggi
- Web server (Apache/Nginx)

## Instalasi

1. Clone repositori ini
   ```
   git clone https://github.com/username/blog-dinamis.git
   ```

2. Pindah ke direktori proyek
   ```
   cd blog-dinamis
   ```

3. Buat database di MySQL dengan nama `blog_dinamis`

4. Import struktur database dari file SQL yang disediakan
   ```
   mysql -u username -p blog_dinamis < database/blog_dinamis.sql
   ```

5. Konfigurasi koneksi database
   - Buka file `db_connect.php`
   - Sesuaikan parameter koneksi (host, username, password, nama database)

6. Konfigurasi web server Anda untuk mengarahkan ke direktori proyek

## Struktur Database

Database menggunakan beberapa tabel utama:
- `article`: Menyimpan data artikel (judul, konten, excerpt, tanggal publikasi, dll)
- `author`: Menyimpan data penulis
- `category`: Menyimpan kategori artikel
- `article_author`: Tabel relasi antara artikel dan penulis
- `article_category`: Tabel relasi antara artikel dan kategori
- `users`: Menyimpan data pengguna untuk autentikasi

## Struktur Direktori

```
├── index.php                # Halaman utama yang menampilkan daftar artikel
├── article.php              # Halaman detail artikel
├── add_article.php          # Form untuk menambah artikel
├── login.php                # Halaman login
├── register.php             # Halaman registrasi
├── logout.php               # Script untuk logout
├── db_connect.php           # Koneksi database
├── styles/                  # Folder CSS
│   └── index.css            # Style utama
├── images/                  # Folder untuk gambar artikel
└── README.md                # File dokumentasi ini
```

## Penggunaan

1. Buka browser dan akses alamat web Anda (contoh: http://localhost/blog-dinamis)
2. Register untuk membuat akun baru
3. Login dengan akun yang telah dibuat
4. Setelah login, Anda bisa menambahkan artikel baru melalui menu "Tambah Artikel"
5. Artikel yang dipublikasikan akan muncul di halaman utama

## Fitur yang Akan Datang

- Fitur pencarian artikel
- Komentar pada artikel
- Panel admin untuk mengelola artikel, kategori, dan pengguna
- Sistem tagging untuk artikel
- Pagination untuk daftar artikel
- WYSIWYG editor untuk konten artikel

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini:

1. Fork repositori ini
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

Proyek ini dilisensikan di bawah [MIT License]

## Pembuat

Nanda Aulia 230605110014 - [nandaaulia1004@gmail.com] - [(https://github.com/n2nd22uli2)]
Pemrograman Web (A)
