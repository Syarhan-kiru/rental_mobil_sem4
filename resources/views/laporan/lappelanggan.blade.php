<!DOCTYPE html>
<html>

<head>
   <title>Laporan Pelanggan</title>

   <style>
      body { font-family: Arial, sans-serif; font-size: 12px; }
      .header { position: relative; margin-bottom: 15px; min-height: 50px; }
      .logo { position: absolute; top: 0; left: 0; width: 50px; }
      .kop { text-align: center; }
      .judul { font-size: 22px; font-weight: bold; }
      .alamat { font-size: 12px; margin-top: 3px; }
      .subjudul { font-size: 16px; font-weight: bold; }
      .garis { margin-top: 10px; border-top: 3px solid black; border-bottom: 1px solid black; height: 3px; }
      table { width: 100%; border-collapse: collapse; margin-top: 15px; }
      table, th, td { border: 1px solid black; }
      th { text-align: center; padding: 8px; }
      td { padding: 6px; vertical-align: middle; }
   </style>

</head>

<body>

   <div class="header">
      <img src="{{ public_path('images/logo-unri.png') }}" class="logo">

      <div class="kop">
         <div class="judul">SPICA RENTAL MOBIL</div>
         <div class="alamat">Jl. Contoh No.123 Pekanbaru</div>
      </div>
   </div>

   <div class="garis"></div>
   <div class="subjudul">LAPORAN DATA PELANGGAN</div>

   <table>
      <thead>
         <tr>
            <th width="5%">No</th>
            <th width="15%">ID Pelanggan</th>
            <th width="23%">Nama Pelanggan</th>
            <th width="18%">NIK</th>
            <th width="16%">No HP</th>
            <th width="23%">Alamat</th>
         </tr>
      </thead>

      <tbody>
         @foreach($pelanggan as $item)
         <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->id_pelanggan }}</td>
            <td>{{ $item->nama_pelanggan }}</td>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->no_hp }}</td>
            <td>{{ $item->alamat }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>

</body>
</html>
