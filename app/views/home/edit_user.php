<body>
    <?= Message::show_message() ?>

    <h1><?= $data['title']; ?></h1>
    <br>
    <form action="<?= BASE_URL . 'home/edit_user_action'; ?>" method="POST" enctype="multipart/form-data">
        <?php foreach ($data['users'] as $user) : ?>
            <input type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
            <input type="hidden" name="photo_lama" id="photo_lama" value="<?= $user['photo']; ?>">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $user['nama']; ?>">
            <br>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $user['username']; ?>">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?= $user['password']; ?>">
            <br>
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo">
            <br>
            <button type="submit" name="submit">Submit</button>
        <?php endforeach; ?>
    </form>
    <br>
    <br>
    <a href="<?= BASE_URL . "home"; ?>">Kembali</a>
</body>
