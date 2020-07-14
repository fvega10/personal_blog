<?php
namespace MyApp\Models{
    use \EasilyPHP\Database\DBMySQL;

    class Category
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
        
        public function getAllCategories()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT * FROM category");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }

        public function getCategoryById($id)
        {
            $this->clearError();
            $this->db->connect();

            /* Prepared statement, stage 1: prepare */
            if (!($stmt = 
                $this->db->prepareSql("SELECT *  FROM category WHERE id = ?"))) {
                $this->msg = "Prepare failed: (" .  $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            if (!$stmt->bind_param("i", $id)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $this->error = true;
            }

            $result = $stmt->get_result();
            $this->db->disconnect();
            return $this->db->nextResultRow($result);
        }

        public function store($category_name)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("INSERT INTO category(`name`) VALUES (?)")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            
            if (!$stmt->bind_param("s", $category_name)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
        public function update($id, $category_name)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("UPDATE category SET name = ? WHERE id = ? ")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

             /* Prepared statement, stage 2: bind and execute */
           
             if (!$stmt->bind_param("si", $category_name, $id)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }

        public function destroy($id)
        {    
            $this->clearError();  
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("DELETE FROM category WHERE `id` = ?")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            
            if (!$stmt->bind_param("i", $id)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $result = $stmt->get_result();
            $this->db->disconnect();
        }
    }
}
