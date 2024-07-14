<?php 
namespace app\Database;

require_once __DIR__."/../config/config.php";

Trait Data
{
    public $columnOrder = "date_created";
    public $order = "DESC";
    public $table = "";
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    public $dbname = ""; 

    public function connect()
    {
        $connection = new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DUSER, DPASS);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $connection;
    }

    public function selectAll($columnOrder = "", $order = "") :mixed
    {
        $connection = $this->connect();
        $query = "SELECT * FROM {$this->table} ORDER BY {$this->columnOrder} {$this->order}";
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($data) :bool
    {
        $connection = $this->connect();
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table(". implode(", ", $keys) . ") VALUES(:". implode(", :", $keys). ")";
        $statement = $connection->prepare($query);
        if ($statement->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data, $id, $id_column = "id") :bool
    {
        $connection = $this->connect();
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = :$key, ";
        }
        $query = rtrim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";
        $data[$id_column] = $id;
        $statement = $connection->prepare($query);
        if ($statement->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function where($data) :mixed
    {
        $connection = $this->connect();
        $query = "SELECT * FROM {$this->table} WHERE ";
        $keys = array_keys($data);
        foreach ($keys as $key) {
            $query .= "$key = :$key ";
        }
        $query = trim($query, " ");
        $query .= " ORDER BY {$this->columnOrder} {$this->order}";
        $statement = $connection->prepare($query);
        $statement->execute($data);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    } 

    public function delete($data) 
    {
        $connection = $this->connect();
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $statement = $connection->prepare($query);
        if ($statement->execute($data)) {
            return true;
        } else {
            return false;
        }
    }
}