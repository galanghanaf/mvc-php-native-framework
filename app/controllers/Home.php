<?php

class Home extends Controller
{

    public function index()
    {
        $data['title'] = "Home";
        $data["users"] = $this->model("HomeModel")->query("SELECT * FROM users");
        $this->view('home/index', $data);
    }

    public function insert_user()
    {
        if (isset($_POST["submit"])) {

            // cek apakah data berhasil ditambahkan atau tidak
            if ($this->model('HomeModel')->insert_user($_POST) > 0) {
                Message::set_message('Berhasil Ditambahkan!');
                header("Location: " . BASE_URL . 'home');
            } else {
                Message::set_message('Gagal Ditambahkan!');
                header("Location: " . BASE_URL . 'home/insert_user');
            }
        } else {

            $data['title'] = "Tambah Data User";
            $this->view('home/insert_user', $data);
        }
    }

    public function edit_user($id)
    {
        $data['title'] = "Edit User";
        $data["users"] = $this->model("HomeModel")->query("SELECT * FROM users WHERE id = $id");
        $this->view('home/edit_user', $data);
    }
    public function edit_user_action()
    {
        if (isset($_POST["submit"])) {

            // cek apakah data berhasil ditambahkan atau tidak
            if ($this->model('HomeModel')->edit_user($_POST) > 0) {
                unlink('public/img/' . $_POST['photo_lama']);
                Message::set_message('Berhasil Diubah!');
                header("Location: " . BASE_URL . 'home');
            } else {
                Message::set_message('Gagal Diubah!');
                header("Location: " . BASE_URL . 'home/edit_user/' . $_POST['id']);
            }
        }
    }

    public function delete_user($where, $photo)
    {
        unlink('public/img/' . $photo);
        $this->model("HomeModel")->delete_data('users', 'id', $where);
        Message::set_message('Berhasil Dihapus!');
        header("Location: " . BASE_URL . 'home');
    }
}
