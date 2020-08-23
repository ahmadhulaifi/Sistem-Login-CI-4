# Sistem-Login-CI-4

Ini adalah Repository tentang sistem login menggunakan framework Codeigniter 4 yang mana didalamnya terdapat sistem registrasi, login, menu management, role Akses

# Konfigurasi Awal

1. silahkan pindahkan folder kalian di localhost atau hosting
2. Silahkan import file sql yang ada didalam folder database ke phpmyadmin atau program dbms lainnya
3. Untuk kofigurasinya dalam codeigniter 4 silahkan buka file .env yang ada didalam folder core_loginci4
4. Ubah app.baseURL sesuai dengan tempat public kalian
5. Setting juga database dengan username dan password yang kalian gunakan di localhost atau hosting kalian
6. Jika ingin mendevelop program ini bisa ubah CI_ENVIRONMENT di dalam folder env untuk melihat jika ada kesalahan error

# Hal yang diperhatikan

1. di program ini sudah ditambahkan file filter didalam folder app/Filters/LoginFilter untuk security tidak bisa masuk jika belum login dan juga membatasi akses untuk role akses membernya. Jika tidak ingin digunakan bisa hapus filenya dan hapus juga aturan di route dengan filter ceklogindulu
2. Dalam database user is_active 0 artinya belum aktif dan 1 sudah aktif berfungsi jika teman-teman ingin menambahkan registrasi dengan verifikasi email
