<!DOCTYPE html>
<html>
<head>
    <title>IRS {{ $mahasiswa->nama }} - Semester {{ $semester }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
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
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .semester-header {
            background-color: #e9ecef;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .total-sks {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>ISIAN RENCANA STUDI (IRS)</h2>
        <h3>Semester {{ $semester }}</h3>
    </div>

    <div class="student-info">
        <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
        <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
        <p><strong>Program Studi:</strong> {{ $mahasiswa->prodi }}</p>
        <p><strong>Fakultas:</strong> {{ $mahasiswa->fakultas }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>SKS</th>
                <th>Ruang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($irsData as $index => $mk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama_mk }}</td>
                    <td>{{ $mk->kelas }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->ruang }}</td>
                    <td>{{ $mk->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total-sks">
        <strong>Total SKS: {{ $totalSks }}</strong>
    </div>
</body>
</html>