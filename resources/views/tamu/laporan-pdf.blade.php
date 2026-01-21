<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Tamu | E-Guestbook</title>
    <style>
        /* Menggunakan font sans-serif standar PDF agar ringan dan bersih */
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px; 
            color: #333;
            line-height: 1.4;
        }
        
        /* Pengaturan Header Laporan */
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid #f89494;
            padding-bottom: 10px;
        }
        .header h2 { 
            margin: 0; 
            color: #f08080; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p { 
            margin: 5px 0 0; 
            font-size: 12px; 
            color: #666; 
        }

        /* Pengaturan Tabel */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            table-layout: fixed; /* Mengunci lebar tabel agar tidak melewati kertas */
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
            word-wrap: break-word; /* Memotong kata yang terlalu panjang agar ganti baris */
        }
        
        /* Gaya Header Tabel */
        th { 
            background-color: #f89494; 
            color: white; 
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Baris Selang-Seling (Zebra Strip) */
        tr:nth-child(even) { 
            background-color: #fff5f5; 
        }

        /* Penyesuaian Lebar Kolom Spesifik */
        .col-no { width: 30px; text-align: center; }
        .col-tgl { width: 80px; }
        .col-jk { width: 70px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Tamu E-Guestbook</h2>
        <p>Dicetak pada Tanggal: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th>Nama</th>
                <th class="col-jk">Jenis Kelamin</th>
                <th>No. Telp</th>
                <th>Ruangan</th>
                <th>Keperluan</th>
                <th class="col-tgl">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tamus as $key => $t)
            <tr>
                <td class="col-no">{{ $key + 1 }}</td>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->jenis_kelamin ?? '-' }}</td>
                <td>{{ $t->no_telp ?? '-' }}</td>
                <td>{{ $t->ruangan->nama_ruangan ?? '-' }}</td>
                <td>{{ $t->pesan }}</td>
                <td class="col-tgl">{{ $t->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>