<?php







namespace App\Controllers;







use App\Middleware\Authenticate;



use App\Model\UserModel;



use App\Model\AdminModel;







class UserController



{



    public $user = [], $account = [], $history = [], $alert = [], $account_officer = [];







    public $id, $result, $page, $pages, $paginate, $message, $messages;







    public $current_pin, $new_pin, $confirm_pin;



    public $current_pin_error, $new_pin_error, $confirm_pin_error;







    public $question, $answer, $msg;



    public $question_error, $answer_error, $sec_success, $sec_failed;



    public $current_pass, $new_pass, $confirm_pass;



    public $current_pass_error, $new_pass_error, $confirm_pass_error;







    public $to_acc_error, $routing_error, $to_acc_name_error, $to_bank_error, $from_acc_error, $amount_error, $narration_error, $pin_error, $transfer_error;



    public $to_acc, $to_acc_name, $routing, $from_acc, $to_bank, $narration, $amount, $pin, $transfer_success;



    public $transaction_total;







    public function __construct()



    {



        Authenticate::isLogin();



        Authenticate::isAuthenticate();



        $total_transaction = UserModel::transactions($_SESSION['account_id'], date('d-M-Y'));

        if (isset($_SESSION['transfer'])) {

            if (time() > $_SESSION['transfer_lifespan']) {

                unset($_SESSION['transfer']);

                unset($_SESSION['transfer_lifespan']);
            }
        }

        if (!is_null($total_transaction['amount'])) {



            $this->transaction_total = $total_transaction['amount'];
        } else {



            $this->transaction_total = 0;
        }



        $this->msg = AdminModel::getMessage($_SESSION['userid']);



        if ($_SERVER['SCRIPT_NAME'] == "/user/transaction/transaction-history.php") {



            $this->paginate = $this->paginate("transaction_history");
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/transaction/alert.php") {



            $this->paginate = $this->paginate("alert");
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/settings/transaction-pin.php") {



            if (isset($_POST['change_pin']))



                $this->changePin($_POST);
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/settings/change-password.php") {



            if (isset($_POST['change_pass']))



                $this->changePass($_POST);
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/settings/security-questions.php") {



            if (isset($_POST['change_security']))



                $this->changeSecurity($_POST);
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/account/transaction-limit.php") {



            if (isset($_POST['std']))



                $this->upgradeLimit($_POST);
        }



        if ($_SERVER['SCRIPT_NAME'] == "/user/account/inbox.php") {



            $this->inbox();
        }



        $this->user = UserModel::joinTable([



            "table1" => "users",



            "table2" => "accounts",



            "column1" => "userid",



            "column2" => "userid",



            "column3" => "userid",



            "data" => $_SESSION['userid'],



        ]);



        $this->account = UserModel::joinTable([



            "table1" => "accounts",



            "table2" => "account_officer",



            "column1" => "account_officer_id",



            "column2" => "id",



            "column3" => "userid",



            "data" => $_SESSION['userid'],



        ]);



        $this->history = UserModel::getSingleRecord([



            "table" => "transaction_history",



            "column" => "account_id",



            "data" => $_SESSION['account_id']



        ]);







        $this->alert = UserModel::getSingleRecord([



            "table" => "alert",



            "column" => "account_id",



            "data" => $_SESSION['account_id'],



            "order" => "sort"



        ]);



        if (!$this->user || !$this->account) {



            header("location: " . $_SERVER['PHP_SELF'] . "?action=logout");
        }



        if (isset($_GET['action'])) {



            if ($_GET['action'] == "logout") {



                self::logout();
            }
        }



        if (isset($_POST['get_acc_name'])) {



            $row = UserModel::getAccnumber($_POST);



            exit(json_encode($row));
        }







        if (isset($_POST['local']) || isset($_POST['other'])) {



            $this->localTransfer($_POST);
        }
    }







    public static function logout()



