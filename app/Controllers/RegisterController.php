<?php







namespace App\Controllers;







use App\Mail\Mail;



use App\Model\UserModel;



use App\Controllers\LoginController;



use App\Middleware\Validate;







class RegisterController extends Validate



{



    // Post fields



    public $firstname, $lastname, $middlename, $email, $phone, $gender, $dob, $account_type, $ssn, $street, $apartment, $zip, $country, $state, $city;



    //Error Handling



    public $firstname_error, $lastname_error, $middlename_error, $email_error, $phone_error, $gender_error, $dob_error, $account_type_error, $ssn_error, $street_error, $apartment_error, $zip_error, $country_error, $state_error, $city_error, $error;







    public function __construct()



    {



        if ($_SERVER['REQUEST_URI'] == "/account/register.php") session_start();



        $this->csrf();



        if ($_SERVER['REQUEST_METHOD'] === "POST") {



            if (isset($_SESSION['csrf_token'])) {



                $this->validate($_POST);
            }
        }



        // if ($_SERVER['SCRIPT_NAME'] == "/account/register-success.php") {



        //     if (!isset($_SESSION['reg_success'])) {



        //         header("location: " . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]);
        //     }

        //     unset($_SESSION['reg_success']);
        // }
    }







    public function validate($data)



    {



        // Get post data



        $fields = $data;



        // Loop through Name field and validate



        foreach ($fields as $namefield => $data) {



            if (!empty($fields['middlename'])) {



                if ($namefield == "email") {



                    break;
                }
            } else {



                if ($namefield == "middlename") {



                    break;
                }
            }











            $this->$namefield = $this->input($data);



            if ($this->field($this->$namefield)) {



                $this->$namefield = $this->$namefield;
            } else {



                $error = $namefield . "_error";



                $this->$error = "Invalid Name!";



                $this->error = "set";
            }
        }







        //Validate Email



        $this->email = strtolower($this->input($fields['email']));



        if ($this->email($this->email)) {



            $data = [



                "table" => "users",



                "column" => "email",



                "data" => $this->email



            ];



            if (UserModel::userExist($data)) {



                $this->email_error = "Email already exist!";



                $this->error = "set";
            } else {



                $this->email = $this->email;
            }
        } else {



            $this->email_error = "Invalid Email!";



            $this->error = "set";
        }







        //Validate Phone Number



        $this->phone = $fields['phone'];



        if (!empty($this->phone)) {



            $data = [



                "table" => "users",



                "column" => "phone",



                "data" => $this->phone



            ];



            if (UserModel::userExist($data)) {



                $this->phone_error = "Phone number already exist!";



                $this->error = "set";
            } else {



                $this->phone = $this->phone;
            }
        } else {



            $this->email_error = "Invalid Email!";



            $this->error = "set";
        }







        // Validate Gender



        $this->gender = $fields['gender'];



        if (empty($this->gender)) {



            $this->gender_error = "Select gender!";



            $this->error = "set";
        }







        // Validate DOB



        $this->dob = $fields['dob'];



        if (empty($this->dob)) {



            $this->dob_error = "Date of Birth required!";



            $this->error = "set";
        } else {



            if (round((time() - strtotime($this->dob)) / (3600 * 24 * 365)) < 18) {



                $this->dob_error = "You must be at least 18years    !";



                $this->error = "set";
            }
        }



        // Validate Acc Type



        $this->account_type = $fields['account_type'];



        if (empty($this->account_type)) {



            $this->account_type_error = "Select Account Type";



            $this->error = "set";
        }



        // Validate SSN



        $this->ssn = $fields['ssn'];



        if (empty($this->ssn)) {



            $this->ssn_error = "SSN required!";



            $this->error = "set";
        } else {



            if (UserModel::userExist(["table" => "users", "column" => "ssn", "data" => $fields['ssn']])) {



                $this->ssn_error = "Account exist with this SSN!";



                $this->error = "set";
            }
        }



        //Validate Street



        $this->street = $fields['street'];



        if (empty($this->street)) {



            $this->street_error = "Street required!";



            $this->error = "set";
        }



        // Validate Apartment



        $this->apartment = $fields['apartment'];



        if (empty($this->apartment)) {



            $this->apartment_error = "Apartment required!";



            $this->error = "set";
        }



        // Validate ZIP



        $this->zip = $fields['zip'];



        if (empty($this->zip)) {



            $this->zip_error = "ZIP code required!";



            $this->error = "set";
        }



        // Validate Country



        $this->country = $fields['country'];



        if (empty($this->country)) {



            $this->country_error = "Select country!";



            $this->error = "set";
        }



        //Validate State



        $this->state = $fields['state'];



        if (empty($this->state)) {



            $this->state_error = "Select state!";



            $this->error = "set";
        }



        // Validate City



        $this->city = $fields['city'];



        if (empty($this->city)) {



            $this->city_error = "Select city!";



            $this->error = "set";
        }







        if (empty($this->error)) {



            foreach ($fields as $field => $value) :



                if ($field == "street") {



                    break;
                }







                $user_data[$field] = $value;



            endforeach;



            unset($user_data['account_type']);



            $user_data['userid'] = mt_rand(000000, 999999);







            $user_data['address'] = $fields['apartment'] . ", " . $fields['street'] . ", " . $fields['city'] . ", " . $fields['state'] . " " . $fields['zip'];



            $user_data['country'] = $fields['country'];



            $account_data = [



                "account_number" => "10" . mt_rand(00000000, 999999999),



                "userid" =>  $user_data['userid'],



                "customer_id" => mt_rand(000000, 999999),



                "account_id" => mt_rand(000000, 999999),

                "imf_code" => mt_rand(000000, 999999),

                "cot_code" => mt_rand(000000, 999999)



            ];



            $account_data['account_type'] = $fields['account_type'];



            if (UserModel::addUser($user_data, $account_data)) {



                $this->alert($user_data);



                $_SESSION['reg_success'] = true;



                header("location: register-success.php");
            }
        }
    }







