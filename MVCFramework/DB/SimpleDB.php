<?php
namespace MVCFramework\DB;

class SimpleDB
{
    protected $connection = 'default';
    /**
     * @var \PDO
     */
    private $db = null;
    /**
     * @var \PDOStatement
     */
    private $stmt = null;
    private $params = array();
    private $sql;

    public function __construct($connection = null){
        if($connection instanceof \PDO){
            $this->db = $connection;
        }
        else if($connection != null){
            $this->db = \MVCFramework\App::getInstance()->getDBConnection($connection);
            $this->connection = $connection;
        } else{
            $this->db = \MVCFramework\App::getInstance()->getDBConnection($this->connection);
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @param array $pdoOptions
     * @return \MVCFramework\DB\SimpleDB
     */
    public function prepare($sql, $params = array(), $pdoOptions = array()){
        $this->stmt = $this->db->prepare($sql, $pdoOptions);
        $this->params = $params;
        $this->sql = $sql;

        return $this;
    }

    /**
     * @param array $params
     * @return \MVCFramework\DB\SimpleDB
     *
     */
    public function execute($params = array()){
        // if the paramas are not passed in function prepare, can pass them here
        if($params){
            $this->params = $params;
        }

//        if($this->logSQL){
//            \MVCFramework\Logger::setInstance()->
//                set($this->sql . ' ' . print_r($this->params, true), 'db');
//        }

        $this->stmt->execute($this->params);

        return $this;
    }

    public function fetchAllAssoc(){
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc(){
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllNum(){
        return $this->stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public function fetchRowNum(){
        return $this->stmt->fetch(\PDO::FETCH_NUM);
    }

    public function fetchAllObject(){
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchRowObject(){
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchAllColumn($column){
        return $this->stmt->fetchAll(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchRowColumn($column){
        return $this->stmt->fetch(\PDO::FETCH_BOUND, $column);
    }

    public function fetchAllClass($class){
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function fetchRowClass($class){
        return $this->stmt->fetchAll(\PDO::FETCH_BOUND, $class);
    }

    public function getLastInsertId(){
        return $this->db->lastInsertId();
    }

    public function getAffectedRows(){
        return $this->stmt->rowCount();
    }

    public function getSTMT(){
        return $this->stmt;
    }
}

