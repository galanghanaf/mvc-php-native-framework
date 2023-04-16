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
        $data["users"] = $this->model("HomeModel")->query("SELECT * FROM users");
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function insert_user()
    {
        if (isset($_POST["submit"])) {
            if ($this->model('HomeModel')->insert_user($_POST) > 0) {
                Message::set_message('Data Berhasil Ditambahkan!');
                header("Location: " . BASE_URL . 'home');
            } else {
                Message::set_message('Data Gagal Ditambahkan!');
                header("Location: " . BASE_URL . 'home/insert_user');
            }
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
        $data["users"] = $this->model("HomeModel")->query("SELECT * FROM users WHERE id = $id");
        $this->view('templates/header', $data);
        $this->view('home/edit_user', $data);
        $this->view('templates/footer');
    }
    public function edit_user_action()
    {
        if (isset($_POST["submit"])) {
            if ($this->model('HomeModel')->edit_user($_POST) > 0) {
                Message::set_message('Data Berhasil Diubah!');
                header("Location: " . BASE_URL . 'home');
            } else {
                Message::set_message('Data Gagal Diubah!');
                header("Location: " . BASE_URL . 'home/edit_user/' . $_POST['id']);
            }
        }
    }

    public function delete_user($where, $photo)
    {
        unlink('public/img/' . $photo);
        $this->model("HomeModel")->delete_data('users', 'id', $where);
        Message::set_message('Data Berhasil Dihapus!');
        header("Location: " . BASE_URL . 'home');
    }
}
