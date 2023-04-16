<?php

class HomeModel
{
    public function query($query)
    {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function delete_data($table, $column, $where)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM $table WHERE $column = $where");
        return mysqli_affected_rows($conn);
    }

    public function insert_user($data)
    {
        global $conn;

        $nama    = htmlspecialchars($data["nama"]);
        $username    = htmlspecialchars($data["username"]);
        $password    = htmlspecialchars($data["password"]);

        $photo = $this->uploud($username);
        if (!$photo) {
            return false;
        }

        $query = "INSERT INTO users VALUES 
                    (NULL,
                    '$nama', 
                    '$username', 
                    '$password', 
                    '$photo')";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
    public function edit_user($data)
    {
        global $conn;

        $id     = $data["id"];
        $nama    = htmlspecialchars($data["nama"]);
        $username    = htmlspecialchars($data["username"]);
        $password    = htmlspecialchars($data["password"]);
        $photo_lama    = htmlspecialchars($data["photo_lama"]);

        if ($_FILES['photo']['error'] === 4) {
            $photo = $photo_lama;
        } else {
            unlink('public/img/' . $photo_lama);
            $photo = $this->uploud($username);
        }

        $query = "UPDATE users SET
                    nama = '$nama', 
                    username = '$username', 
                    password = '$password', 
                    photo = '$photo'   
                    WHERE id = '$id'";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    public function uploud($id)
    {
        $namaFile = $_FILES['photo']['name'];
        $ukuranFile = $_FILES['photo']['size'];
        $error = $_FILES['photo']['error'];
        $tmpName = $_FILES['photo']['tmp_name'];

        // cek apakah tidak ada photo yang di uploud
        if ($error === 4) {
            return false;
        }

        // cek apakah yang diuploud adalah photo
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile); //memecah nama file dan tipe filenya
        $ekstensiGambar = strtolower(end($ekstensiGambar)); // memaksa mengubah nama tipe file huruf kecil

        // mengecek apakah photo yang diuploud sesuai dengan format file diatas
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            return false;
        }

        // cek jika ukuran photo terlalu besar
        if ($ukuranFile > 1000000) {
            return false;
        }

        // lolos pengecekan, photo siap diuploud
        //generate nama photo baru
        $namaFileBaru = uniqid($id);
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'public/img/' . $namaFileBaru);

        // kenapa return, untuk menyimpan nama gambarnya di function tambah
        return $namaFileBaru;
    }
}
