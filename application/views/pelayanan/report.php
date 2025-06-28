<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Permintaan</title>
    <style>
        body {
            font-size: .85em;
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            text-align: center;
        }

        table td {
            border: 1px solid #ddd;
            padding: 7px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            text-transform: capitalize;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Laporan Permintaan Darah</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Rekam Medis</th>
                <th>Dokter</th>
                <th>Ruangan</th>
                <th>Diagnosa</th>
                <th>Jumlah_darah</th>
                <th>Golda</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data_result)): ?>
                <?php $no = 1;
                foreach ($data_result as $item): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item->rekam_medis ?></td>
                        <td><?= $item->nama_dokter ?></td>
                        <td><?= $item->nama_ruangan ?></td>
                        <td><?= $item->diagnosa ?></td>
                        <td><?= $item->jumlah_darah ?></td>
                        <td><?= $item->golongan_darah ?></td>
                        <td><?= $item->tanggal_pelayanan ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>