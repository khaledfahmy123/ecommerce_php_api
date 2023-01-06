<?php


class Database
{
    private string $host;
    private string $dbName;
    private string $user;
    private string $password;

    public function __construct(string $hostP, string $dbNameP, string $userP, string $passwordP)
    {
        $this->host = $hostP;
        $this->dbName = $dbNameP;
        $this->user = $userP;
        $this->password = $passwordP;
    }
        

    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);
    }
}


?>