<?php
require_once ('dbconfig.php');
/**
 * Class dbh
 * connects, queries, closes db connection
 * Dbh is the only class that connects to db
 */
class Dbh{

    /**
     * @var string servername
     * @var string dbname
     * @var string username
     * @var string password
     * private - tik šios klasės metodai galėtų naudoti šiuos parametrus
     */
    private $servername = DBHOST;
    private $dbname     = DBNAME;
    private $username   = DBUSER;
    private $password   = DBPASW;

    private $conn;

    /**
     * Dbh constructor.
     * After creating an object of the class - call connect method
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * connects to database
     * private - can only be accessed inside this class
     */
    private function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password,  $this->dbname );
        if($this->conn->connect_error)
            die('Connect Error (' . $this->conn->connect_error.')');
    }

    /**
     * @param $sql
     * queries the database
     * @return object|bool
     * returns result if any rows were found
     * else return false
     */
    public function query($sql)
    {
        $result = $this->conn->query($sql);
        if($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    /**
     * close db connection
     */
    public function closeConn()
    {
        if(isset($this->conn))
        {
            $this->conn->close();
            unset($this->conn);
        }
    }

}
