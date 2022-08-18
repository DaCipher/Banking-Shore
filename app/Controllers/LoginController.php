<?php







namespace App\Controllers;







use App\Middleware\Authenticate;



use App\Middleware\Validate;



use App\Model\UserModel;











class LoginController extends Validate



{



    public $login_error, $confirm_pin_error, $pin_error, $new_pin, $new_pin_error, $confirm_pin;



    public $password_error;



    public $userid_error, $id_error, $ans_error;



    public $userid, $question, $answer, $question_error, $answer_error;



    public $new_paass, $confirm_pass, $new_pass_error, $confirm_pass_error;



    public $status_success, $status_failed;







    /**



     * 



     */







    public function __construct()



    {



        Authenticate::is_login();



        $this->PostLogin();



        $this->csrf();







        if (isset($_GET['action'])) {



            if ($_GET['action'] == "logout") {



                UserController::logout();
            }
        }



        if (isset($_POST['login'])) {



            if (isset($_SESSION['csrf_token'])) {



                if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {



                    $this->validate($_POST);
                } else {



                    $this->login_error = '<div class="help-block alert alert-danger p-1 mb-2"><i class="px-1 fa fa-info-circle"></i> Error: Something went wrong!</div>';
                }
            } else {



                $this->login_error = '<div class="help-block alert alert-danger p-1 mb-2"><i class="px-1 fa fa-info-circle"></i> Error: Something went wrong!</div>';
            }
        }









        if ($_SERVER['SCRIPT_NAME'] == "/account/forgot-password.php") {



            if (isset($_POST['check_id'])) {



                $this->checkID();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/authenticate.php") {



            $this->authenticate();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/change-password.php") {



            $this->changePass();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/forgot-userid.php") {



            $this->checkID();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/security-question.php") {



            $this->changeSec($_POST);
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/authentication.php") {



            $this->authentication();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/account/change-pin.php") {



            $this->changePin();
        }
    }











    private function validate($data)



    {



        $this->userid = $this->input($data['userid']);



        if (ctype_digit($this->userid)) {



            $param = [



                "table" => "auth",



                "column" => "userid",



                "data" => $this->userid



            ];
        } else {



            $param = [



                "table" => "admin",



                "column" => "username",



                "data" => $this->userid



            ];
        }







        //Validate POST data







        if (empty($data['userid'])) {



            $this->error = "set";



            $this->userid_error = "User ID required!";
        }



        if (empty($data['password'])) {



            $this->error = "set";



            $this->password_error = "Password required!";
        }







        if (empty($this->error)) {



            // if user exist



            if (UserModel::userExist($param)) {



                if (!ctype_digit($this->userid)) {



                    $auth = UserModel::getSingleRecord($param);



                    $param['table'] = "auth";



                    $param['column'] = "userid";



                    $param['data'] = $auth[0]['userid'];
                }



                $user = UserModel::getSingleRecord($param);



                if (password_verify($data['password'], $user[0]['password'])) {



                    $this->login($user[0]['userid']);
                } else {



                    $this->login_error = '<div class="help-block alert alert-danger p-1 mb-2"><i class="px-1 fa fa-info-circle"></i> Invalid username/password!</div>';
                }
            } else {



                $this->login_error = '<div class="help-block alert alert-danger p-1 mb-2"><i class="px-1 fa fa-info-circle"></i> Invalid username/password!</div>';
            }
        }
    }







    private function checkID()



    {



        if ($_SERVER['REQUEST_METHOD'] == "POST") {



            if (isset($_POST['check_id'])) {



                $data = [



                    "table" => "auth", "column" => "userid", "data" => trim($_POST['id'])



                ];
            }







            if (isset($_POST['check_email'])) {



                $data = [



                    "table" => "users", "column" => "email", "data" => trim($_POST['email'])



                ];
            }



            if ($info = UserModel::getSingleRecord($data)) {



                $sec = UserModel::getSingleRecord(["table" => "auth", "column" => "userid", "data" => $info[0]['userid']]);



                if (!empty($sec[0]['sq'])) {



                    $_SESSION['question'] = "set";



                    $_SESSION['uid'] = $info[0]['userid'];



                    header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/authenticate.php");
                } else {



                    $this->id_error = "Error: Contact Support!";
                }
            } else {



                if (isset($_POST['check_id'])) {



                    $this->id_error = "Invalid User ID!";
                }



                if (isset($_POST['check_email'])) {



                    $this->id_error = "Invalid Email!";
                }
            }
        }
    }



    private function authenticate()



    {







        if (isset($_SESSION['question']) || isset($_SESSION['uid'])) {



            $user = UserModel::getSingleRecord(['table' => 'auth', "column" => "userid", "data" => $_SESSION['uid']]);



            if ($user) {



                $this->question = $user[0]['sq'];;



                if (isset($_POST['chkans'])) {



                    if (password_verify($_POST['answer'], $user[0]['sqa'])) {



                        $_SESSION['change_psw'] = "set";



                        header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/change-password.php");
                    } else {



                        $this->ans_error = "Answer incorrect!";
                    }
                }
            } else {
            }
        } else {



            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");
        }
    }







    public function changePass()

    {

        if (isset($_SESSION['uid'])) {



            if (isset($_POST['chkpsw'])) {



                foreach ($_POST as $field => $val) {







                    $error = $field . "_error";



                    if (empty($val)) {



                        $this->$error = "Field is required!";
                    } else {



                        $this->$field = $val;
                    }
                }



                if (!empty($this->new_pass) && !empty($this->confirm_pass)) {



                    if ($this->new_pass == $this->confirm_pass) {



                        if (strlen($this->new_pass) < 8) {



                            $this->new_pass_error = "Password must be at least 8 characters";
                        } else {



                            if (UserModel::update(["data" => password_hash($this->new_pass, PASSWORD_BCRYPT), "column" => "password", "userid" => $_SESSION['uid']])) {



                                $this->pass_success = "Password Changed!";



                                UserModel::passChange($_SESSION['uid']);



                                $this->login($_SESSION['uid']);



                                unset($_SESSION['question']);



                                // ($this->PostLogin()) ? header("refresh: 5; url=" . $this->PostLogin()) : header("refresh: 5; url=" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/");



                            } else {



                                $this->pass_failed = "Error: Something Went Wrong!";
                            }
                        }
                    } else {



                        $this->confirm_pass_error = "Passwords doesn't match!";
                    }
                }
            }
        } else {



            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");
        }
    }







    public function lastLogin()



    {
    }



    public function login($id)



    {



        $datas = [



            'table' => "accounts",



            'column' => 'userid',



            'data' => $id



        ];



        $account = UserModel::getSingleRecord($datas);



        // Set General Session Variables



        $_SESSION['userid'] = $account[0]['userid'];



        $_SESSION['account_id'] = $account[0]['account_id'];



        if (UserModel::isAdmin($id)) {



            // Set Admin session Variables



            $admin = UserModel::getSingleRecord([



                "table" => "admin",



                "column" => "userid",



                "data" => $account[0]['userid']



            ]);







            $_SESSION['role'] = $admin[0]['role'];
        }



        $param = [



            "table" => "auth",



            "column" => "userid",



            "data" => $account[0]['userid']



        ];



        $user = UserModel::getSingleRecord($param);



        if ($user[0]['pass_change'] == "1" || password_verify("12345678", $user[0]['pin'])) {

            $_SESSION['uid'] = $user[0]['userid'];

            ($this->PostLogin()) ? header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/change-password.php?PostLogin=" . urlencode($this->PostLogin())) : header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/change-password.php");
        } else if (empty($user[0]['sq']) || empty($user[0]['sqa']) || strpos($user[0]['sq'], "your name?") || strpos($user[0]['sq'], "your firstname?")) {

            $_SESSION['uid'] = $user[0]['userid'];

            $_SESSION['security'] = "set";

            ($this->PostLogin()) ? header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/security-question.php?PostLogin=" . urlencode($this->PostLogin())) : header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/security-question.php");
        } else if (empty($user[0]['pin']) || password_verify("123456", $user[0]['pin'])) {

            $_SESSION['uid'] = $user[0]['userid'];

            $_SESSION['change_pin'] = "set";

            ($this->PostLogin()) ? header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/change-pin.php?PostLogin=" . urlencode($this->PostLogin())) : header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/change-pin.php");
        } else {

            $_SESSION['login'] = true;

            ($this->PostLogin()) ? header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/authentication.php?PostLogin=" . urlencode($this->PostLogin())) : header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/authentication.php");
        }
    }



    public function changeSec($post)



    {



        if (isset($_SESSION['uid']) && isset($_SESSION['security'])) {



            if (isset($_POST['change_security'])) {



                $errors = "";



                foreach ($post as $field => $val) {



                    if ($field == "change_security") {



                        break;
                    }



                    $error = $field . "_error";



                    if (empty($val)) {



                        $this->$error = "Field is required!";



                        $errors = "set";
                    } else {



                        $this->$field = $val;
                    }
                }



                if (empty($errors)) {



                    $action = UserModel::updateSec(['sq' => $post['question'], "sqa" => password_hash($post['answer'], PASSWORD_BCRYPT), "id" => $_SESSION['userid']]);



                    if ($action) {



                        $this->sec_success = "Security question modified!";



                        $this->question = $this->answer = "";



                        $this->login($_SESSION['uid']);



                        unset($_SESSION['question']);
                    } else {



                        $this->sec_failed = "Error: Something went wrong!";
                    }
                }
            }
        } else {



            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");
        }
    }



    public function changePin()

    {



        if (isset($_SESSION['change_pin']) && isset($_SESSION['uid'])) {



            if (isset($_POST['change_pin'])) {



                foreach ($_POST as $field => $val) {



                    $error = $field . "_error";



                    if (empty($val)) {



                        $this->$error = "Field is required!";
                    } else {



                        $this->$field = $val;
                    }
                }



                if (!empty($this->new_pin) && !empty($this->confirm_pin)) {



                    if ($this->new_pin == $this->confirm_pin) {



                        if (strlen($this->new_pin) < 6 || strlen($this->new_pin) > 6) {



                            $this->new_pin_error = "PIN must be between 4 - 6 digits!";
                        } elseif ($this->new_pin == "123456") {

                            $this->new_pin_error = "Choose another PIN!";
                        } else {



                            if (UserModel::update(["data" => password_hash($this->new_pin, PASSWORD_BCRYPT), "column" => "pin", "userid" => $_SESSION['uid']])) {



                                $this->pin_success = "PIN Changed Successfully!";



                                $this->login($_SESSION['uid']);
                            } else {



                                $this->pin_failed = "Error: Something Went Wrong!";
                            }
                        }
                    } else {



                        $this->confirm_pin_error =  $this->new_pin_error = "PIN doesn't match!";
                    }
                }
            }
        } else {



            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");
        }
    }



    public function authentication()

    {

        if (isset($_SESSION['login']) && !isset($_SESSION['authenticate'])) {

            $user = UserModel::getSingleRecord(["table" => "auth", "column" => "userid", "data" => $_SESSION['userid']]);



            $this->question = $user[0]['sq'];



            unset($_SESSION["uid"]);



            unset($_SESSION['change_pin']);







            if (isset($_POST['authenticate'])) {



                $errors = "";



                foreach ($_POST as $field => $val) {



                    if ($field == "authenticate") {



                        break;
                    }



                    $error = $field . "_error";



                    if (empty($val)) {



                        $this->$error = "Field is required!";



                        $errors = "set";
                    }
                }



                if (empty($errors)) {



                    if (password_verify($_POST['answer'], $user[0]['sqa'])) {



                        $_SESSION['authenticate'] = "set";



                        ($this->PostLogin()) ? header("location: " . $this->PostLogin()) : header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/user/");
                    } else {



                        $this->answer_error = "Response incorrect!";
                    }
                }
            }
        } else {

            header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/account/login.php?action=logout");
        }
    }



    /**



     * Check if user is logged -n



     *



     * @param string $data Session ID



     * @return bool



     */



    public function islogin($data)

    {
    }



    public function PostLogin()

    {

        if (isset($_GET['PostLogin'])) {



            $redirect = htmlspecialchars_decode($_GET['PostLogin']);



            return $redirect;
        } else {



            return false;
        }
    }





    public static function dd($data)

    {

        echo "<pre>";

        var_dump($data);

        echo "</pre>";

        die();
    }
}
