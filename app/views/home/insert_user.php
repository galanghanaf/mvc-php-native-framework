<body>
    <?= Message::show_message() ?>

    <h1><?= $data['title']; ?></h1>
    <br>
    <form action="<?= BASE_URL . 'home/insert_user'; ?>" method="POST" enctype="multipart/form-data">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <br>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo">
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <br>
    <a href="<?= BASE_URL . "home"; ?>">Kembali</a>
</body>