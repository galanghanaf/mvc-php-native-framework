<?php
class Auth extends Controller
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION["login"])) {
            header("Location: " . BASE_URL . "home");
        }
    }

    public function index()
    {

        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $result = Database::login('users', 'username', $username, $password);
            if ($result == true) {
                Message::set_message('Anda Berhasil Login!');
                header("Location: " . BASE_URL . "home");
            } elseif ($result == false) {
                Message::set_message('Password Anda Salah!');
                header("Location: " . BASE_URL . "auth");
            } elseif ($result == false) {
                Message::set_message('Username Anda Salah!');
                header("Location: " . BASE_URL . "auth");
            }
        } else {
            $data['title'] = "Login";
            $this->view('templates/header', $data);
            $this->view('auth/index', $data);
            $this->view('templates/footer');
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        session_unset();
        session_destroy();

        Message::set_message('Anda Berhasil Logout!');
        header("Location: " . BASE_URL . "auth/index");
        exit;
    }
}
