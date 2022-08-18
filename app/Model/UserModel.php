<?php







namespace App\Model;







use App\Controllers\LoginController;



use App\Database\Database;







class UserModel  extends Database



{











    public static function userExist($data)



    {







        $stmt = self::getSingleRecord($data);



        if ($stmt) {



            return true;
        } else {



            return false;
        }
    }







    public static function isAdmin($data)



    {



        $param = [



            "table" => "admin",



            "column" => "userid",



            "data" => $data



        ];



        if (self::userExist($param)) {



            $row = self::getSingleRecord($param);



            return $row;
        } else {



            return false;
        }
    }







    public static function addUser($user, $account)



    {



        $sql = "INSERT INTO users (userid, firstname, lastname, middlename, email, phone, gender, dob, ssn, address, country) VALUES (:userid, :firstname, :lastname, :middlename, :email, :phone, :gender, :dob, :ssn, :address, :country)";







        if (self::insertRecord($sql, $user)) {



            $sql2 = "INSERT INTO accounts (userid, customer_id, account_id, account_number, account_type, cot_code, imf_code) VALUES (:userid, :customer_id, :account_id, :account_number, :account_type, :cot_code, :imf_code)";







            if (self::insertRecord($sql2, $account)) {







                return true;
            } else {







                return false;
            }
        } else {



            return false;
        }
    }







    public static function insertRecord(String $sql, array $param)



    {



        $stmt = self::connect()->prepare($sql);



        $query = $stmt->execute($param);



        if ($query) {



            return true;
        } else {



            return false;
        }
    }







    public static function joinTable($data)



    {



        $sql = "SELECT * FROM " . $data['table1'] . " JOIN " . $data['table2'] . " ON " . $data['table1'] . "." . $data['column1'] . " = " . $data['table2'] . "." . $data['column2'] . " WHERE " . $data['table1'] . "." . $data['column3'] . " = " . $data['data'];

        $query = Database::connect()->query($sql);



        if ($query->rowCount() > 0) {



            if ($data['table2'] == "account_officer") {



                $row = $query->fetchAll();
            } else {



                $row = $query->fetch();
            }


            return $row;
        }
    }







    public static function getAccnumber($post)



    {



        $sql = "SELECT users.firstname, users.middlename, users.lastname FROM users JOIN accounts ON users.userid = accounts.userid WHERE accounts.account_number NOT IN (SELECT account_number FROM accounts WHERE account_id = :userid) AND accounts.account_number = :post";



        $stmt = Database::connect()->prepare($sql);



        $stmt->execute(["post" => $post['account_number'], "userid" => $post['from_acc']]);



        if ($stmt->rowCount() > 0) {



            $row = $stmt->fetch();



            return $row;
        } else {



            return false;
        }
    }







    public static function localtransaction($from_param, $to_param = null)



    {







        $sender = self::getSingleRecord(['table' => 'accounts', 'column' => 'account_id', 'data' => $from_param["account_id"]]);



        $sender_data = self::getSingleRecord(["table" => "users", "column" => "userid", "data" => $sender[0]["userid"]]);



        $sender_name = $sender_data[0]['firstname'] . " " . $sender_data[0]['lastname'];



        if ($to_param != null) {



            $reciever = self::getSingleRecord(['table' => 'accounts', 'column' => 'account_number', 'data' => $to_param["to-acc"]]);



            $receiver_data = self::getSingleRecord(["table" => "users", "column" => "userid", "data" => $reciever[0]["userid"]]);



            $receiver_name = $receiver_data[0]['firstname'] . " " . $receiver_data[0]['lastname'];



            $description = "Transfer between customers from " . strtoupper($sender_name) . " to " . strtoupper($receiver_name);



            $from_param['narration'] = $description . "/ " . $from_param['narration'];
        } else {



            $description = mt_rand(0000000, 999999) . "SEB/TRF/MOB FRM " . strtoupper($sender_name) . " to " . strtoupper($from_param['to-acc-name'] . "...");



            $from_param['narration'] = $description . "/ " . $from_param['narration'];



            unset($from_param['to-acc-name']);
        }







        // LoginController::dd($description);



        //Sender



        // Alert



        $sender_sql = "INSERT into alert (account_id, amount, currency, transaction_type, date, reference, narration, sort) VALUES (:account_id, :amount, :currency, :from_transaction_type, :date, :reference, :narration, :sort)";



        // LoginController::dd($from_param);



        $sender_stmt = Database::connect()->prepare($sender_sql);



        $sender_stmt->execute($from_param);



        // History



        $sender_sql2 = "INSERT into transaction_history (account_id, amount, date, narration, transaction_type, sort) VALUES (:account_id, :amount, :date, :narration, :transaction_type, :sort)";



        $sender_stmt2 = Database::connect()->prepare($sender_sql2);



        $sender_stmt2->execute([



            "account_id" => $from_param['account_id'],



            'amount' => $from_param['amount'],



            'date' => $from_param['date'],



            "narration" => $description,



            "transaction_type" => $from_param['from_transaction_type'],



            'sort' => date("Y-m-d H:i:s", time()),



        ]);



        //Update Balance







        $sender_new_balance = intval($sender[0]['account_balance']) - intval($from_param['amount']);



        $sender_stmt3 = Database::connect()->query("UPDATE accounts SET account_balance = '$sender_new_balance' WHERE account_id = '" . $from_param['account_id'] . "'");



        if ($sender_stmt->rowCount() > 0 && $sender_stmt2->rowCount() > 0 && $sender_stmt3) {







            if ($to_param !== null) {



                //Mail Sender Paramater







                // Merge Params



                unset($from_param['from_transaction_type']);



                $to_acc = $to_param['to-acc'];



                unset($to_param['to-acc']);



                $to_param = array_merge($from_param, $to_param);



                //Process Reciever



                $to_param['account_id'] = $reciever[0]['account_id'];



                //Alert



                $to_sql = "INSERT into alert (account_id, amount, currency, transaction_type,date, reference, narration, sort) VALUES (:account_id, :amount, :currency, :to_transaction_type, :date, :reference, :narration, :sort)";



                $reciever_stmt = Database::connect()->prepare($to_sql);



                $reciever_stmt->execute($to_param);



                //History



                $reciever_sql2 = "INSERT into transaction_history (account_id, amount, date, narration, transaction_type, sort) VALUES (:account_id, :amount, :date, :narration, :transaction_type, :sort)";



                $reciever_stmt2 = Database::connect()->prepare($reciever_sql2);



                $reciever_stmt2->execute([



                    "account_id" => $reciever[0]['account_id'],



                    'amount' => $to_param['amount'],



                    'date' => $to_param['date'],



                    "narration" => $description,



                    "transaction_type" => $to_param['to_transaction_type'],



                    "sort" => $to_param['sort']



                ]);







                //Update Balance



                $reciever_new_balance = intval($reciever[0]['account_balance']) + intval($to_param['amount']);



                $reciever_stmt3 = Database::connect()->query("UPDATE accounts SET account_balance = '$reciever_new_balance' WHERE account_id = '" . $reciever[0]['account_id'] . "'");



                if ($reciever_stmt->rowCount() > 0 && $reciever_stmt2->rowCount() > 0 && $reciever_stmt3) {



                    return true;
                } else {



                    return false;
                }
            }



            return true;
        } else {



            return false;
        }
    }











