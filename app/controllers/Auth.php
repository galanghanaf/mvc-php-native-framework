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
            global $conn;
            $username = $_POST["username"];
            $password = $_POST["password"];

            // cek apakah username yang diinput ada atau tidak
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

            // cek username menggunakan mysqli_num_rows secara satu persatu
            // apabila ada, maka akan bernilai 1
            if (mysqli_num_rows($result) === 1) {

                // mengecek password dari yang inputkan di $password,
                // disamakan dengan password di database menggunakan $row
                $user = mysqli_fetch_assoc($result);
                if ($password == $user["password"]) {
                    // set session
                    $_SESSION["login"] = [
                        'username' => $user["username"],
                        'nama' => $user["nama"],
                    ];

                    // apabila sama/berhasil dialihkan ke index.php
                    Message::set_message('Anda Berhasil Login!');
                    header("Location: " . BASE_URL . "home");
                    // kemudian dihentikan dengan exit, agar tidak mengeksekusi script setelah header
                    exit();
                }
                Message::set_message('Password Anda Salah!');
                header("Location: " . BASE_URL . "auth");
            } else {
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

    public function _logout()
    {
        unset($_SESSION['login']);
        $_SESSION = [];
        session_unset();
        session_destroy();

        Message::set_message('Anda Berhasil Logout!');

        header("Location: " . BASE_URL . "auth/index");
        exit;
    }
}
