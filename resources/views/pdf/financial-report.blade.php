<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
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
        
        <h3 style="margin-bottom: 5px;">LAPORAN KEUANGAN</h3>
        <p style="font-size: 12px; margin-top: 0;">Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <!-- OPERATIONAL SECTION -->
    <div class="section-title">I. KAS OPERASIONAL MASJID</div>

    <!-- Operational Income -->
    <div style="margin-left: 10px; font-weight: bold; margin-top: 10px;">A. Pemasukan Operasional</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operationalIncomes as $income)
            <tr>
                <td>{{ \Carbon\Carbon::parse($income->date)->format('d/m/Y') }}</td>
                <td>{{ $income->description }}</td>
                <td class="text-right">Rp {{ number_format($income->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Pemasukan Operasional</td>
                <td class="total">Rp {{ number_format($operationalIncomes->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Friday Infaq -->
    <div style="margin-left: 10px; font-weight: bold; margin-top: 10px;">B. Infaq Jumat</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fridayInfaqs as $infaq)
            <tr>
                <td>{{ \Carbon\Carbon::parse($infaq->date)->format('d/m/Y') }}</td>
                <td>{{ $infaq->description ?? 'Infaq Jumat' }}</td>
                <td class="text-right">Rp {{ number_format($infaq->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Infaq Jumat</td>
                <td class="total">Rp {{ number_format($fridayInfaqs->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Operational Expense -->
    <div style="margin-left: 10px; font-weight: bold; margin-top: 10px;">C. Pengeluaran Operasional</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operationalExpenses as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                <td>{{ $expense->description }}</td>
                <td class="text-right">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Pengeluaran Operasional</td>
                <td class="total">Rp {{ number_format($operationalExpenses->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ORPHAN SECTION -->
    <div class="section-title" style="margin-top: 20px;">II. KAS ANAK YATIM & PIATU</div>

    <!-- Orphan Income -->
    <div style="margin-left: 10px; font-weight: bold; margin-top: 10px;">A. Pemasukan (Infaq Anak Yatim & Piatu)</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orphanIncomes as $income)
            <tr>
                <td>{{ \Carbon\Carbon::parse($income->date)->format('d/m/Y') }}</td>
                <td>{{ $income->description }}</td>
                <td class="text-right">Rp {{ number_format($income->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Pemasukan Yatim</td>
                <td class="total">Rp {{ number_format($orphanIncomes->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Orphan Expense -->
    <div style="margin-left: 10px; font-weight: bold; margin-top: 10px;">B. Pengeluaran (Santunan/Lainnya)</div>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orphanExpenses as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                <td>{{ $expense->description }}</td>
                <td class="text-right">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Pengeluaran Yatim</td>
                <td class="total">Rp {{ number_format($orphanExpenses->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="section-title" style="margin-top: 20px;">RINGKASAN SALDO</div>
    <table>
        <!-- Operational Summary -->
        <tr>
            <td colspan="2" style="background-color: #f2f2f2; font-weight: bold;">Kas Operasional</td>
        </tr>
        <tr>
            <td>Total Pemasukan Operasional + Infaq Jumat</td>
            <td class="text-right">Rp {{ number_format($operationalIncomes->sum('amount') + $fridayInfaqs->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Pengeluaran Operasional</td>
            <td class="text-right">Rp {{ number_format($operationalExpenses->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="total">Saldo Kas Operasional</td>
            <td class="total">Rp {{ number_format(($operationalIncomes->sum('amount') + $fridayInfaqs->sum('amount')) - $operationalExpenses->sum('amount'), 0, ',', '.') }}</td>
        </tr>

        <!-- Orphan Summary -->
        <tr>
            <td colspan="2" style="background-color: #f2f2f2; font-weight: bold;">Kas Anak Yatim & Piatu</td>
        </tr>
        <tr>
            <td>Total Pemasukan Yatim</td>
            <td class="text-right">Rp {{ number_format($orphanIncomes->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Pengeluaran Yatim</td>
            <td class="text-right">Rp {{ number_format($orphanExpenses->sum('amount'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="total">Saldo Kas Yatim</td>
            <td class="total">Rp {{ number_format($orphanIncomes->sum('amount') - $orphanExpenses->sum('amount'), 0, ',', '.') }}</td>
        </tr>

        <!-- Grand Total -->
        <tr class="grand-total">
            <td>TOTAL SALDO KESELURUHAN</td>
            <td class="text-right">Rp {{ number_format(
                ($operationalIncomes->sum('amount') + $fridayInfaqs->sum('amount') - $operationalExpenses->sum('amount')) +
                ($orphanIncomes->sum('amount') - $orphanExpenses->sum('amount')), 
                0, ',', '.') }}
            </td>
        </tr>
    </table>
</body>
</html>
