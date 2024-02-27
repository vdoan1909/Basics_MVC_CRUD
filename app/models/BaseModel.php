<?php

namespace App\Models;

use PDO;

class BaseModel
{
    private $pdo = NULL;
    private $sql = "";
    private $sta = NULL;

    public function __construct()
    {
        $this->pdo =  new PDO(
            "mysql:host=" . DBHOST
                . ";dbname=" . DBNAME
                . ";charset=" . DBCHARSET,
            DBUSER,
            DBPASS
        );
    }

    public function setQuery($sql)
    {
        $this->sql = $sql;
    }

    public function execute($options = array())
    {
        $this->sta = $this->pdo->prepare($this->sql);
        if ($options) {
            for ($i = 0; $i < count($options); $i++) {
                $this->sta->bindParam($i + 1, $options[$i]);
            }
        }
        $this->sta->execute();
        return $this->sta;
    }

    public function loadAllRows($options = array())
    {
        if (!$options) {
            if (!$result = $this->execute())
                return false;
        } else {
            if (!$result = $this->execute($options))
                return false;
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function loadRow($option = array(), $sql = "")
    {
        if (!$option) {
            if (!$result = $this->execute())
                return false;
        } else {
            if (!$result = $this->execute($option))
                return false;
        }
        return $result->fetch(PDO::FETCH_OBJ);
    }
}