    /**



     * Paginate result from DB



     * 



     * @param array $datas table, column, data limit, offset



     *



     * @return array $row Multidimentional array results, total result



     */



    public static function paginateRecord($datas)



    {



        $sql2 = "SELECT * FROM " . $datas['table'] . " WHERE " . $datas['column'] . " = " . $datas['data'];







        $stmt2 = Database::connect()->query($sql2);



        if ($stmt2->rowCount() > 0) {



            $row['total'] = $stmt2->rowCount();



            if ($row['total'] < $datas['offset']) $datas['offset'] = 0;



            $sql = "SELECT * FROM " . $datas['table'] . " WHERE " . $datas['column'] . " = " . $datas['data'];



            if (isset($datas['order'])) {



                $sql .= " ORDER BY " . $datas['order'] . " DESC";
            }



            $sql .= " LIMIT " . $datas['offset'] . ", " . $datas['limit'];



            $stmt = Database::connect()->query($sql);



            $row['result'] = $stmt->fetchAll();



            return $row;
        } else {



            return false;
        }
    }







    public static function update(array $data)



    {



        $sql = "UPDATE auth SET " . $data['column'] . " = :data WHERE userid = :userid";



        $stmt = self::connect()->prepare($sql);



        if ($stmt->execute(['data' => $data['data'], "userid" => $data['userid']])) {



            return true;
        } else {



            return false;
        }
    }



    public static function updateSec($data)



    {



        $sql = "UPDATE auth set sq = :sq , sqa = :sqa WHERE userid = :id";



        $stmt = self::connect()->prepare($sql);



        if ($stmt->execute($data)) {



            return true;
        } else {



            return false;
        }
    }







    public static function transactions($userid, $date)



    {



        $sql = "SELECT SUM(amount) AS amount FROM transaction_history WHERE account_id = '$userid' AND date LIKE '$date%' AND transaction_type = 'debit'";



        $stmt = self::connect()->query($sql);



        $row = $stmt->fetch();



        return $row;
    }







    public static function upgradeLimit(array $data)



    {



        $sql = "UPDATE accounts SET daily_limit = :daily, transaction_limit = :transaction WHERE account_id = :account_id";



        $stmt = self::connect()->prepare($sql);



        if ($stmt->execute($data)) {



            return true;
        } else {



            return false;
        }
    }







    public static function validateId($param)



    {



        $sql = "SELECT receiver FROM message where id = '" . $param['id'] . "'";



        $stmt = self::connect()->query($sql);



        if ($stmt->rowCount() > 0) {



            $receiver = $stmt->fetch();



            if ($receiver == "all" || $receiver = $param['userid']) {



                return true;
            } else {



                return false;
            }
        } else {



            return false;
        }
    }







    public static function markRead($id)



    {



        $sql = "UPDATE message SET is_read = 1 WHERE id = '" . $id . "'";



        self::connect()->query($sql);
    }







    public static function passChange($id)



    {



        $sql = "UPDATE auth SET pass_change = 0 WHERE userid = '$id'";



        self::connect()->query($sql);
    }

    public static function updateBalance($account_id, $balance)
    {
        $sql = "UPDATE accounts SET account_balance = '$balance' WHERE account_id = $account_id";
        Database::connect()->query($sql);
    }
}
