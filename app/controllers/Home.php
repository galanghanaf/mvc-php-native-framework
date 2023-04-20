<?php

class Home extends Controller
{
    public function __construct()
    {
        session_start();
        if (!isset($_SESSION["login"])) {
            header("Location: " . BASE_URL . "auth");
            exit;
        }
    }

    public function index()
    {
        $data['title'] = "Home";
        $data["users"] = $this->model("HomeModel")->getAllData('users');
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function insert_user()
    {
        if (isset($_POST["submit"])) {
            if ($_FILES['photo']['error'] === 4) {
                $photo = NULL;
            } else {
                $file_name = uniqid($_POST['username']);
                $file_location = 'public/img/';
                $file_size = 1048576;  // 1 MegaByte = 1048576 Byte
                $photo = Database::upload('photo', $file_location, $file_size, $file_name);
            }

            $insert = [
                'nama' => $_POST['nama'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'photo' => $photo,
            ];
            Database::insert('users', $insert, 'home/insert_user');
            Message::set_message('Data Berhasil Ditambahkan!');
            header("Location: " . BASE_URL . 'home');
        } else {
            $data['title'] = "Tambah Data User";
            $this->view('templates/header', $data);
            $this->view('home/insert_user', $data);
            $this->view('templates/footer');
        }
    }

    public function edit_user($id)
    {
        $data['title'] = "Edit User";
        $data["users"] = $this->model("HomeModel")->getDataById("users", "id", $id);
        $this->view('templates/header', $data);
        $this->view('home/edit_user', $data);
        $this->view('templates/footer');
    }
    public function edit_user_action()
    {
        if (isset($_POST["submit"])) {
            if ($_FILES['photo']['error'] === 4) {
                $photo = $_POST['photo_lama'];
            } else {
                unlink('public/img/' . $_POST['photo_lama']);
                $file_name = uniqid($_POST['username']);
                $file_location = 'public/img/';
                $file_size = 1048576;  // 1 MegaByte = 1048576 Byte
                $photo = Database::upload('photo', $file_location, $file_size, $file_name);
            }

            $update = [
                'nama' => $_POST['nama'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'photo' => $photo,
            ];
            $where = [
                'id' => $_POST['id']
            ];
            Database::update('users', $update, $where, 'home/edit_user/' . $_POST['id']);
            Message::set_message('Data Berhasil Diubah!');
            header("Location: " . BASE_URL . 'home');
        }
    }

    public function delete_user($where, $file = NULL)
    {
        if ($file != NULL) {
            unlink('public/img/' . $file);
        }
        Database::delete('users', 'id', $where);
        Message::set_message('Data Berhasil Dihapus!');
        header("Location: " . BASE_URL . 'home');
    }
}
