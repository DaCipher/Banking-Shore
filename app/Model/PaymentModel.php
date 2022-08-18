<?php

namespace App\Model;

use App\Database\Database;

class PaymentModel
{

    public static function getCode(String $account_id)
    {
        $sql = "SELECT imf_required, imf_code, cot_required, cot_code FROM accounts WHERE account_id = '$account_id'";
        $query = Database::connect()->query($sql);
        $row = $query->fetch();
        return $row;
    }

    public static function clearReq($req, $id)
    {
        $sql = "UPDATE accounts SET $req = '2' WHERE account_id = '$id'";
        Database::connect()->query($sql);
    }

    public static function resetReq($id): void
    {
        $cot_code = mt_rand(000000, 999999);
        $imf_code = mt_rand(000000, 999999);
        $sql = "UPDATE accounts SET imf_required = 1, cot_required = 1, imf_code = '$imf_code', cot_code = '$cot_code' WHERE account_id = $id";
        Database::connect()->query($sql);
    }
}
