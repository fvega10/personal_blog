<?php
namespace MyApp\Models{
    use \EasilyPHP\Database\DBMySQL;
    class User
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
        public function getError()
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
        public function authenticate($email, $password)
        {
            $this->clearError();
            $this->db->connect();
            /* Prepared statement, stage 1: prepare */
            $sql = "SELECT `id`, `fullname`, `username`, `email`, `role`, `blocked` FROM users WHERE `email` = ? AND `password` = md5(?)";
            if (!($stmt = 
                $this->db->prepareSql($sql))) {
                $this->msg = "Prepare failed: (" .  $this->db->getError() . ") " . $this->db->getErrorMessage();
                $this->$error = true;
            }
            if (!$stmt->bind_param("ss", $email, $password)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                $this->$error = true;
            }
            if (!$stmt->execute()) {
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $this->error = true;
            }
            $result = $stmt->get_result();
            $this->db->disconnect();
            return $this->db->nextResultRow($result);    
        }
        public function store($email, $password){
            $this->clearError();
            $this->db->connect();
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("INSERT INTO users(`email`, `password`) VALUES (?, md5(?))")))
            {
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }
            if (!$stmt->bind_param("ss", $email, $password)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            if (!$stmt->execute())
            {
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $this->error = true;
            }
            $this->db->disconnect();
        }
        public function delete($id)
        {
        }
        public function getUserById($id)
        {
        }
        public function update($id, $fullname, $username, $user_color)
        {
        }
    }
}

