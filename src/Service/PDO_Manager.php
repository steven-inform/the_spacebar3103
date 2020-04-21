<?php

namespace App\Service;

class PDO_Manager implements DBInterface
{
    private $pdo;

    /**
     * PDO_Manager constructor.
     */
    //public function __construct($db_host, $db_user, $db_paswd, $db_db)
    public function __construct()
    {
        //databaseconnectiegegevens goedzetten
        $dbdsn = 'mysql:host=185.115.218.166;dbname=wdev_steven';
        $this->pdo = new \PDO($dbdsn, 'wdev_steven', '******');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param $sql
     * @return array
     */
    public function GetData( $sql )
    {
        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        $rows = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * @param $sql
     * @return ExecuteResult
     */
    public function ExecuteSQL( $sql )
    {
        $executeResult = new ExecuteResult();

        $stm = $this->pdo->prepare($sql);

        $executeResult->ok = $stm->execute();
        $executeResult->rows_affected = $stm->rowCount();
        $executeResult->new_id = $this->pdo->lastInsertId();

        return $executeResult;
    }

}