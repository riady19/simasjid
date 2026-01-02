<!DOCTYPE html>
<html>
<head>
    <title>Laporan Zakat</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            background-color: #e9ecef;
            padding: 5px;
        }
        .total {
            font-weight: bold;
            text-align: right;
            background-color: #f8f9fa;
        }
        .text-right {
            text-align: right;
        }
        .grand-total {
            font-size: 14px;
            font-weight: bold;
            background-color: #d1e7dd;
        }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%; border: none; margin-bottom: 10px;">
            <tr>
                <td style="width: 100px; text-align: center; border: none; vertical-align: middle;">
                    <img src="{{ public_path('images/logo_masjid.jpg') }}" style="width: 80px; height: auto;">
                </td>
                <td style="text-align: center; border: none; vertical-align: middle;">
                    <h1 style="margin: 0; font-size: 24px; font-weight: bold; text-transform: uppercase;">Masjid Baitul 'Amal</h1>
                    <p style="margin: 5px 0 0; font-size: 12px;">Jln. Telaga Harapan, Kel. Sei Lakam Barat, Kec. Karimun. Kab. Karimun - Kepri</p>
                </td>
            </tr>
        </table>
        <hr style="border: 2px solid #000; margin-bottom: 2px;">
        <hr style="border: 1px solid #000; margin-top: 0; margin-bottom: 20px;">
        
        <h3 style="margin-bottom: 5px;">LAPORAN ZAKAT</h3>
        <p style="font-size: 12px; margin-top: 0;">Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <!-- ZAKAT FITRAH -->
    <div class="section-title">I. ZAKAT FITRAH</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Muzakki</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zakatFitrah as $zakat)
            <tr>
                <td>{{ \Carbon\Carbon::parse($zakat->date)->format('d/m/Y') }}</td>
                <td>{{ $zakat->payer_name }}</td>
                <td class="text-right">Rp {{ number_format($zakat->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Zakat Fitrah</td>
                <td class="total">Rp {{ number_format($zakatFitrah->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ZAKAT MAAL -->
    <div class="section-title">II. ZAKAT MAAL</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Muzakki</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zakatMaal as $zakat)
            <tr>
                <td>{{ \Carbon\Carbon::parse($zakat->date)->format('d/m/Y') }}</td>
                <td>{{ $zakat->payer_name }}</td>
                <td class="text-right">Rp {{ number_format($zakat->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Zakat Maal</td>
                <td class="total">Rp {{ number_format($zakatMaal->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="section-title" style="margin-top: 20px;">RINGKASAN PENERIMAAN ZAKAT</div>
    <table>
        <tr>
            <td>Total Zakat Fitrah</td>
            <td class="text-right">Rp {{ number_format($zakatFitrah->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Zakat Maal</td>
            <td class="text-right">Rp {{ number_format($zakatMaal->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr class="grand-total">
            <td>TOTAL PENERIMAAN ZAKAT</td>
            <td class="text-right">Rp {{ number_format($zakatFitrah->sum('amount') + $zakatMaal->sum('amount'), 0, ',', '.') }}</td>
        </tr>
    </table>
</body>
</html>
