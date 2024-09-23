<?php
namespace MyApp\Models{
    use \EasilyPHP\Database\DBMySQL;

    class Contact
    {
        private $db    = null;
        private $error = false;
        private $msg   = "";

        public function __construct($config)
        {
            $this->db = new DBMySQL(
                $config['server'],
                $config['database'],
                $config['user'],
                $config['password']);
            $this->clearError();
        }

        public function isError()
        {
            return $this->error;
        }
        public function msgError()
        {
            return $this->msg;
        }

        public function clearError()
        {
            $this->error = false;
            $this->msg   = "";
        }
        
        public function getAllMessages()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT * FROM messages");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }

        public function store($email, $message)
        {
            $this->clearError();
            $this->db->connect();
            $date = date("Y-m-d");
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("INSERT INTO messages(`email`, `user_message`, `date_message`) VALUES (?, ?, ?)")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            
            if (!$stmt->bind_param("sss", $email, $message, $date)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
    }
}
