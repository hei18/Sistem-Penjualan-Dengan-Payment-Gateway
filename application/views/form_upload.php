<html>

<head>
    <title> Belajar Upload di Codeigniter - Warung Belajar -</title>
</head>

<body>
    <?php
    if (isset($error)) {
        echo "ERROR UPLOAD : <br/>";
        print_r($error);
        echo "<hr/>";
    }
    ?>
    <form method="post" enctype="multipart/form-data" action="<?= base_url('main/insert_multi'); ?>">
        <div>full: </div>
        <div><input type="file" name="full_version"></div>
        <div>demo : </div>
        <div><input type="file" name="demo_version"></div>
        <div>Keterangan : </div>

        <div><input type="submit" name="Submits" value="Simpan" /></div>
    </form>
    <?php foreach ($users as $u) : ?>
        <h1><?= $u['full_name']; ?></h1>
    <?php endforeach ?>
</body>

</html>