<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .resume {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Data Kendaraan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>No Plat</th>
                <th>Ganjil</th>
                <th>Genap</th>
                <th>Pemilik</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $kendaraan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kendaraan['no_plat'] }}</td>
                    <td>{{ $kendaraan['ganjil'] }}</td>
                    <td>{{ $kendaraan['genap'] }}</td>
                    <td>{{ $kendaraan['pemilik'] }}</td>
                    <td>{{ $kendaraan['jenis'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Resume</h3>
    <ul>
        <li>Total Ganjil: {{ $resume['ganjil'] }}</li>
        <li>Total Genap: {{ $resume['genap'] }}</li>
        <li>Total SUV: {{ $resume['SUV'] }}</li>
        <li>Total MVV: {{ $resume['MVV'] }}</li>
    </ul>

</body>
</html>
