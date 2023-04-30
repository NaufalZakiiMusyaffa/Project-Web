Note :

1. <strike>Base awal All Migrations bisa termigrasi ke basis data</strike>
2. <strike>Perubahan nama role dari hrd menjadi manager</strike>
3. <strike>Penambahan role autocare</strike>
2. <strike>Notifikasi Pengajuan Masuk (Role: Hrd) + notifikasi muncul juga di Gmail</strike>
3. <strike>Notifikasi Pengingat masa berlaku STNK (Trigger muncul H-3 sebelum habis) (Role : autocare)</strike>
4. <strike>Filter Aset ( dibagian fitur JEJAK ASET IT)
   - filter yang sama (namanya) cuman ingin muncul hanya 1 saja</strike>
5. <strike>  - Nama Field jumlah_aset (Ditabel Aset IT) dirubah menjadi status_aset & typenya enum
   - status_kendaraan (ditabel Asetac) type datanya dirubah menjadi enum
   - status_supir (ditabel supir) type datanya dirubah menjadi enum </strike>

5. Halaman Beranda yang diubah tampilan UI :
   1. Pemeliharaan (dibuat grafik & diambil variabelnya berdasarkan bulan)
   2. Karyawan (dibuat agar muncul total karyawannya + perbandingan karyawan laki laki berapa
      dan perempuan berapa)
   3. Sisanya ditambahkan kotak seperti di login (isiannya berupa gambar yang relevan terkait informasinya)

6. Laporan :
   1)<strike> Laporan Data Aset IT(dimunculkan terlebih dahulu di table, terdapat filter export per bulan) sediakan versi pdf dan excel</strike>
   2)<strike> Laporan Data Jejak Aset IT(dimunculkan terlebih dahulu di table, terdapat filter export per nama aset) sediakan versi pdf dan excel</strike>
   3)<strike> Laporan Data Peminjaman Aset IT (dimunculkan terlebih dahulu di table, terdapat filter export per tanggal atau perhari) sediakan versi pdf dan excel</strike>
   4)<strike> Laporan Data Pengembalian Aset IT (dimunculkan terlebih dahulu di table, terdapat filter export per tanggal atau perhari) sediakan versi pdf dan excel</strike>
   5)<strike> Laporan Data Karyawan (dimunculkan terlebih dahulu di table, terdapat filter export all)</strike>
   6)<strike> Laporan Data Aset Autocare (dimunculkan terlebih dahulu di table, terdapat filter export all)</strike>
   7)<strike> Laporan Data Peminjaman Aset Autocare (dimunculkan terlebih dahulu di table, terdapat filter export per tanggal atau perhari) sediakan versi pdf dan excel</strike>
   8)<strike> Laporan Data Pengembalian Aset Autocare (dimunculkan terlebih dahulu di table, terdapat filter export per tanggal atau perhari) sediakan versi pdf dan excel</strike>

--------------------------------------------------------------------------------------------------------------------------------------------------------------------

After Google Meet

Catatan:
-> Output Export untuk Data Pengguna & Data Karyawan berbentuk Portrait, sisanya berbentuk Landscape
-> UI untuk laporan pdf dan excelnya (Menunggu Mockup dikirimkan), untuk file referensi UI nya sudah diupload digithub 
-> Output Export untuk tanggal harus lengkap contoh : 20 April 2023, jangan seperti ini 20-04-23
-> Filter Table seperti pada jejak Aset IT, ini harus ada di fitur peminjaman Aset IT & Autocare, filternya itu ada 2: Sedang dipinjam, Sudah Kembali
-> Untuk Data Aset IT:
   1)<strike> Ouput pada saat Export Tabel atau Excel, Field Jumlah Aset dirubah menjadi Status Aset</strike>
   2) Penambahan Filter Data Aset IT, filternya itu : Siap Digunakan, Digunakan, Rusak (Bisa diperbaiki), Rusak Total. (Setiap Filter Data Aset IT setelah datanya      muncul ditabel harus bisa diexport sama seperti di filter jejak aset IT)
-> Untuk Data Aset Autocare:
   1) Ouput pada saat Export Tabel atau Excel, Field Status Kendaraan dihilangkan.

-> Penambahan Filter di Peminjaman Aset IT dan Peminjaman Aset Autocare, Filternya : Sedang dipinjam dan Sudah Kembali
-><strike> Tiap Form inputan (Tambah data * Update Data) UInya Responsive</strike>
