<?php

namespace Libs\Database;

use PDO;
use PDOException;

class MySQL
{

    // constructor 
    private $db;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;

    public function __construct(
        $dbhost = "localhost",
        $dbuser = "root",
        $dbpass = "root123",
        $dbname = "project"
    ) {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
    }

    public function connect()
    {
        echo "MySQL connect <br>";

        try {
            $this->db = new PDO(
                "mysql:dbhost=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
            return $this->db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
