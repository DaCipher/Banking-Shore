<?php



namespace App\Model;



use App\Controllers\LoginController;

use App\Database\Database;



class AdminModel extends Database

{



    public static function getUsers()

    {

        $sql = "SELECT * FROM users WHERE userid NOT IN (SELECT userid FROM admin) AND userid IN (SELECT userid from auth)";

        $stmt = self::connect()->query($sql);

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetchAll();

            return $row;
        } else {

            return false;
        }
    }

    public static function getNewUsers()

    {

        $sql = "SELECT * FROM users JOIN accounts ON users.userid = accounts.userid WHERE users.userid NOT IN (SELECT auth.userid FROM auth) ORDER BY users.id DESC;";

        $stmt = self::connect()->query($sql);

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function getAdmins()

    {

        $sql = "SELECT * FROM users JOIN admin ON users.userid = admin.userid WHERE admin.role != 'webmaster'";

        $stmt = self::connect()->query(($sql));

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function getAccountOfficer()

    {

        $sql = "SELECT * FROM account_officer;";

        $query = self::connect()->query($sql);

        if ($query->rowCount() > 0) {

            $row = $query->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function joinTable($data)

    {

        $sql = "SELECT * FROM " . $data['table1'] . " JOIN " . $data['table2'] . " ON " . $data['table1'] . "." . $data['column1'] . " = " . $data['table2'] . "." . $data['column2'];

        if ($data['table2'] == "accounts") {

            $sql .= " WHERE " . $data['table1'] . ".userid IN (SELECT userid FROM auth)";
        }

        if ($data['table1'] == "users") {

            $sql .= " ORDER BY users.id DESC";
        }

        $query = Database::connect()->query($sql);

        if ($query->rowCount() > 0) {

            $row = $query->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function deleteTransaction(array $data)

    {

        $sql = "DELETE FROM " . $data['table'] . " WHERE account_id = :account_id AND id = :id";

        unset($data['table']);

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }

    public static function selectAll($table)

    {

        $sql = "SELECT * FROM " . $table . "  WHERE 1";

        $query = Database::connect()->query($sql);

        if ($query->rowCount() > 0) {

            $row = $query->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function deleteRecord($param)

    {

        $sql = "DELETE FROM " . $param['table'] . " WHERE " . $param['column'] . " = " . $param['data'];

        $query = self::connect()->query($sql);

        if ($query->rowCount() > 0) {

            return true;
        } else {

            return false;
        }
    }



    public static function approve($param)

    {

        $acc_officer = $param['account_officer_id'];

        unset($param['account_officer_id']);

        $sql2 = "UPDATE accounts SET account_officer_id = $acc_officer, account_status = 'active' WHERE userid = " . $param['userid'];

        $sql = "INSERT INTO auth (userid, password, pass_change) VALUES (:userid, :password, '1')";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($param)) {

            self::connect()->query($sql2);

            return true;
        } else {

            return false;
        }
    }

    public static function updateStatus($data)

    {

        $sql = "UPDATE accounts SET account_status = :status, account_restriction = :restriction WHERE account_id = :accountid";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }

    public static function updateAccountOfficer($data)

    {

        $sql = "UPDATE accounts SET account_officer_id = :officer_id WHERE userid = :userid";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }



    public static function addAccountOfficer($data)

    {

        $sql = "INSERT INTO account_officer (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }



    public static function updateFunds($data)

    {

        $sql = "UPDATE accounts set account_balance = :account_balance, daily_limit = :daily_limit, transaction_limit = :transaction_limit WHERE account_id = :account_id";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }



    public static function addAdmin($data)

    {

        $sql = "INSERT INTO admin (username, userid, role) VALUES (:username, :userid, 'admin')";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($data)) {

            return true;
        } else {

            return false;
        }
    }



    public static function addTransaction(array $param)

    {

        // Alert 

        $sql2 = "INSERT INTO alert (account_id, amount, transaction_type, date, reference, narration, sort) VALUES (:account, :amount, :type, :date, :reference, :narration, :sort)";

        $stmt2 = self::connect()->prepare($sql2);

        if ($stmt2->execute($param)) {

            // History 

            unset($param['reference']);

            $sql1 = "INSERT INTO transaction_history (account_id, amount, transaction_type, date, narration, sort) VALUES (:account, :amount, :type, :date, :narration, :sort)";

            $stmt1 = self::connect()->prepare($sql1);



            if ($stmt1->execute($param))

                return true;

            else

                return false;
        } else {

            return false;
        }
    }



    public static function status($data)

    {

        $sql = "SELECT userid FROM accounts WHERE " . $data['column'] . " != '" . $data['data'] . "'";

        $stmt = self::connect()->query($sql);

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function sendMessage($post)

    {

        $sql = "INSERT INTO message (sender, receiver, subject, message, date, sort) VALUES (:from, :to, :subject, :message, :date, :sort)";

        $stmt = self::connect()->prepare($sql);

        if ($stmt->execute($post)) {

            return true;
        } else {

            return false;
        }
    }



    public static function getMessage($id)

    {

        $sql = "SELECT * FROM message WHERE receiver = " . $id . " ORDER BY sort DESC";

        $stmt = self::connect()->query($sql);

        if ($stmt->rowCount() > 0) {

            $row = $stmt->fetchAll();

            return $row;
        } else {

            return false;
        }
    }



    public static function deleteMessage($data)

    {

        $sql = "DELETE FROM message WHERE receiver = " . $data['userid'] . " AND id = " . $data['id'];

        $stmt = self::connect()->query($sql);

        if ($stmt->rowCount() > 0) {

            return true;
        } else {

            return false;
        }
    }

    public static function updateToken(array $param): bool
    {
        $sql = "UPDATE accounts SET imf_required = " . $param['imf_required'] . ", imf_code = " . $param['imf_code'] . ", cot_required = " . $param['cot_required'] . ", cot_code = " . $param['cot_code'] . " WHERE account_id = " . $param['account'];
        if (Database::connect()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
