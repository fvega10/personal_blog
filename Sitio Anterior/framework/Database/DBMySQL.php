<?php namespace EasilyPHP\Database {

    use Mysqli;

    class DBMySQL extends DBAbstract
    {
        public function __construct($server, $database, $user, $password)
        {
            parent::__construct($server, $database, $user, $password);
        }

        public function connect()
        {
            $this->driver = new mysqli($this->server, $this->user, $this->password, $this->database);
            if ($this->driver->connect_errno) {
                printf("Failed to connect to MySQL: (%s) %s", $this->driver->connect_errno, $this->driver->connect_error);
                exit;
            }
        }
        public function disconnect()
        {
            $this->driver->close();
        }

        public function runSql($sql)
        {
            return $this->driver->query($sql);
        }

        /**
         * Retorna una "sentencia SQL preparada"
         * @return mysqli_stmt
         */
        public function prepareSql($sql)
        {
            return $this->driver->prepare($sql);
        }

        
        public function nextResultRow($result)
        {
            return $result->fetch_assoc();
        }

        public function getAll($result)
        {
          return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function getErrorMessage()
        {
            return $this->driver->error;
        }

        public function getErrorNumber()
        {
            return $this->driver->errno;
        }

        public function getError()
        {
            return $this->driver->errno . ' ' . $this->driver->error;
        }
    }
}