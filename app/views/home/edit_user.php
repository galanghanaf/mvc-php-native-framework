<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
</head>

<body>
    <?= Message::show_message() ?>

    <h1><?= $data['title']; ?></h1>
    <br>
    <form action="<?= BASE_URL . 'home/edit_user_action'; ?>" method="POST" enctype="multipart/form-data">
        <?php foreach ($data['users'] as $user) : ?>
            <input type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
            <input type="hidden" name="photo_lama" id="photo_lama" value="<?= $user['photo']; ?>">

            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" value="<?= $user['nik']; ?>">
            <br>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $user['nama']; ?>">
            <br>
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo">
            <br>
            <button type="submit" name="submit">Submit</button>
        <?php endforeach; ?>
    </form>
</body>

</html>