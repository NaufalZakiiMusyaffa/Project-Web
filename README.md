Note :

Tambahan :
1. Di Menu Pengajuan Perbaikan :
- Untuk Akses IT : 1.Ketika sudah di Acc oleh Manager terkait pengajuannya, disitu ada aksi Print, buat fungsi itu berfungsi dengan layout output hasil seperti sebelumnya Portrait.

2. Setiap akses menu data pengguna, menu profile ikut terbuka(Opsional)
3. Setiap akses menu aset autocare, menu data IT ikut terbuka(Opsional)

<strike>4. All fitur Filter yang ada di sistem tidak jalan</strike>
<strike>5. Setiap field Cari yang ada di Form Sistem Management Aset, ketika dipilih datanya popupnya tidak tertutup otomatis.</strike>
6. All Form yang ada field Gambar, ketika klik edit, foto gambar tidak terpanggil.
7. Footer letaknya dibuat tetap ukurannya seperti di Tampilan Beranda.

<strike>8. All fitur print PDF & Excel di cek ulang kembali semuanya dan dipastikan semuanya harus berjalan seperti sebelumnya</strike>



Kata Kata untuk Notifikasi :
        Untuk Notifikasi Email (Autocare)
        <h3 class="">Kendaraan {{$nama_kendaraan}} dengan Nomor Polisi {{$nopol}} yang diinventariskan kepada {{$karyawan}}</h3>
        <h3 class="">Masa Berlaku STNK tinggal 3 hari lagi</h3>
        <hr class="garis">
        <p>Lihat ke Sistem Management Aset untuk melihat detailnya</p>
        <h4>Terima kasih</h4>

        Untuk Notifikasi WA (Perbaikan Aset IT)
        $data = [
                'target' => $akun->karyawan->telepon,
                'message' => "".Auth::user()->karyawan->nama." Telah mengajukan perbaikan aset IT, Cek ke Sistem Management Aset untuk melihat detail pengajuannya"
            ];


        Untuk Notifikasi WA (Autocare)
        $data = [
                        'target' => $akun->karyawan->telepon,
                        'message' => "Kendaraan $asetac->nama_kendaraan dengan Nomor Polisi $asetac->nopol yang diinventariskan kepada ".$asetac->karyawan->nama." Masa Berlaku STNK tinggal 3 hari lagi"
                    ];
