<?php namespace MyApp\Controllers
{
	use MyApp\Models\Application;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class ApplicationController
	{
		private $config     = null;
		private $userModel  = null;
		private $message    = null;
		private $lang       = null;
		private $createBack = null;
		public function __construct($config)
		{
			$this->config = $config;
			$this->message = new Message();
			$this->lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';	
			$this->setLanguage();
		}
		private function setLanguage()
		{
			if($this->lang == 'es')
		    {
		      $this->lang = new Spanish();
		    }
		    else
		    {
		      $this->lang = new English();
		    }
		}
		public function index()
		{
			$lang             = $this->lang;
			$message          = $this->message;
			$this->userModel  = new Application($this->config);
			$collection       = $this->userModel->getAllApplications();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("applications/index.php", compact("collection", "message", "lang"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null, true);
				return view("applications/index.php", compact("message"));
			endif;
		}
		public function create()
		{
			$createBack = $this->createBack;
			$lang       = $this->lang;
			$message    = $this->message;
			return view("applications/create.php", compact("createBack", "lang", "message"));
        }
		public function store()
		{
			$name = isset($_POST['name']) ? $_POST['name'] : null;
			$link = isset($_POST['link']) ? $_POST['link'] : null;
			$img  = isset($_FILES['img']) ? $_FILES['img'] : null;

			$this->createBack = [
				'name' => $name
			];
			if(!is_null($name) && !is_null($link) && !is_null($img))
			{
				if(!$this->filterDB($name, $link))
				{
					$this->create();
				}
				else
				{
					if(!$this->existFile($img))
					{
						$ruta = '/assets/media/fvega_online/' . $img['name'];
						$this->userModel  = new Application($this->config);
						$collection       = $this->userModel->store($name, $link, $ruta);
						if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
							if($this->saveImg($img))
							{
								$this->message->setSuccessMessage(null, "Registrado agregado exitosamente.", null);
								$this->index();
							}
							else{
								$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
								$this->index();
							}
						else :
							$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
							$this->index();
						endif;
					}
					else
					{
						$this->message->setWarningMessage(null, "Ya existe una imágen almacenada con el mismo nombre. Intente nuevamente", null);
						$this->index();
					}
				}
			}
			else
			{
				$this->message->setWarningMessage(null, "Para crear un nuevo elemento debes anotar el Nombre de la categoría", null);
				$this->create();
			}
		}
		public function edit()
		{
			$lang = $this->lang;
			$id   = isset($_GET['id']) ? $_GET['id'] : null;
			if(!is_null($id))
			{
				$this->userModel  = new Application($this->config);
				$collection       = $this->userModel->getApplicationById($id);
				if(!$this->userModel->isError() && !is_null($collection)) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
					return view("applications/edit.php", compact("collection", "lang"));
				else :
					$this->message->setDangerMessage(null, "Registro indicado no existe. Vuelta a intentar", null, true);
					$this->index();
				endif;
			}
			else
			{
				$this->message->setWarningMessage(null, "Debe elegir el proyecto que desea editar", null, true);
				$this->index();
			}
		}
		public function update()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$name = isset($_POST['name']) ? $_POST['name'] : null;
			$link = isset($_POST['link']) ? $_POST['link'] : null;
			$img  = isset($_FILES['img']) ? $_FILES['img'] : null;
			$sameImg = isset($_POST['sameImg']) ? $_POST['sameImg'] : null;
			
			$this->createBack = [
				'name' => $name,
				'link' => $link,
				'img' => $img,
				'sameImg' => $sameImg
			];

			if(!is_null($name) && !is_null($link) && $img['error'] == 0)
			{
				if(!$this->filterDB($name, $link))
				{
					$this->edit();
				}else
				{
					if($sameImg == 'on')
					{
						$this->userModel  = new Application($this->config);
						$collection       = $this->userModel->updateWithOutImg($id, $name, $link);
						if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
							$this->message->setSuccessMessage(null, "Registrado editado exitosamente.", null);
							$this->index($login);
						else :
							$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
							$this->index($login);
						endif;
					}
					else
					{
						if(!$this->existFile($img))
						{
							$ruta = '/assets/media/fvega_online/' . $img['name'];
							$this->userModel  = new Application($this->config);
							$collection       = $this->userModel->update($id, $name, $link, $ruta);
							if(!$this->userModel->isError())
							{ //Si el método isError es falso continue, en caso contrario retorne vista de error;
								if($this->saveImg($img))
								{	
									$this->message->setSuccessMessage(null, "Registrado editado exitosamente.", null);
									$this->index();	
								}
							}else{
								$this->message->setWarningMessage(null, "El registro no se pudo editar. Intente nuevamente", null);
								$this->index();
							}
						}else{
							$this->message->setWarningMessage(null, "Ya existe una imágen con ese mismo nombre. Intente nuevamente.", null);
							$this->index();
						}
					}
				}
			}
			else
			{
				$this->message->setWarningMessage(null, "El nombre de la categoría está vacío.", null, true);
				$this->edit();
			}
		}
		public function destroy()
		{
            $id      = isset($_GET['id']) ? $_GET['id'] : null;
			if($id != null)
			{
				$this->userModel  = new Application($this->config);
				$collection       = $this->userModel->destroy($id);
				if(!$this->userModel->isError())
				{
					$this->message->setSuccessMessage(null, "Registro eliminado exitosamente.", null, true);
					$this->index();
				}else
				{
					$this->message->setDangerMessage(null, "Ocurrió un error inesperado.", null, true);
					$this->index();
				}
			}
			else
			{
				$this->message->setWarningMessage(null, "Debe elegir la categoría que desea eliminar", null, true);
				$this->index();
			}
		}
		private function filterDB($name, $link)
		{
			$continue  = true;
			$flagError = "";
			if(strlen($name) > 150)
			{
				$continue = false;
				$flagError = $flagError . strlen($name) . " de	 150." . "\n";  
			}
			if(strlen($link) > 150)
			{
				$continue = false;
				$flagError = $flagError . strlen($link) . " de	 150." . "\n";  
			}
			if(!$continue)
			{
				$msg = "El nombre de la aplicación contiene más carácteres de los permitidos: " . $flagError;
				$this->message->setWarningMessage(null, $msg, null, true);
				return false;
			}
			else
			{
				return true;
			}
        }
        private function existFile($img)
		{
			$ruta = MEDIA . '/' . "fvega_online" .'/'; //Aqui va el ID del usuario;
			$archivo = $ruta . $img['name']; //Asigna la ruta en donde se debe almacenar la imagen
			if(file_exists($archivo)) :
				return true;
			else :
				return false;
			endif;
		}
		private function saveImg($img)
		{
			$permission = array("image/gif", "image/jpg", "image/png", "image/jpeg");
			if(in_array($img["type"], $permission))
			{
				$ruta = MEDIA . '/' . "fvega_online" .'/'; //Aqui va el ID del usuario;
				$archivo = $ruta . $img['name']; //Asigna la ruta en donde se debe almacenar la imagen
				
				if(!file_exists($ruta))
				{
					mkdir($ruta);
				} 
				if(!file_exists($archivo))
				{
					$resultado = @move_uploaded_file($img["tmp_name"], $archivo);
					if($resultado)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					$this->message->setWarningMessage(null, "Ya existe un archivo con ese nombre. Pruebe cambiado el nombre e intente nuevamente.", null);
					$this->create();
				}
			}
			else
			{
				$this->message->setWarningMessage(null, "El archivo debe ser una imagen con extensión: png, jpg, jpeg o gif", null);
				$this->create();
			}
		}
	}
}