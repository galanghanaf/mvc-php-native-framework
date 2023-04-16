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
    <form action="<?= BASE_URL . 'home/insert_user'; ?>" method="POST" enctype="multipart/form-data">
        <label for="nik">NIK</label>
        <input type="number" name="nik" id="nik">
        <br>
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <br>
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo">
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>