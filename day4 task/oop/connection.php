<?php




class DB
{
    protected $dbhost;
    protected $dbType;
    protected $dbName;
    protected $userName;
    protected $password;
    protected $connection;
    function __construct($host, $type, $dbname, $password, $uName)
    {

        $this->dbhost = $host;
        $this->dbType = $type;
        $this->dbName = $dbname;
        $this->userName = $uName;
        $this->password = $password;
        // $connection = new PDO("$dbType:host=$dbhost;dbname=$dbName", $userName, $password);

        $this->connection = new PDO("$this->dbType:host=$this->dbhost;dbname=$this->dbName", $this->userName, $this->password);
    }

    // select all Data
    function index($table)
    {
        try {
            //code...
            $query = "select * from $table";
            $sqlQuery = $this->connection->prepare($query);
            $sqlQuery->execute();
            $data = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Error $e) {
            //throw $th;

            echo $e->getMessage();
        }
    }

    function show($table, $id, $pk = 'id')
    {
        try {
            //code...
            $query = "select * from $table where $pk=:$pk";
            $sqlQuery = $this->connection->prepare($query);
            $sqlQuery->execute([
                $pk => $id
            ]);
            $data = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Error $e) {

            echo $e->getMessage();
        }
    }
    function create($table, $data)
    {
        try {
            $dataKeys = array_keys($data);
            $stringDataKeys = implode(',', $dataKeys);
            
            $placeholders = implode(',', array_fill(0, count($data), '?'));
            $dataValues = array_values($data);

            $query = "insert into $table($stringDataKeys)values($placeholders)";
            $sqlQuery = $this->connection->prepare($query);
            $result = $sqlQuery->execute($dataValues);

            if ($result) {
                return "created successfully";
            } else {
                return "check your data";
            }
        } catch (Error $e) {
            echo $e->getMessage();
        }
    }

    function delete($table, $id, $pk = 'id')
    {
        try {
            $query = "delete from $table where $pk=:$pk";
            $sqlQuery = $this->connection->prepare($query);
            $result = $sqlQuery->execute([
                $pk => $id
            ]);
            return $result;
        } catch (Error $e) {
            echo $e->getMessage();
        }
    }

    function update($table, $id, $data, $pk = 'id')
    {
        try {
            $setParts = [];
            foreach (array_keys($data) as $key) {
                $setParts[] = "$key = :$key";
            }
            $setString = implode(', ', $setParts);
            
            $query = "update $table set $setString where $pk=:$pk";
            $sqlQuery = $this->connection->prepare($query);
            
            $data[$pk] = $id;
            $result = $sqlQuery->execute($data);
            
            return $result;
        } catch (Error $e) {
            echo $e->getMessage();
        }
    }
}

$db=new DB("localhost","mysql","iti_sm_php_g2_2026","","root");
// var_dump($db);