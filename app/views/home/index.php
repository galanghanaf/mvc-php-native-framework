<body>
    <?= Message::show_message() ?>
    <p>Selamat Datang, <?= $_SESSION['login']['nama'] ?></p>
    <a href="<?= BASE_URL . 'auth/_logout'; ?>">Logout</a>
    <br>
    <br>
    <h1>Table User</h1>
    <h5><a href="<?= BASE_URL . 'home/insert_user'; ?>">Tambah Data</a></h5>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Photo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach($data['users'] as $user) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $user['nama']; ?></td>
                <td><?= $user['username']; ?></td>
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