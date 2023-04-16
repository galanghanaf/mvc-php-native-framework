<body>
    <?= Message::show_message(); ?>
    <h1><?= $data['title']; ?></h1>
    <form action="<?= BASE_URL . 'auth'; ?>" method="POST" enctype="multipart/form-data">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
