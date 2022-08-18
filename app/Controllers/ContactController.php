<?php





namespace App\Controllers;





use App\Mail\Mail;





class ContactController


{





    public function __construct()


    {


        if (isset($_POST['contact'])) {





            // if (file_exists($php_email_form = '../app/Controllers/Mail.php')) {


            //     include($php_email_form);


            // } else {


            //     die('Unable to load the "PHP Email Form" Library!');


            // }





            $data = [


                "name" => ucwords(trim($_POST['name'])),


                "from" => "no-reply@financialshore.com",


                "replyTo" => strtolower(trim($_POST['email'])),


                "subject" => ucfirst($_POST['subject']),


                "body" => $_POST['message'],


                "alt_body" => $_POST['message'],


                "to" => "info@financialshore.com"


            ];





            if (Mail::mailSend($data)) {


                exit("OK");
            } else {


                exit("Sorry, Something Went Wrong!");
            }
        }
    }
}
