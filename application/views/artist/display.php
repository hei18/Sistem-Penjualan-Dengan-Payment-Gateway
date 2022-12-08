<html>

<head>
    <title></title>

    <link rel="stylesheet" href="<?= base_url('assets/player.css'); ?>">
</head>



<body>
    <h3>
        <center>Tampil Berkas</center>
    </h3>
    <hr />
    <a href="<?= base_url('main/uploads'); ?>">Tambah Berkasssssssssssss</a>
    <hr />
    <table border="1" width="75%" style="text-align:center;">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no = 1;
        foreach ($songs as $row) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><audio controls preload="auto">
                        <source src="data:<?php echo $row->file_types; ?>;base64,<?= base64_encode($row->mime); ?>" type="audio/mpeg">
                    </audio>

                </td>
                <td><a href="data:">download</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <!-- <audio id="player" src="./TheFatRat - Electrified.m4a"></audio>
    <div class="player">
        <div class="control">
            <i class="fas fa-play" id="playbtn"></i>
        </div>
        <div class="info">
            TheFatRat - Electrified
            <div class="bar">
                <div id="progress"></div>
            </div>
        </div>

        <div id="current">0:00</div>
    </div> -->
</body>

<script src="<?= base_url('assets/player.js')  ?>"></script>

</html>