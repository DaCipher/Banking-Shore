<?php



namespace App\Controllers;



use App\Model\UserModel;

use App\Model\PaymentModel;

use App\Middleware\Authenticate;



class PaymentController

{



    public $firstname, $lastname, $account_id, $account_number, $code_error;

    public $from_param, $to_param;



    public function __construct()

    {

        // ROUTES

        if ($_SERVER['SCRIPT_NAME'] == "/user/secure/index.php") {

            // Authentication

            Authenticate::securePayment();

            if (session_id() == "") {

                session_start();
            }

            if (isset($_GET['token']) & isset($_GET['req'])) {

                if (isset($_POST['imf'])) {

                    $this->checkCode("imf_code", $_POST['imf_code']);
                }
            }

            if (isset($_GET['token']) & isset($_GET['req'])) {

                if (isset($_POST['cot'])) {

                    $this->checkCode("cot_code", $_POST['cot_code']);
                }
            }
        }

        if ($_SERVER['SCRIPT_NAME'] == "/user/secure/transfer/index.php") {

            Authenticate::secureTransfer();
        }
    }

    public function checkCode(String $req, Int $code)

    {

        $userCode = PaymentModel::getCode($_SESSION['account_id']);

        if ($userCode[$req] == $code) {

            $field = substr($req, 0, 4) . "required";

            PaymentModel::clearReq($field, $_SESSION['account_id']);

            $this->transfer($_SESSION['account_id']);
        } else {

            $this->code_error = "Incorrect code!";
        }
    }

    public function transfer(String $account_id)

    {

        $this->account_id = $account_id;

        // Check if Local transfer

        $token = bin2hex(random_bytes(32));

        $_SESSION['paymentToken'] = $token;

        $user = PaymentModel::getCode($account_id);

        if ($user['imf_required'] == "1") {

            header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/user/secure/?token=" . $token . "&req=imf");
        } elseif ($user["cot_required"] == "1") {

            header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/user/secure/?token=" . $token . "&req=cot");
        } else {

            unset($_SESSION['paymentToken']);

            PaymentModel::resetReq($_SESSION['account_id']);

            if ($this->Send($_SESSION['transfer']['from_param'], $_SESSION['transfer']['to_param'])) {

                $_SESSION['payment'] = "success";
            } else {

                $_SESSION['payemnt'] = "fail";
            }

            header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/user/secure/transfer/");
        }
    }



    public function Send($from_param, $to_param = null)

    {

        if (UserModel::localtransaction($from_param, $to_param)) {
            $_SESSION['transfer']['from_param']['account'] = $_SESSION['account_id'];
            $_SESSION['transfer']['from_param']['type'] =  $_SESSION['transfer']['from_param']['from_transaction_type'];
            $admin = new AdminController;
            $admin->alert($_SESSION['transfer']['from_param']);
            unset($_SESSION['transfer']);

            unset($_SESSION['payment']);

            unset($_SESSION['transfer_lifespan']);

            return true;

            // $this->transfer_success = "Sent Successfully.";

            // $this->to_acc = $this->to_acc_name = $this->to_bank = $this->from_acc = $this->narration = $this->amount = $this->pin = $this->routing = "";

        } else {

            unset($_SESSION['transfer']);

            unset($_SESSION['payment']);

            unset($_SESSION['transfer_lifespan']);

            return false;

            // die("Error");

            // $this->transfer_success = "Error: Something went wrong!";

        }
    }
}
