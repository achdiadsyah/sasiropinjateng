<html>
<head>
    <title>Export Data</title>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                XLSX.writeFile(wb, fn || ('Data.' + (type || 'xlsx')));
        }
    </script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body onload="ExportToExcel('xlsx')">

<table style="width:100%;" id="tbl_exporttable_to_xls">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor STR</th>
            <th>Nomor Handphone</th>
            <th>Asal PENGDA</th>
            <th>Asal PENGCAP</th>
            <th>Jenis Seminar</th>
            <th>Hari Seminar</th>
            <th>Kode Unik</th>
            <th>Nominal + Kode Unik</th>
            <th>Status Verifikasi Pembayaran</th>
            <th>Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        @foreach ($users as $item)
            @php
                $hari = substr($item->hari_seminar,0,1);
                $biaya = '300000' * $hari + $item->kode_unik;
            @endphp
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->nomor_str}}</td>
                <td>{{$item->no_handphone}}</td>
                <td>{{$item->province->name}}</td>
                <td>{{$item->regencie ? $item->regencie->name : '-'}}</td>
                <td>{{strtoupper($item->jenis_seminar)}}</td>
                <td>{{$item->hari_seminar}}</td>
                <td>{{$item->kode_unik}}</td>
                <td>Rp. {{number_format($biaya)}}</td>
                @if($item->is_verified == 1)
                <td>SUDAH BAYAR</td>
                @else
                <td>BELUM</td>
                @endif
                <td>{{date('d-m-Y', strtotime($item->created_at));}}</td>
            </tr>
            <?php $i++ ?>
        @endforeach
    </tbody>
</table>
</body>
</html>