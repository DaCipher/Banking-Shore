<?php

namespace App\Database;

use App\Controllers\LoginController;

if (file_exists("../app/config.php")) {
    include "../app/config.php";
} else if (file_exists("../../app/config.php")) {
    include "../../app/config.php";
}

class Database
{

    public function __construct()
    {
        $this->connect();
    }
    public static function connect()
    {
        $options =  [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        try {
            $conn = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, $options);
            return $conn;
        } catch (\Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    /**
     * For INsert and Update Only
     *
     * @param String $sql SQL insert or update Statement
     * @param Array $param Named placeholders and values
     * @return bool
     */
    public function queryBind($sql, $param)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($param);
        if ($query->rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get single row from DB
     *
     * @param array $data table, column, data
     * @return array row
     */
    public static function getSingleRecord($data)
    {

        $sql = "SELECT * FROM " . $data['table'] . " WHERE " . $data['column'] . " = :data";
        $param = ["data" => $data['data']];
        if (isset($data['order'])) {
            $sql .= " ORDER BY " . $data['order'] . " DESC";
        }
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($param);
        if ($stmt->rowCount() > 0) {

            return $row = $stmt->fetchAll();
        } else {
            return false;
        }
    }
}
