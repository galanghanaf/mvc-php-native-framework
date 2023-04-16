<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= Message::show_message() ?>
    <h1>Table User</h1>
    <h5><a href="<?= BASE_URL . 'home/insert_user'; ?>">Tambah Data</a></h5>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Photo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data['users'] as $user) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $user['nik']; ?></td>
                <td><?= $user['nama']; ?></td>
                <td><img src="<?= BASE_URL . 'public/img/' . $user['photo']; ?>" alt="" width="150" height="150"></td>
                <td>
                    <a href="<?= BASE_URL . 'home/edit_user/' . $user['id']; ?>">Edit</a>
                    <a href="<?= BASE_URL . 'home/delete_user/' . $user['id'] . '/' . $user['photo']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>