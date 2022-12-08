<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><a href="<?= base_url('main/run'); ?>">Create</a></h1>
    <table border="1" width="75%" style="text-align:center;">
        <tr>
            <th>No</th>
            <th>first</th>
            <th>last</th>
        </tr>
        <?php
        foreach ($artist as $a) :
        ?>
            <tr>
                <td><?= $a['id_profiles']; ?></td>
                <td><?= $a['first_name']; ?></td>
                <td><?= $a['last_name']; ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>