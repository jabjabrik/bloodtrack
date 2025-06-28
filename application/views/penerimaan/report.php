<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penerimaan Darah</title>
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
    <div class="container mt-4">
        <h2>Laporan Penerimaan Darah</h2>
        <p>Tanggal: <?= date('d-m-Y', strtotime($tanggal)); ?></p>
        <?php if (empty($data_result)): ?>
            <div style="margin: 40px 0; text-align: center; color: #b00; font-size: 1.1em;">Tidak ada data penerimaan pada tanggal ini.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penerimaan</th>
                        <th>No Kantong</th>
                        <th>Darah</th>
                        <th>PMI</th>
                        <th>Kurir</th>
                        <th>Penerima</th>
                        <th>Tanggal Terima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data_result as $item): ?>
                        <tr>
                            <td style="text-align:center;"><?= $no++; ?></td>
                            <td><?= $item->kode_penerimaan; ?></td>
                            <td><?= $item->no_kantong; ?></td>
                            <td><?= "$item->jenis_darah | $item->golongan_darah"; ?></td>
                            <td><?= $item->nama_pmi; ?></td>
                            <td><?= $item->nama_kurir; ?></td>
                            <td><?= $item->nama_penerima; ?></td>
                            <td style="text-align:center;"><?= date('d-m-Y', strtotime($item->tanggal_terima)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="margin-top:10px; font-weight:bold;">Total Data: <?= count($data_result); ?></div>
        <?php endif; ?>
    </div>
</body>

</html>