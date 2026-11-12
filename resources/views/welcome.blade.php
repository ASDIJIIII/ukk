<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Peminjaman Alat</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Jumlah</th>
            <th>Tgl Pinjam</th>
            <th>Status</th>
            <th>Denda</th>
        </tr>
        @foreach ($loans as $loan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $loan->user->name }}</td>
            <td>{{ $loan->tool->name }}</td>
            <td>{{ $loan->qty }}</td>
            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
            <td>{{ $loan->status }}</td>
            <td>Rp {{ number_format($loan->fine) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>