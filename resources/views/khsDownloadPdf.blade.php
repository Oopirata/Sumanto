<!DOCTYPE html>
<html>

<head>
    <title>KHS - Semester {{ $semester }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .student-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
        }

        .summary {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>KARTU HASIL STUDI (KHS)</h2>
        <h3>Semester {{ $semester }}</h3>
    </div>

    <div class="student-info">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 150px;">Nama</td>
                <td style="border: none;">: {{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td style="border: none;">NIM</td>
                <td style="border: none;">: {{ $mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td style="border: none;">Program Studi</td>
                <td style="border: none;">: {{ $mahasiswa->prodi }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khsData as $index => $khs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $khs->kode_mk }}</td>
                    <td>{{ $khs->nama_mk }}</td>
                    <td>{{ $khs->sks }}</td>
                    <td>{{ $khs->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total SKS:</strong> {{ $totalSks }}</p>
        <p><strong>IP Semester:</strong> {{ number_format($ips, 2) }}</p>
    </div>
</body>

</html>
