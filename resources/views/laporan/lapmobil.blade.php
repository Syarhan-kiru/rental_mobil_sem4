<!DOCTYPE html>
<html>

<head>
   <title>Laporan Mobil</title>

   <style>
      body {
         font-family: Arial, sans-serif;
         font-size: 12px;
         margin: 30px 40px;
      }

      .header {
         width: 100%;
         border-collapse: collapse;
         margin-bottom: 12px;
      }

      .header td {
         vertical-align: middle;
         border: none;
         padding: 0;
      }

      .header-logo {
         width: 120px;
         text-align: left;
      }

      .header-title {
         text-align: center;
      }

      .header-space {
         width: 120px;
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

      .laga {
         width: 90px;
         height: auto;
         display: block;
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
      .foto-mobil { width: 70px; height: 50px; object-fit: cover; }
   </style>

</head>

<body>

   <table class="header" style="border: none;">
      <tr>
         <td class="header-logo">
            <img src="{{ public_path('images/foto.jpg') }}" alt="logo" class="laga" />
         </td>
         <td class="header-title">
            <div class="judul">
               SPICA RENTAL MOBIL
            </div>

            <div class="alamat">
               Jl. Contoh No.123 Pekanbaru
            </div>
         </td>
         <td class="header-space"></td>
      </tr>
   </table>

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
               <td align="center">{{ $item->tahun }}</td>
               <td align="right">Rp {{ number_format($item->harga_sewa_sehari, 0, ',', '.') }}</td>
               <td align="center">
                  @php
                     $fotoPath = $item->foto ? storage_path('app/public/' . $item->foto) : null;
                  @endphp

                  @if($fotoPath && file_exists($fotoPath))
                     <img src="{{ $fotoPath }}" class="foto-mobil" alt="Foto Mobil">
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
