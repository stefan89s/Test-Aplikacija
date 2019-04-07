<?php

abstract class Model {

    private $dbh;
    private $stmt;
    private $host = 'localhost';
    private $dbName = 'test-aplikacija';
    private $user = 'root';
    private $password = '';

    # Connecting to the database
    public function __construct() {
        $this->dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->password);
    }

    # Preparing the statement for query
    protected function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    # Binding the value
    protected function bind($param, $value, $type = null) {
        if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;	

				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
    }

    protected function execute() {
        $this->stmt->execute();
    }

    # Fetching all results and returning the associative array
    protected function fetchAll() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # Fetching only one result
    protected function fetchSingle() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

}