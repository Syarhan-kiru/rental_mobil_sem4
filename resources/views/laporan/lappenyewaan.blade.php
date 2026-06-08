<!DOCTYPE html>
<html>

<head>
   <title>Laporan Penyewaan</title>

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
      
   </style>
</head>

<body>

   <table class="header" style="border: none;">
      <tr>
         <td class="header-logo">
            <img src="{{ public_path('images/RENTAL-MOBIL.jpeg') }}" alt="logo" class="laga" />
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
   <div class="subjudul">LAPORAN TRANSAKSI PENYEWAAN</div>
   <div class="periode">Periode: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>

   <table>
      <thead>
         <tr>
            <th width="5%">No</th>
            <th width="10%">ID Penyewaan</th>
            <th width="13%">Pelanggan</th>
            <th width="15%">Mobil</th>
            <th width="12%">Tanggal Sewa</th>
            <th width="12%">Tanggal Kembali</th>
            <th width="13%">Total Harga</th>
            <th width="10%">Status</th>
         </tr>
      </thead>

      <tbody>
         @php $grandTotal = 0; @endphp
         @foreach($penyewaan as $item)
         @php $grandTotal += $item->total_harga; @endphp
         <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->id_penyewaan }}</td>
            <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
            <td>{{ $item->mobil->merek ?? '-' }} {{ $item->mobil->tipe ?? '' }}</td>
            <td align="center">{{ $item->tanggal_sewa }}</td>
            <td align="center">{{ $item->tanggal_kembali }}</td>
            <td align="right">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            <td align="center">{{ $item->status }}</td>
         </tr>
         @endforeach

         <tr class="grand-total">
            <td colspan="6" align="right"><strong>GRAND TOTAL PENDAPATAN:</strong></td>
            <td align="right"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            <td></td>
         </tr>
      </tbody>
   </table>

</body>
</html>
