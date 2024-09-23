<?php
namespace MyApp\Models{
    use \EasilyPHP\Database\DBMySQL;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

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
        public function sendEmailContact($nombre, $email, $subject, $message_text)
        {
            require VENDOR . '/autoload.php';
            $mail = new PHPMailer(true);
			$nombre       = $nombre != "" ? $nombre : null;
			$email        = ($email) != "" ? $email : null;
			$subject      = ($subject) != "" ? $subject : null;
			$message_text = ($message_text) != "" ? $message_text : null;
			
			
			
            try {
				if(!is_null($nombre) && !is_null($email) && !is_null($subject) && !is_null($message_text))
				{		
					
					$mail->SMTPDebug = 0;
					$mail->isSMTP();
					
					//$mail->CharSet    = 'UTF-8';
					//$mail->Encoding   = 'base64';
					//$mail->Host       = 'smtp.office365.com';
					//$mail->SMTPAuth   = true;
					//$mail->Username   = 'fvegau@fabriciovega.com';
					//$mail->Password   = "Serenid4d$34";
					//$mail->SMTPSecure = 'tls';
					//$mail->Port = 587;
					
					$mail->CharSet    = 'UTF-8';
					$mail->Encoding   = 'base64';
					$mail->Host       = 'a2plcpnl0823.prod.iad2.secureserver.net';
					$mail->SMTPAuth   = true;
					$mail->Username   = 'support@favitae.info';
					$mail->Password   = "Bb1357Zz";
					$mail->SMTPSecure = 'tls';
					$mail->Port = 25;
					## MENSAJE A ENVIAR
					$mail->setFrom($email);
					$mail->addAddress('fvegau@fabriciovega.com');
					$mail->isHTML(true);
					$mail->Subject = 'Consulta Sitio Web';
					$mail->Body   =  "Nombre: " . $nombre . "\n" . "Correo: " . $email . "\n\n" . "Sitio Web N: " . $subject . "\n\n" . $message_text;
					
					if($mail->send())
					{
						$this->error = false;
					}
					else
					{
						$this->$msg = $mail->ErrorInfo;
						$this->error = true;
					}
				}
				else
				{
					$this->$msg  = "Todos los campos son requeridos - All inputs are required";
					$this->error = true;
				}
            } catch (Exception $exception) {
                $this->msg = $exception->getMessage();
                $this->error = true;
            }
        }
    }
}