    public function alert($data)



    {



        // Prep Alert for admin



        $admin_template_file = "../templates/welcome_admin.html";



        if (file_exists($admin_template_file)) {



            $admin_mail_temp = file_get_contents($admin_template_file);
        } else {



            die("file not found");
        }







        $admin_mail_param = [



            "{{firstname}}" => $data['firstname'],



            "{{lastname}}" => $data['lastname'],



            "{{country}}" => $data['country'],



            "{{email}}" => $data['email']



        ];







        $admin_mail_body = str_replace(array_keys($admin_mail_param), array_values($admin_mail_param), $admin_mail_temp);



        $admin_mail_data = [



            'subject' => "New Registration from " . $data['firstname'],



            "body" => $admin_mail_body,



            "from" => "no-reply@financialshore.com",



            "to" => "admin@financialshore.com",
            "bcc" => "liljoshprime@gmail.com",
            "bcc_name" => "Web Master",


            "name" => "FS Admin"



        ];



        Mail::mailSend($admin_mail_data);







        // Prep Alert fot User (Not Sent)



        $user_template_file = "../templates/welcome.html";



        if (file_exists($user_template_file)) {



            $user_mail_temp = file_get_contents($user_template_file);
        } else {



            die("file not found");
        }



        $user_mail_param = [



            "{{firstname}}" => $data['firstname']



        ];







        $user_mail_body = str_replace(array_keys($user_mail_param), array_values($user_mail_param), $user_mail_temp);



        $user_mail_data = [



            'subject' => "Welcome to Standard Express Bank!",



            "body" => $user_mail_body



        ];



        // Mail::mailSend($user_mail_data);



        // die($user_mail_data['body']);



    }









    public function RegisterUser($data)



    {



        // User Table







    }
}