    {



        unset($_SESSION);



        session_unset();



        session_destroy();



        header("location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"] . "/account/login.php");
    }







    public function localTransfer($post)



    {



        if (isset($_POST['other'])) {



            $post_acc = explode(" ", $post['to-acc-name']);



            $post['to-acc-name'] = $post_acc[0];
        }







        $error = "";



        if (empty($post['from-acc'])) {



            $this->from_acc_error = "Select Account!";



            $error = "set";
        } else {



            $this->from_acc = $post['from-acc'];
        }



        if (isset($_POST['to-bank'])) {



            if (empty($post['to-bank'])) {



                $this->to_bank_error = "Field is reqiuired";



                $error = "set";
            } else if (is_numeric($post['to-bank'])) {



                $this->to_bank_error = "Enter Valid Bank Name!";



                $error = "set";
            } else {



                $this->to_bank = $post['to-bank'];
            }
        }







        if (empty($post['to-acc'])) {



            $this->to_acc_error = "Account Number required!";



            $error = "set";
        } else if (!is_numeric($post['to-acc'])) {



            $this->to_acc_error = "Invalid Account Number";



            $error = "set";
        } else {



            if (isset($_POST['local'])) {



                if (UserModel::userExist(["table" => "accounts", "column" => "account_number", "data" => $post['to-acc']])) {



                    $this->to_acc = $post['to-acc'];
                } else {



                    $this->to_acc_error = "Invalid Account Number";



                    $error = "set";
                }
            } else {



                $this->to_acc = $post['to-acc'];
            }
        }



        if (isset($_POST['to-acc-name'])) {



            if (empty($post['to-acc-name'])) {



                $this->to_acc_name_error = "Field is reqiuired";



                $error = "set";
            } else if (is_numeric($post['to-acc-name'])) {



                $this->to_acc_name_error = "Enter Valid Name!";



                $error = "set";
            } else {



                $this->to_acc_name = $post['to-acc-name'];
            }
        }



        if (isset($post['routing-swift'])) {



            if (empty($post['routing-swift'])) {



                $this->routing_error = "Field is reqiuired";



                $error = "set";
            } else if (!is_numeric($post['routing-swift'])) {



                $this->routing_error = "Invalid Routing/Swift!";



                $error = "set";
            } else {



                $this->routing = $post['routing-swift'];
            }
        };



        if (empty($post['amount'])) {



            $this->amount_error = "Amount required";



            $error = "set";
        } else if (!is_numeric($post['amount'])) {



            $this->amount_error = "Enter valid amount";



            $error = "set";
        } elseif ($post['amount'] < 1) {

            $this->amount_error = "Enter valid amount";
            $error = "set";
        } else {

            $this->amount = $post['amount'];
        }

        if (empty($post['narration'])) {


            $this->narration_error = "Field is reqiuired";

            $error = "set";
        } else if (is_numeric($post['narration'])) {



            $this->narration_error = "Enter valid decription";



            $error = "set";
        } else {



            $this->narration = $post['narration'];
        }







        if (empty($post['pin'])) {



            $this->pin_error = "PIN required";



            $error = "Set";
        }







        if (empty($error)) {



            $pass = UserModel::getSingleRecord(["table" => "auth", "column" => "userid", "data" => $_SESSION['userid']]);



            if (password_verify($post['pin'], $pass[0]['pin'])) {


                if ($post['amount'] > $this->account[0]['account_balance']) {
                    $this->transfer_error = "Insufficient funds!";
                } else {
                    if ($this->account[0]['account_status'] != "active") {



                        $this->transfer_error = "Account is Domant. Contact Support.";
                    } else {



                        $restrictions = $this->account[0]['account_restriction'];



                        switch ($restrictions) {



                            case "blocked":



                                $this->transfer_error = "Account blocked! Contact Support.";



                                break;



                            case "freezed":



                                $this->transfer_error = "Account frezeed! Contact Support.";



                                break;



                            case "locked":



                                $this->transfer_error = "Account locked! Contact Support.";



                                break;



                            default:







                                if ($restrictions == "open") {



                                    if ($post['amount'] > $this->account[0]['transaction_limit']) {



                                        $this->transfer_error = "Transaction Limit Exceeded!";
                                    } else if (($post['amount'] + $this->transaction_total)  > $this->account[0]['daily_limit']) {



                                        $this->transfer_error = "Daily Transaction Limit Exceeded!";
                                    } else {



                                        $from_param = [



                                            "account_id" => $post['from-acc'],



                                            'amount' => $post['amount'],



                                            'currency' => "USD",



                                            "from_transaction_type" => "debit",



                                            'date' => date("d-M-Y H:i:s", time()),



                                            "reference" => "MB/" . mt_rand(00000000, 99999999) . "/" . strtoupper(bin2hex(random_bytes(2))),



                                            "narration" => substr($post['narration'], 0, 12),



                                            'sort' => date("Y-m-d H:i:s", time()),



                                        ];

                                        if (isset($_POST['local'])) {



                                            $to_param = [



                                                'to_transaction_type' => 'credit',



                                                "to-acc" => $post['to-acc']



                                            ];
                                        } else {



                                            $to_param = null;



                                            $from_param['to-acc-name'] = $post['to-acc-name'];
                                        }

                                        // Send Now



                                        if (isset($_POST['local'])) {
                                            if ($this->payment()->Send($from_param, $to_param)) {
                                                // Sender Alert
                                                $from_param['type'] = $from_param['from_transaction_type'];
                                                $from_param['account'] = $from_param['account_id'];
                                                $this->admin()->alert($from_param);
                                                // Reciever
                                                $to_acc_id = UserModel::getSingleRecord(['table' => "accounts", "column" => "account_number", "data" => $to_param['to-acc']]);
                                                $from_param['type'] = $to_param['to_transaction_type'];
                                                $from_param['account'] = $to_acc_id[0]['account_id'];
                                                $this->admin()->alert($from_param);
                                                $_SESSION['payment'] = "success";
                                            } else {

                                                $_SESSION['payment'] = "fail";
                                            }

                                            header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST'] . "/user/secure/transfer/");
                                        } else {

                                            $_SESSION['transfer']['to_param'] = $to_param;

                                            $_SESSION['transfer']['from_param'] = $from_param;

                                            $_SESSION['transfer_lifespan'] = time() + 180;
                                            $this->payment()->transfer($from_param['account_id']);
                                        }
                                    }
                                } else {

                                    $this->transfer_error = "Unknwon Error! Contact Support.";
                                }
                        }
                    }
                }
            } else {



                $this->pin_error = "Incorrect PIN!";
            }
        }
    }





    // public function transfer(array $from_param, array $to_param = null)

    // {

    //     if (UserModel::localtransaction($from_param, $to_param)) {



    //         $this->transfer_success = "Sent Successfully.";



    //         $this->to_acc = $this->to_acc_name = $this->to_bank = $this->from_acc = $this->narration = $this->amount = $this->pin = $this->routing = "";

    //         die("Sent");

    //     } else {

    //         die("Error");

    //         $this->transfer_success = "Error: Something went wrong!";

    //     }

    // }

    public function changePin($post)


    {



        $pass = UserModel::getSingleRecord(["table" => "auth", "column" => "userid", "data" => $_SESSION['userid']]);



        // validate pin



        foreach ($post as $field => $val) {



            $error = $field . "_error";



            if (empty($val)) {



                $this->$error = "Field is required!";
            } else  if (!ctype_digit(strval($val))) {



                $this->$error = "PIN must be only numeric chars!";
            } else {



                $this->$field = $val;
            }
        }



        if (password_verify($this->current_pin, $pass[0]['pin'])) {



            if ($this->new_pin == $this->confirm_pin) {



                if (strlen($this->new_pin) < 6 || strlen($this->new_pin) > 6) {



                    $this->new_pin_error = "PIN must be between 4 - 6 digits!";
                } else {



                    if (password_verify($this->new_pin, $pass[0]['pin'])) {



                        $this->new_pin_error = "Current PIN and New PIN cannot be the same.";
                    } else {



                        if (UserModel::update(["data" => password_hash($this->new_pin, PASSWORD_BCRYPT), "column" => "pin", "userid" => $_SESSION['userid']])) {



                            $this->pin_success = "PIN Changed Successfully!";
                        } else {



                            $this->pin_failed = "Error: Something Went Wrong!";
                        }
                    }
                }
            } else {



                $this->confirm_pin_error = $this->new_pin_error = "PIN doesn't match!";
            }
        } else {



            $this->current_pin_error = "PIN Incorrect!";
        }
    }







    public function changePass($post)



    {



        $pass = UserModel::getSingleRecord(["table" => "auth", "column" => "userid", "data" => $_SESSION['userid']]);



        // validate password



        foreach ($post as $field => $val) {



            $error = $field . "_error";



            if (empty($val)) {



                $this->$error = "Field is required!";
            } else {



                $this->$field = $val;
            }
        }



        if (password_verify($this->current_pass, $pass[0]['password'])) {



            if ($this->new_pass == $this->confirm_pass) {



                if (password_verify($this->new_pass, $pass[0]['password'])) {



                    $this->new_pass_error = "Old and new password cannot be the same.";
                } else {



                    if (strlen($this->new_pass) < 8) {



                        $this->new_pass_error = "Password must be at least 8 characters";
                    } else {



                        if (UserModel::update(["data" => password_hash($this->new_pass, PASSWORD_BCRYPT), "column" => "password", "userid" => $_SESSION['userid']])) {



                            $this->pass_success = "Password Changed Successfully!";
                        } else {



                            $this->pass_failed = "Error: Something Went Wrong!";
                        }
                    }
                }
            } else {



                $this->confirm_pass_error = "Passwords doesn't match!";
            }
        } else {



            $this->current_pass_error = "Password incorrect!!";
        }
    }







    public function changeSecurity($post)



    {



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
            } else {



                $this->sec_failed = "Error: Something went wrong!";
            }
        }
    }







    public function paginate($table)



    {



        if (!isset($_GET['page'])) {



            $this->page = 1;
        } else {







            $this->page = intval($_GET['page']);



            if (!is_numeric($this->page) || $this->page < 1) {



                $this->page = 1;
            }
        }



        $limit = 15;







        $offset = (intval($this->page) - 1) * $limit;



        $data = UserModel::paginateRecord([



            "table" => $table,



            "column" => "account_id",



            "data" => $_SESSION['account_id'],



            "limit" => $limit,



            "offset" => $offset,



            "order" => "sort"



        ]);







        if ($data) {



            $this->pages = ceil(intval($data['total']) / $limit);



            if (intval($this->page) > $this->pages) {



                header("location: " . $_SERVER['PHP_SELF']);
            }



            return $data;
        } else {



            return false;
        }
    }







    public function upgradeLimit($post)



    {



        $data = [



            "daily" => $post['daily_limit'],



            "transaction" => $post['transaction_limit'],



            "account_id" => $_SESSION['account_id']



        ];



        if (UserModel::upgradeLimit($data)) {



            exit(json_encode(true));
        } else {



            exit(json_encode(false));
        }
    }







    public function inbox()



    {



        $this->messages = AdminModel::getMessage($_SESSION['userid']);



        if (isset($_GET['id'])) {



            if (!ctype_digit($_GET['id'])) {



                header("location: " . $_SERVER['PHP_SELF']);
            } else {



                if (UserModel::validateId(['id' => $_GET['id'], "userid" => $_SESSION['userid']])) {



                    $this->valid_msg = UserModel::getSingleRecord([



                        "table" => "message",



                        "column" => "id",



                        "data" => $_GET['id']



                    ]);



                    UserModel::markRead($_GET['id']);
                } else {



                    header("location: " . $_SERVER['PHP_SELF']);
                }
            }







            if (isset($_POST['action'])) {



                $action = AdminModel::deleteMessage([



                    "userid" => $_POST['user'],



                    "id" => $_POST['id']



                ]);







                if ($action) {



                    header("location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
    }



    public function payment()

    {

        return new PaymentController;
    }

    public function admin()
    {
        return new AdminController;
    }
}
