<?php

namespace App\Middleware;

/**
 * Validate form
 */

class Validate
{

    /**
     * Validate Form Input field
     * 
     * @param string $data Form field
     * 
     * @return string Trimmed form field
     */

    public function input($data)

    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        $data = ucfirst($data);

        return $data;
    }

    // validate Names

    public function field($input)

    {

        if (empty($input) || $input === null || !preg_match("/^[a-zA-Z]*$/", $input)) {

            return false;
        } else {

            return true;
        }
    }



    // validate username

    public function username($input)

    {

        if (empty($input) || $input === null || !preg_match("/^[\w]{4,20}$/i", $input)) {

            return false;
        } else {

            return true;
        }
    }



    // validate Mail

    public function email($mail)

    {

        if (empty($mail) || $mail === null || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {

            return false;
        } else {

            return true;
        }
    }

    /**
     * CRSF token generator
     *
     * @return void
     */
    public function csrf()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(64));
            $_SESSION['csrf_lifespan'] = time() + 3600; // One hour
        } else {
            if (time() >= $_SESSION['csrf_lifespan']) {
                unset($_SESSION['csrf_token']);
                unset($_SESSION['csrf_lifespan']);
            }
        }
    }

    /**
     * Instantiate Users Model
     * 
     * @return object Users Model Object
     */

    // public function  user()
    // {
    //     return new UserModel;
    // }
}
