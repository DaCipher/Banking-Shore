<?php



//Import PHPMailer classes into the global namespace



//These must be at the top of your script, not inside a function



namespace App\Mail;







use PHPMailer\PHPMailer\PHPMailer;



use PHPMailer\PHPMailer\SMTP;



use PHPMailer\PHPMailer\Exception;







// Require Config



//require_once '../config.php';







//Load Composer's autoloader



// require '../vendor/autoload.php';







class Mail



{



    /** 



     *  Set email format to HTML 



     * @param array $param Includes, Receipient Address, body, subject and Alt body



     * 



     * @return void



     * */



    public static function  mailSend($param)



    {



        //Create an instance; passing `true` enables exceptions



        $mail = new PHPMailer(true);







        //Server settings



        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output 







        // SMTP::DEBUG_OFF = off (for production use)







        // SMTP::DEBUG_CLIENT = client messages







        // SMTP::DEBUG_SERVER = client and server messages







        $mail->isSMTP();                                            //Send using SMTP



        $mail->Host       = 'standardexpressbank.com';                     //Set the SMTP server to send through



        $mail->SMTPAuth   = false;                                   //Enable SMTP authentication



        // $mail->Username   = 'username';                     //SMTP username



        // $mail->Password   = 'password';                               //SMTP password



        $mail->SMTPSecure = "tls"; //PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption



        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`







        //Recipients



        $mail->setFrom($param['from'], $param['name']);



        // $mail->setFrom("spiralt9@gmail.com", 'SEB Admin');



        //Add a recipient



        if (isset($param['to_name'])) {



            $mail->addAddress($param['to'], $param['to_name']);
        } else {



            $mail->addAddress($param['to']);
        }



        // $mail->addAddress('liljoshprime@gmail.com');     //Add a recipient



        // $mail->addAddress('ellen@example.com');               //Name is optional



        if (isset($param['replyTo'])) {



            $mail->addReplyTo($param['replyTo'], $param['name']);
        }






        if (isset($param['cc'])) {
            $mail->addCC($param['cc'], $param['cc_name']);
        }

        if (isset($param['bcc'])) {
            $mail->addBCC($param['bcc'], $param['bcc_name']);
        }










        //Attachments



        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments



        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name







        //Content



        $mail->isHTML(true);



        $mail->Subject = $param['subject'];



        $mail->Body    = $param['body'];



        // $mail->AltBody = $param['alt_body'];



        try {



            $mail->send();



            // echo 'Message has been sent';



            return true;
        } catch (Exception $e) {



            die("Error: Request Failed: {$mail->ErrorInfo}");



            return false;
        }
    }
}
