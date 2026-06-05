<!DOCTYPE html>
<html>

<head>
   <title>Laporan Penyewaan</title>

   <style>
      body { font-family: Arial, sans-serif; font-size: 12px; }
      .header { position: relative; margin-bottom: 15px; min-height: 50px; }
      .logo { position: absolute; top: 0; left: 0; width: 50px; }
      .kop { text-align: center; }
      .judul { font-size: 22px; font-weight: bold; }
      .alamat { font-size: 12px; margin-top: 3px; }
      .subjudul { font-size: 16px; font-weight: bold; }
      .periode { font-size: 11px; margin-top: 3px; }
      .garis { margin-top: 10px; border-top: 3px solid black; border-bottom: 1px solid black; height: 3px; }
      table { width: 100%; border-collapse: collapse; margin-top: 15px; }
      table, th, td { border: 1px solid black; }
      th { text-align: center; padding: 8px; }
      td { padding: 6px; vertical-align: middle; }
      .grand-total td { font-weight: bold; }
   </style>
</head>

<body>

   <div class="header">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTL1YGysP4CyXgjsHGhNvolLfAS0lwokvh-_Q&s" class="logo">
      <div class="kop">
         <div class="judul">SPICA RENTAL MOBIL</div>
         <div class="alamat">Jl. Contoh No.123 Pekanbaru</div>
      </div>
   </div>

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
