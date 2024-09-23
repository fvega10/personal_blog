<?php
namespace MyApp\Models{
    use \EasilyPHP\Database\DBMySQL;

    class Post
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
        public function getLikes()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT ip FROM visit");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }
        public function postIp($ip)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("INSERT INTO visit(`ip`) VALUES (?)")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            
            if (!$stmt->bind_param("s", $ip)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
        public function postLike($id)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("UPDATE post set counter_likes = counter_likes + 1 WHERE id = ?")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            if (!$stmt->bind_param("i", $id)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
        public function setCounter()
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("UPDATE visit_counter set cont = cont + 1")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }

        public function getCounter()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT cont FROM visit_counter");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }
        public function getAllApplications()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT * FROM applications");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }
        public function getAllPosts()
        {
            $this->clearError();
            $this->db->connect();
            $result = $this->db->runSql("SELECT p.*, c.name, u.fullname FROM post p, category c, users u WHERE p.category_id = c.id AND p.user_id = u.id;");
            $this->db->disconnect();
            return $this->db->getAll($result);
        }

        public function getPostById($id)
        {
            $this->clearError();
            $this->db->connect();

            /* Prepared statement, stage 1: prepare */
            if (!($stmt = 
                $this->db->prepareSql("SELECT p.*, c.name, u.fullname FROM post p, category c, users u WHERE p.category_id = c.id AND p.user_id = u.id AND p.id = ?"))) {
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

        public function store($user_id, $category_id, $date_post, $tittle, $long_description, $short_description, $link, $img)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("INSERT INTO post(`user_id`, `category_id`, `date_post`, `tittle`, `long_description`, `short_description`, `link`, `img`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

            /* Prepared statement, stage 2: bind and execute */
            
            if (!$stmt->bind_param("isssssss", $user_id, $category_id, $date_post, $tittle, $long_description, $short_description, $link, $img)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
        public function updateWithOutImg($id, $category_id, $date_post, $tittle, $long_description, $short_description, $link)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("UPDATE post SET category_id = ?, date_post = ?, tittle = ?, long_description = ?, short_description = ?, link = ?, date_modified = (SELECT NOW()) WHERE id = ? ")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

             /* Prepared statement, stage 2: bind and execute */
           
             if (!$stmt->bind_param("ssssssi", $category_id, $date_post, $tittle, $long_description, $short_description, $link, $id)) {
                $this->msg = "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                $this->error = true;
                $this->msg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->db->disconnect();
        }
        public function update($id, $category_id, $date_post, $tittle, $long_description, $short_description, $link, $img)
        {
            $this->clearError();
            $this->db->connect();
            
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $this->db->prepareSql("UPDATE post SET category_id = ?, date_post = ?, tittle = ?, long_description = ?, short_description = ?, link = ?, img = ?, date_modified = (SELECT NOW()) WHERE id = ? ")))
            {
                
                $this->msg = "Prepare failed: (" . $this->db->getError() . ") " . $this->db->getErrorMessage();
            }

             /* Prepared statement, stage 2: bind and execute */
           
             if (!$stmt->bind_param("sssssssi", $category_id, $date_post, $tittle, $long_description, $short_description, $link, $img, $id)) {
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
            if (!($stmt = $this->db->prepareSql("DELETE FROM post WHERE `id` = ?")))
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
