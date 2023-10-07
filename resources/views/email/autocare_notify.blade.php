<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengingat Masa Berlaku STNK</title>
    <style>
        body {
            background-color:#bdc3c7;
            margin:0;
        }
        .card {
            background-color:#fff;
            padding:20px;
            margin:20%;
            text-align:center;
            margin:0px auto;
            width: 580px; 
            max-width: 580px;
            margin-top:10%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .garis {
            width: 75%;
        }
        
    </style>
</head>
<body>
    <div class="card">
        <h3 class="">Kendaraan {{$nama_kendaraan}} dengan Nomor Polisi {{$nopol}} yang diinventariskan kepada {{$karyawan}}</h3>
        <h3 class="">Masa Berlaku STNK nya tinggal 3 hari lagi</h3>
        <hr class="garis">
        <p>Cek ke Sistem Management Aset untuk melihat detailnya</p>
        <h4>Terima kasih</h4>
    </div>
</body>
</html>