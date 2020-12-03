<?php namespace MyApp\Controllers
{
	use MyApp\Models\Post;
	use MyApp\Models\Category;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class PostController
	{
		private $login      = null;
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
		public function information()
		{
			$lang             = $this->lang;
			$this->userModel  = new Post($this->config);
			$collection       = $this->userModel->getAllPosts();
			$applications     = $this->userModel->getAllApplications();
			$counter		  = $this->userModel->setCounter();
			$counter		  = $this->userModel->getCounter();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("dashboard.php", compact("collection", "lang", "counter", "applications"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				return view("dashboard.php", compact("collection", "lang", "message", "counter"));
			endif;
		}
		public function index()
		{
			$lang             = $this->lang;
			$message          = $this->message;
			$this->userModel  = new Post($this->config);
			$collection       = $this->userModel->getAllPosts();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("posts/index.php", compact("collection", "message", "lang"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				return view("posts/index.php", compact("message"));
			endif;
		}
		public function create()
		{
			$createBack = $this->createBack;
			$lang       = $this->lang;
			$message    = $this->message;
			//Se necesita llamar las categorías para cargas el select del HTML
			$this->userModel  = new Category($this->config);
			$collection       = $this->userModel->getAllCategories();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("posts/create.php", compact("collection", "message", "lang"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				return view("posts/index.php", compact("message"));
			endif;
		}
		public function store()
		{
			$user_id = '1'; //Se supone que solo hay un usuario, caso contrario se debe buscar la forma de validar esto
			$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
			$date_post = isset($_POST['date_post']) ? $_POST['date_post'] : null;
			$tittle = isset($_POST['tittle']) ? $_POST['tittle'] : null;
			$long_description = isset($_POST['long_description']) ? $_POST['long_description'] : null;
			$short_description = isset($_POST['short_description']) ? $_POST['short_description'] : null;
			$link = isset($_POST['link']) ? $_POST['link'] : null;
			$img = isset($_FILES['img']) ? $_FILES['img'] : null;
			$this->createBack = [
				'category_id' => $category_id,
				'date_post' => $date_post,
				'tittle' => $tittle,
				'long_description' => $long_description,
				'short_description' => $short_description,
				'link' => $link,
				'img' => $img
			];
			if($img['error'] == 0 || 
			!is_null($category_id) || 
			!is_null($date_post) || 
			!is_null($tittle) || 
			!is_null($long_description) || 
			!is_null($short_description))
			{
				if(!$this->correctFormat($tittle, $long_description, $short_description))
				{
					$this->index();
				}
				else
				{
					if(!$this->existFile($img))
					{
						$ruta = '/assets/media/fvega_online/' . $img['name'];
						$this->userModel  = new Post($this->config);
						$collection       = $this->userModel->store($user_id, $category_id, $date_post, $tittle, $long_description, $short_description, $link, $ruta);
						if(!$this->userModel->isError())
						{ //Si el método isError es falso continue, en caso contrario retorne vista de error;
							if($this->saveImg($img))
							{	
								$this->message->setSuccessMessage(null, "Registrado agregado exitosamente.", null);
								$this->index();	
							}
						}else{
							$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
							$this->index();
						}
					}else{
						$this->message->setWarningMessage(null, "Ya existe una imágen con ese mismo nombre. Intente nuevamente.", null);
						$this->index();
					}
				}
			}
			else
			{
				$this->message->setWarningMessage(null, "Algunos registros están vacíos.", null);
				$this->create();
			}
		}

		public function show()
		{
			$id               = isset($_GET['id']) ? $_GET['id'] : null;
			$lang             = $this->lang;
			$message          = $this->message;
			if(is_null($id))
			{
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				$this->index();
			}
			else
			{
				$this->userModel  = new Post($this->config);
				$collection       = $this->userModel->getPostById($id);
				$allPosts		  = $this->userModel->getAllPosts();
				$visit 			  = $this->userModel->getLikes();
				$myip			  = $this->myIp();
				if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
					return view("posts/show.php", compact("collection", "message", "lang", "allPosts", "visit", "myip"));
				else :
					$message = $this->message->setDangerMessage(null, "No se encontró un Post con los datos proporcionados.", null);
					$this->index();	
				endif;
			}
		}
		
		public function edit()
		{
			$id               = isset($_GET['id']) ? $_GET['id'] : null;
			$lang             = $this->lang;
			$message          = $this->message;
			if(is_null($id))
			{
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				$this->index();
			}
			else
			{
				$this->userModel  = new Post($this->config);
				$collection       = $this->userModel->getPostById($id);
				$CateModel        = new Category($this->config);
				$categories		  = $CateModel->getAllCategories();
				if(!$this->userModel->isError() && !$CateModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
					return view("posts/edit.php", compact("collection", "message", "lang", "categories"));
				else :
					$message = $this->message->setDangerMessage(null, "No se encontró un Post con los datos proporcionados.", null);
					$this->index();	
				endif;
			}
		}
		public function update()
		{
			$id          = isset($_GET['id']) ? $_GET['id'] : null;
			$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
			$date_post = isset($_POST['date_post']) ? $_POST['date_post'] : null;
			$tittle = isset($_POST['tittle']) ? $_POST['tittle'] : null;
			$long_description = isset($_POST['long_description']) ? $_POST['long_description'] : null;
			$short_description = isset($_POST['short_description']) ? $_POST['short_description'] : null;
			$link = isset($_POST['link']) ? $_POST['link'] : null;
			$img = isset($_FILES['img']) ? $_FILES['img'] : null;
			$sameImg = isset($_POST['sameImg']) ? $_POST['sameImg'] : null;
			
			$this->createBack = [
				'category_id' => $category_id,
				'date_post' => $date_post,
				'tittle' => $tittle,
				'long_description' => $long_description,
				'short_description' => $short_description,
				'link' => $link,
				'img' => $img
			];
			
			if($img['error'] == 0 || 
			!is_null($category_id) && 
			!is_null($date_post) && 
			!is_null($tittle) && 
			!is_null($long_description) && 
			!is_null($short_description))
			{
				if(!$this->correctFormat($tittle, $long_description, $short_description))
				{
					$this->index();
				}
				else
				{
					if($sameImg == 'on')
					{
						$this->userModel  = new Post($this->config);
						$collection       = $this->userModel->updateWithOutImg($id, $category_id, $date_post, $tittle, $long_description, $short_description, $link);
						if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
							$this->message->setSuccessMessage(null, "Registrado agregado exitosamente.", null);
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
							$this->userModel  = new Post($this->config);
							$collection       = $this->userModel->update($id, $category_id, $date_post, $tittle, $long_description, $short_description, $link, $ruta);
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
				$this->message->setWarningMessage(null, "Algunos registros están vacíos.", null);
				$this->create();
			}
		}

		public function destroy()
		{
            $id      = isset($_GET['id']) ? $_GET['id'] : null;

			if(!is_null($id))
			{
				$this->userModel  = new Post($this->config);
				$collection       = $this->userModel->destroy($id);
				if(!$this->userModel->isError()) :
					$this->message->setSuccessMessage(null, "Registro eliminado exitosamente.", null);
					$this->index();
				else :
					$this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
					$this->index();
				endif;
			}
			else
			{
				$this->message->setWarningMessage(null, "Debe elegir el post que desea eliminar", null);
				$this->index();
			}
		}
		private function correctFormat($tittle, $long_description, $short_description)
		{
			$continue  = true;
			$flagError = "";
			if(strlen($tittle) > 150)
			{
				$continue = false;
				$flagError = $flagError . $tittle . " " . strlen($tittle) . " de 150." . "\n";  
			}

			if(strlen($long_description) > 5000)
			{
				$continue = false;	
				$flagError = $flagError . $sub_tittle . " " . strlen($long_description) . " de 5000." . "\n";
			}

			if(strlen($short_description) > 1000)
			{
				$continue = false;
				$flagError = $flagError . $short_description . " " . strlen($short_description) . " de 1000" . "\n";
			}

			if(!$continue)
			{
				$msg = "Los siguiente registros contienen más carácteres de los permitidos: \n" . $flagError;
				$this->message->setWarningMessage(null, $msg, null);

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
		public function like()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : null;
			$this->userModel  = new Post($this->config);
			$collection       = $this->userModel->postIp($this->myIp());
			$like       	  = $this->userModel->postLike($id);

			if(!$this->userModel->isError()) :
				$this->message->setSuccessMessage(null, $this->lang->lang['Likes'], null);
				$this->show();
			else :
				$this->show();
			endif;
		}
		private function myIp()
		{
			if (isset($_SERVER["HTTP_CLIENT_IP"]))
			{
				return ($_SERVER["HTTP_CLIENT_IP"]);
			}
			elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			{
				return ($_SERVER["HTTP_X_FORWARDED_FOR"]);
			}
			elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
			{
				return ($_SERVER["HTTP_X_FORWARDED"]);
			}
			elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
			{
				return ($_SERVER["HTTP_FORWARDED_FOR"]);
			}
			elseif (isset($_SERVER["HTTP_FORWARDED"]))
			{
				return ($_SERVER["HTTP_FORWARDED"]);
			}
			else
			{
				return ($_SERVER["REMOTE_ADDR"]);
			}
		}
	}
}