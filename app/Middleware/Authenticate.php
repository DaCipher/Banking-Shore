<?php



namespace App\Middleware;



use App\Database\Database;

use App\Model\UserModel;



session_start();

class Authenticate

{

    public function __construct()

    {

        session_start();
    }

    public static function isLogin()

    {

        if (!isset($_SESSION['login'])) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?PostLogin=" . urlencode($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));

            exit();
        }
    }



    public static function isAdmin($id)

    {

        if (!UserModel::isAdmin($id)) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/");

            exit();
        }
    }



    public static function isWebmaster($userid)

    {

        $sql = "SELECT userid FROM admin WHERE role = 'webmaster'";

        $query = Database::connect()->query($sql);

        if ($query->rowCount() > 0) {

            $id = $query->fetch();

            if ($id == $userid) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public static function isAuthenticate()

    {

        if (!isset($_SESSION['authenticate'])) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");

            exit();
        }
    }

    public static function is_login()

    {

        if (isset($_SESSION['login']) && isset($_SESSION['authenticate'])) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/");

            exit();
        }
    }



    public static function securePayment()

    {

        if (!isset($_GET['token'])) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/transaction/funds-transfer.php");

            exit();
        } elseif (isset($_GET['token'])) {

            if (isset($_SESSION['paymentToken'])) {

                if ($_GET['token'] != $_SESSION['paymentToken']) {

                    header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/transaction/funds-transfer.php");

                    exit();
                }
            } else {

                header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/transaction/funds-transfer.php");

                exit();
            }
        }
    }



    public static function secureTransfer(): void

    {

        if (!isset($_SESSION['payment'])) {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/transaction/funds-transfer.php");

            exit();
        }
    }
}
