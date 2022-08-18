<?php







namespace App\Controllers;







use App\Mail\Mail;



use App\Model\UserModel;



use App\Model\AdminModel;



use App\Middleware\Validate;



use App\Middleware\Authenticate;







class AdminController extends Validate



{







    public $user, $users, $history, $get_account, $admin, $is_admin;







    public $status_success, $status_fail;



    public $to, $from, $date, $subject, $message, $messages;



    public $to_error, $from_error, $date_error, $subject_error, $message_error;







    public $new_accounts, $account_officer, $uniqueUser, $inactive, $restricted;







    public $new_pass, $confirm_pass, $new_pass_error, $confirm_pass_error, $pass_success, $pass_failed;



    public $new_pin, $confirm_pin, $new_pin_error, $confirm_pin_error, $pin_success, $pin_failed;



    public $question, $answer, $question_error, $answer_error, $sec_success, $sec_failed;



    public function __construct()



    {



        Authenticate::isLogin();



        Authenticate::isAuthenticate();



        Authenticate::isAdmin($_SESSION['userid']);



        $this->users = AdminModel::joinTable([



            "table1" => "users",



            "table2" => "accounts",



            "column1" => "userid",



            "column2" => "userid",



            "column3" => "userid",



        ]);



        $this->user = UserModel::getSingleRecord([



            "table" => "users",



            "column" => "userid",



            "data" => $_SESSION['userid'],



        ]);



        $this->uniqueUser = AdminModel::getUsers();



        $this->account_officer = AdminModel::getAccountOfficer();



        $this->admin = AdminModel::getAdmins();



        $this->inactive = AdminModel::status(['column' => "account_status", "data" => "active"]);



        $this->inactive = AdminModel::status(['column' => "account_restriction", "data" => "open"]);



        $this->new_accounts = AdminModel::getNewUsers();



        if (isset($_GET['action'])) {



            if ($_GET['action'] == "logout") {



                UserController::logout();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/transaction/view-transactions.php") {



            if (isset($_GET['account'])) {



                $this->deleteHistory("transaction_history");
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/transaction/view-alerts.php") {



            if (isset($_GET['account'])) {



                $this->deleteHistory("alert");
            }
        }

        if ($_SERVER['SCRIPT_NAME'] == "/admin/settings/change-pin.php") {



            if (isset($_POST['change_pin'])) {

                $this->changePin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/account/new-account.php") {



            $this->new_accounts = AdminModel::getNewUsers();



            if (isset($_POST['delete'])) {



                $this->deleteAccount();
            }



            if (isset($_POST['approve'])) {



                $this->approve();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/account/view-accounts.php") {



            $this->new_accounts = AdminModel::getNewUsers();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/account/account-status.php") {



            if (isset($_POST['update'])) {



                $data = [



                    "status" => $_POST['status'],



                    "restriction" => $_POST['restriction'],



                    "accountid" => $_POST['account'],



                ];



                if (AdminModel::updateStatus($data)) {



                    $this->users = AdminModel::joinTable([



                        "table1" => "users",



                        "table2" => "accounts",



                        "column1" => "userid",



                        "column2" => "userid",



                        "column3" => "userid",



                    ]);



                    $this->status_success = "Status Updated!";
                } else {



                    $this->status_fail = "Error: Something went wrong!";
                }
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/account/account-officer.php") {



            if (isset($_POST['update'])) {



                $this->updateAccountOfficer();
            }



            if (isset($_POST['add'])) {



                $this->addAccountOfficer();
            }



            if (isset($_POST['del_officer'])) {



                $this->deleteAccountOfficer();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/account/account-funding.php") {



            if (isset($_POST['update'])) {



                $this->accountFunding();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/transaction/add-history.php") {



            if (isset($_POST['add'])) {



                $this->addTransaction();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/user/reset-password.php") {



            if (isset($_POST['change_pass'])) {



                $this->changePass();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/user/reset-pin.php") {



            if (isset($_POST['change_pin'])) {



                $this->changePin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/user/new-message.php") {



            if (isset($_POST['send'])) {



                $this->sendMessage();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/user/view-message.php") {



            $this->message();
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/admin/add-admin.php") {



            if (isset($_POST['add_admin'])) {



                $this->addAdmin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/admin/view-admin.php") {



            if (isset($_POST['delete'])) {



                $this->deleteAdmin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/admin/reset-password.php") {



            if (isset($_POST['change_pass'])) {



                $this->changePass();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/admin/reset-pin.php") {



            if (isset($_POST['change_pin'])) {



                $this->changePin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/admin/reset-security-questions.php") {



            if (isset($_POST['change_security'])) {



                $this->changeSecurity($_POST);
            }
        }

        if ($_SERVER['SCRIPT_NAME'] == "/admin/settings/change-password.php") {



            if (isset($_POST['change_pass'])) {



                $this->changePass();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/settings/change-pin.php") {



            if (isset($_POST['change_pin'])) {



                $this->changePin();
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/settings/change-security-questions.php") {



            if (isset($_POST['change_security'])) {



                $this->changeSecurity($_POST);
            }
        }



        if ($_SERVER['SCRIPT_NAME'] == "/admin/user/reset-security-questions.php") {



            if (isset($_POST['change_security'])) {



                $this->changeSecurity($_POST);
            }
        }

        if ($_SERVER['SCRIPT_NAME'] == "/admin/transaction/token.php") {



            if (isset($_POST['update'])) {



                $this->updateToken();
            }
        }
    }



    public function deleteHistory($table)



    {



        $this->get_account = $_GET['account'];



        $this->history = UserModel::getSingleRecord([



            "table" => $table,



            "column" => "account_id",



            "data" => $_GET['account'],



            "order" => "sort"



        ]);







        if (isset($_POST['action'])) {



            $action = AdminModel::deleteTransaction([



                "table" => $table,



                "account_id" => $this->get_account,



                "id" => $_POST['id']



            ]);



            if ($action) {



                $this->status_success = "Data Deleted Successfully";



                unset($_POST['id']);



                $this->get_account = $_GET['account'];



                $this->history = UserModel::getSingleRecord([



                    "table" => $table,



                    "column" => "account_id",



                    "data" => $_GET['account']



                ]);
            } else {



                $this->status_fail = "Error: Soemthing Went Wrong";
            }
        }
    }



    public function isAdmin($userid)



    {



        if (UserModel::isAdmin($userid)) {



            return true;
        } else {



            return false;
        }
    }







    public function deleteAccount()



    {











        if (isset($_POST['userid'])) {



            $data = [



                "table" => "users",



                "column" => "userid",



                "data" => $_POST['userid']



            ];
        }



        if (AdminModel::deleteRecord($data)) {



            $this->status_success = "Account Deleted!";



            $this->new_accounts = AdminModel::getNewUsers();
        } else {



            $this->status_failed = "Error: Something went wrong!";
        }
    }



    public function updateAccountOfficer()



    {



        $data = [



            "officer_id" => $_POST['account_officer_id'],



            "userid" => $_POST["userid"],



        ];







        if (AdminModel::updateAccountOfficer($data)) {



            $this->users = AdminModel::joinTable([



                "table1" => "users",



                "table2" => "accounts",



                "column1" => "userid",



                "column2" => "userid",



                "column3" => "userid",



            ]);



            $this->status_success = "Account Officer Updated!";
        } else {



            $this->status_failed = "Error: Something went wrong!";
        }
    }



    public function addAccountOfficer()



    {



        $response = [];



        $error = "";



        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['username'])) {



            $response['fields'] = "All fields are required!";



            $error = "set";
        } else {



            $fname = trim($_POST['firstname']);



            $lname = trim($_POST['lastname']);



            $uname = trim($_POST['username']);



            if ($this->field($fname)) {



                $firstname = $fname;
            } else {



                $response['invalid'] = "Invalid Name!";



                $error = "set fname";
            }



            if ($this->field($lname)) {



                $lastname = $lname;
            } else {



                $response['invalid'] = "Invalid Name!";



                $error = "set lname";
            }



            if (!preg_match("/^[a-z\d.]{2,40}$/i", $uname)) {



                if (strlen($uname) > 20) {



                    $response['invalid_email'] = "Username too long!";



                    $error = "set uiname long";
                } else {



                    $response['invalid_email'] = "Invalid Username!";



                    $error = "set email invalid";
                }
            } else {



                $username = $uname;



                $email = strtolower($username) . "@financialshore.com";



                if (UserModel::userExist(["table" => "account_officer", "column" => "email", "data" => $email])) {



                    $response['duplicate'] = "Email already exist!";



                    $error = "set duplicate";
                }
            }



            if (empty($error)) {



                $data = [



                    "firstname" => ucfirst($firstname),



                    "lastname" => ucfirst($lastname),



                    "email" => strtolower($email)



                ];







                if (AdminModel::addAccountOfficer($data)) {



                    $response['success'] = "Account Officer Added!";
                } else {



                    $response['error'] = "Error Adding Account Officer!";
                }
            }



            exit(json_encode($response));
        }
    }



    public function approve()



    {







        $id = [];



        // $id = mt_rand(1, count($this->account_officer));



        foreach ($this->account_officer as $officer) {



            array_push($id, $officer['id']);
        }



        $val = array_values($id);



        $count = count($val);



        $key = mt_rand(1, $count - 1);



        $acc_officer = $val[$key];



        $data = [



            "userid" => $_POST['userid'],



            "password" => password_hash("12345678", PASSWORD_BCRYPT),



            "account_officer_id" => $acc_officer



        ];



        if (AdminModel::approve($data)) {



            $user = UserModel::joinTable([



                "table1" => "users",



                "table2" => "accounts",



                "column1" => "userid",



                "column2" => "userid",



                "column3" => "userid",



                "data" => $_POST['userid'],



            ]);







            // Prep Alert for admin



            $mail_template_file = "../../templates/welcome.html";



            if (file_exists($mail_template_file)) {

                $mail_temp = file_get_contents($mail_template_file);
            } else {
                die("Unkwown Error");
            }







            $mail_body_param = [



                "{{firstname}}" => ucfirst($user['firstname']),



                "{{lastname}}" => ucfirst($user['lastname']),



                "{{middlename}}" => ucfirst($user['middlename']),



                "{{account_number}}" => $user['account_number'],



                "{{account_type}}" => ucfirst($user['account_type']),



                "{{userid}}" => $user['userid'],



                "{{year}}" => date("Y"),



                "{{password}}" => "12345678"



            ];







            $mail_body = str_replace(array_keys($mail_body_param), array_values($mail_body_param), $mail_temp);



            $mail_data = [



                'subject' => "Welcome to Financial Shore Bank " . ucfirst($user['firstname']),



                "body" => $mail_body,



                "from" => "no-reply@financialshore.com",



                "to" => $user['email'],



                "name" => "Financial Shore Bank",



                "to_name" => ucwords($user['firstname'] . " " . $user['lastname'])



            ];



            Mail::mailSend($mail_data);







            $this->status_success = "Account Approved, Details Sent to User!";
        } else {



            $this->status_fail = "Error approving account!";
        }



        $this->new_accounts = AdminModel::getNewUsers();
    }



    public function deleteAccountOfficer()



    {



        $response = [];



        $data = [



            "table" => "account_officer",



            "column" => "id",



            "data" => $_POST['officer_id']



        ];



        if (AdminModel::deleteRecord($data)) {



            $response['success'] = "Account Officer Deleted!";
        } else {



            $response['failed'] = "Error: Something went wrong!";
        }







        exit(json_encode($response));
    }







    public function accountFunding()



    {



        $data = [



            "daily_limit" => $_POST['daily_limit'],



            "transaction_limit" => $_POST['transaction_limit'],



            "account_balance" => $_POST['account_balance'],



            "account_id" => $_POST['account']



        ];







        if (AdminModel::updateFunds($data)) {



            $this->status_success = "Account Balance and Limits Updated!";



            $this->users = AdminModel::joinTable([



                "table1" => "users",



                "table2" => "accounts",



                "column1" => "userid",



                "column2" => "userid",



                "column3" => "userid",



            ]);
        } else {



            $this->status_fail = "Error processing request!";
        }
    }



    public function changePass()



    {



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



                    if (UserModel::update(["data" => password_hash($this->new_pass, PASSWORD_BCRYPT), "column" => "password", "userid" => $_POST['userid']])) {



                        $this->pass_success = "Password Changed Successfully!";
                    } else {



                        $this->pass_failed = "Error: Something Went Wrong!";
                    }
                }
            } else {



                $this->confirm_pass_error = "Passwords doesn't match!";
            }
        }
    }



    public function changePin()



    {



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
                } else {



                    if (UserModel::update(["data" => password_hash($this->new_pin, PASSWORD_BCRYPT), "column" => "pin", "userid" => $_POST['userid']])) {



                        $this->pin_success = "PIN Changed Successfully!";
                    } else {



                        $this->pin_failed = "Error: Something Went Wrong!";
                    }
                }
            } else {



                $this->confirm_pin_error =  $this->new_pin_error = "PIN doesn't match!";
            }
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



            $action = UserModel::updateSec(['sq' => $post['question'], "sqa" => password_hash($post['answer'], PASSWORD_BCRYPT), "id" => $post['userid']]);



            if ($action) {



                $this->sec_success = "Security question modified!";



                $this->question = $this->answer = "";
            } else {



                $this->sec_failed = "Error: Something went wrong!";
            }
        }
    }







    public function addAdmin()



    {



        $response = [];



        $error = "";



        if (empty($_POST['userid'])) {



            $response['user_error'] = "Select a User!";



            $error = "set";
        } else if (UserModel::userExist(["table" => "admin", "column" => "userid", "data" => $_POST['userid']])) {



            $error = "set";



            $response['user_error'] = "Already an admin!";
        } else {
        }



        if (empty($_POST['username'])) {



            $response['username_error'] = "Username required!";



            $error = "set";
        } else if (!preg_match("/^[a-z\d.]{2,20}$/i", $_POST['username'])) {



            if (strlen($_POST['username']) > 20) {



                $response['username_error'] = "Username too long!";



                $error = "set uiname long";
            } else {



                $response['username_error'] = "Invalid Username!";



                $error = "set email invalid";
            }
        } else {



            if (!empty($_POST['userid'])) {



                if (UserModel::userExist(["table" => "admin", "column" => "username", "data" => $_POST['username']])) {



                    $error = "set ";



                    $response['username_error'] = "Username taken!";
                }
            }
        }



        if (empty($error)) {



            $data = [



                "userid" => $_POST['userid'],



                "username" => $_POST['username']



            ];



            if (AdminModel::addAdmin($data)) {



                $response['success'] = ucfirst($_POST['username']) . " added as Admin!";
            } else {



                $response['fail'] = "Error adding admin";
            }
        }



        exit(json_encode($response));
    }







    public function deleteAdmin()



    {



        $data = [



            "table" => "admin",



            "column" => "userid",



            "data" => $_POST['account']



        ];







        if (AdminModel::deleteRecord($data)) {



            $this->status_success = "Admin Deleted!";



            $this->admin = AdminModel::getAdmins();
        } else {



            $this->status_fail = "Error procesing request";
        }
    }







    public function addTransaction()

    {
        $uDate = ((new \DateTime($_POST['date']))->format('U')) - (3600 * 5);



        function randCode(Int $min, Int $max = null)
        {

            $rand = str_replace(["Z", "X", "V", "K", "Q", "Y", "L"], "", str_shuffle(implode("", range("A", "Z"))));


            if (isset($max)) {



                $string = substr($rand, 0, rand($min, $max));
            } else {



                $string = substr($rand, 0, $min);
            }



            return $string;
        };



        $data = [



            "account" => $_POST['account_id'],



            "amount" => $_POST['amount'],



            "date" => date("d-M-Y H:i:s", $uDate),



            "sort" => date("Y-m-d H:i:s", $uDate),



            "type" => $_POST['transaction_type'],



            "reference" => "MB/" . mt_rand(00000000, 99999999) . "/" . strtoupper(bin2hex(random_bytes(2)))


        ];

        if ($_POST['transaction_type'] == "credit") {



            if ($_POST['transfer_type'] == "local") {



                $data['narration'] = "Transfer between customers from " . strtoupper($_POST['sender_name']) . " to " . strtoupper($_POST['account_name']) . " /" . substr($_POST['narration'], 0, 12);
            } else if ($_POST['transfer_type'] == "inter-bank") {



                $data["reference"] = randCode(2) . mt_rand(00000000, 99999999) . "/" . strtoupper(bin2hex(random_bytes(2)));



                $data['narration'] = mt_rand(0000000, 999999) . randCode(3, 4) . "/TRF/MOB FRM " . strtoupper($_POST['sender_name']) . " to " . strtoupper($_POST['account_name'] . ".../" . substr($_POST['narration'], 0, 12));
            }
        }

        if ($_POST['transaction_type'] == "debit") {
            if ($_POST['transfer_type'] == "local") {

                $data['narration'] = "Transfer between customers from " . strtoupper($_POST['account_name']) . " to " . strtoupper($_POST['reciever_name']) . " /" . substr($_POST['narration'], 0, 12);
            } else if ($_POST['transfer_type'] == "inter-bank") {

                $data['narration'] = mt_rand(0000000, 999999) . "/SEB/TRF/MOB FRM " . strtoupper($_POST['account_name']) . " to " . strtoupper($_POST['reciever_name'] . ".../" . substr($_POST['narration'], 0, 12));
            }
        }

        if (AdminModel::addTransaction($data)) {
            if (ceil((time() - $uDate) / 60) < 60) {
                $data["initiator"] = "admin";
                $this->alert($data);
            }
            $this->status_success = "Transaction Added!";
        } else {
            $this->status_fail = "Error processing request";
        }
    }

    public function sendMessage()
    {



        $errors = "";



        foreach ($_POST as $field => $val) {



            if ($field == "send") {



                break;
            }



            $error = $field . "_error";



            if (empty($val)) {



                $errors = $this->$field;



                $this->$error = "Field is required!";
            } else {



                $this->$field = $val;
            }
        }



        $uDate = (new \DateTime($this->date))->format('U');



        if (is_numeric($this->from)) {



            $errors = "set";



            $this->from_error = "Invalid name";
        }







        if (empty($errors)) {



            $data = [



                "from" => $this->from,



                "to" => $this->to,



                "subject" => $this->subject,



                "message" => $this->message,



                "date" => date('d-M-Y H:i', $uDate),



                "sort" => date("Y-m-d H:i:s", $uDate)



            ];







            if (AdminModel::sendMessage($data)) {



                $this->status_success = "Message Sent Successfully";
            } else {



                $this->status_fail = "Error: Message Not Sent!";
            }
        } else {



            die($errors);
        }
    }

    public function message()
    {



        if (isset($_GET['user'])) {



            $this->get_account = $_GET['user'];



            $this->messages = AdminModel::getMessage($this->get_account);
        }



        if (isset($_GET['user']) && isset($_POST['action'])) {



            $action = AdminModel::deleteMessage([



                "userid" => $_POST['user'],



                "id" => $_POST['id']



            ]);



            if ($action) {



                $this->status_success = "Data Deleted Successfully";



                unset($_POST['id']);



                unset($_POST['user']);



                $this->messages = AdminModel::getMessage($this->get_account);



                $this->get_account = $_GET['user'];
            } else {



                $this->status_fail = "Error: Soemthing Went Wrong";
            }
        }
    }

    public function updateToken(): void

    {

        if (AdminModel::updateToken($_POST)) {

            $this->status_success = "Token Updated!";

            $this->users = AdminModel::joinTable([



                "table1" => "users",



                "table2" => "accounts",



                "column1" => "userid",



                "column2" => "userid",



                "column3" => "userid",



            ]);
        } else {

            $this->status_fail = "Error: Something went wrong";
        }
    }

    public function alert($data)
    {
        $user = UserModel::joinTable([
            "table1" => "accounts",
            "column1" => "userid",
            "table2" => "users",
            "column2" => "userid",
            "column3" => "account_id",
            "data" => $data['account']
        ]);
        $mail_body_param = [
            "{{firstname}}" => strtoupper($user['firstname']),
            "{{lastname}}" => strtoupper($user['lastname']),
            "{{account_number}}" => $user['account_number'],
            "{{value_date}}" => date("d-M-Y", strtotime($data['date'])),
            "{{reference}}" => $data['reference'],
            "{{amount}}" => "$" . number_format($data['amount']),
            "{{narration}}" => $data['narration'],
            "{{time}}" => date("d-M-Y h:iA", strtotime($data['date'])),
            "{{type}}" => ucfirst($data['type']),
            "{{year}}" => date("Y")
        ];
        // Transaction Type
        if (isset($data['initiator'])) {
            if ($data['type'] == "credit") {
                $user_balance = intval($user['account_balance']) + intval($data['amount']);
                $mail_body_param['{{balance}}'] = "$" . number_format($user_balance);
            } else {
                $user_balance = intval($user['account_balance']) - intval($data['amount']);
                $mail_body_param['{{balance}}'] = "$" . number_format($user_balance);
            }
        } else {
            $mail_body_param['{{balance}}'] = "$" . number_format($user['account_balance']);
        }


        // Alert Template 
        $mail_template_file = "../../templates/alert.html";
        if (file_exists($mail_template_file)) {

            $mail_temp = file_get_contents($mail_template_file);
        } else {
            die("Unkwown Error");
        }
        $mail_body = str_replace(array_keys($mail_body_param), array_values($mail_body_param), $mail_temp);
        //Mail Header
        $mail_data = [
            'subject' => "FSB Transaction Notification",
            "body" => $mail_body,
            "from" => "no-reply@financialshore.com",
            "to" => $user['email'],
            "name" => "FSB Notification Service",
            "to_name" => ucwords($user['firstname'] . " " . $user['lastname'])
        ];
        if (isset($data['initiator'])) {
            UserModel::updateBalance($data['account'], $user_balance);
        }
        Mail::mailSend($mail_data);
    }
}
