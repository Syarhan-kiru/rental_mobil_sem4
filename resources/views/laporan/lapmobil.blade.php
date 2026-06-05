<!DOCTYPE html>
<html>

<head>
   <title>Laporan Mobil</title>

   <style>
      body {
         font-family: Arial, sans-serif;
         font-size: 12px;
      }

      .header {
         position: relative;
         margin-bottom: 15px;
         min-height: 50px;
      }

      .logo {
         position: absolute;
         top: 0;
         left: 0;
         width: 50px;
      }

      .kop {
         text-align: center;
      }

      .judul {
         font-size: 22px;
         font-weight: bold;
      }

      .alamat {
         font-size: 12px;
         margin-top: 3px;
      }

      .subjudul {
         font-size: 16px;
         font-weight: bold;
      }

      .garis {
         margin-top: 10px;
         border-top: 3px solid black;
         border-bottom: 1px solid black;
         height: 3px;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 15px;
      }

      table,
      th,
      td {
         border: 1px solid black;
      }

      th {
         text-align: center;
         padding: 8px;
      }

      td {
         padding: 6px; vertical-align: middle;
      }
      .foto-mobil { width: 80px; height: 60px; object-fit: cover; }
   </style>

</head>

<body>

   <div class="header">

      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL1YGysP4CyXgjsHGhNvolLfAS0lwokvh-_Q&s"
         class="logo">

      <div class="kop">
         <div class="judul">
            SPICA RENTAL MOBIL
         </div>

         <div class="alamat">
            Jl. Contoh No.123 Pekanbaru
         </div>
      </div>

   </div>

   <div class="garis"></div>
   <div class="subjudul">
      LAPORAN DATA MOBIL
   </div>
   <table>
      <thead>
         <tr>
            <th width="5%">No</th>
            <th width="12%">Plat Nomor</th>
            <th width="12%">Merek</th>
            <th width="12%">Tipe</th>
            <th width="8%">Tahun</th>
            <th width="15%">Harga Sewa/Hari</th>
            <th width="15%">Foto</th>
            <th width="13%">Status</th>
         </tr>
      </thead>

      <tbody>
         @foreach($mobil as $item)
         <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $item->plat_nomor }}</td>
             <td>{{ $item->merek }}</td>
            <td align="center">{{ $item->tipe }}</td>
            <td align="center">{{ $item->tahun }}</td>
            <td align="right">Rp {{ number_format($item->harga_sewa_sehari, 0, ',', '.') }}</td>
            <td align="center">
                @if($item->foto)
                    <img src="{{ storage_path('app/public/' . $item->foto) }}" class="foto-mobil">
                @else
                  -
               @endif
            </td>
            <td align="center">{{ $item->status }}</td>

         </tr>
         @endforeach
      </tbody>
   </table>

</body>
</html>
