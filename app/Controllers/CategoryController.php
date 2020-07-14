<?php namespace MyApp\Controllers
{
	use MyApp\Models\Category;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class CategoryController
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
			$this->userModel  = new Category($this->config);
			$collection       = $this->userModel->getAllCategories();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("categories/index.php", compact("collection", "message", "lang"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null, true);
				return view("categories/index.php", compact("message"));
			endif;
		}
		public function create()
		{
			$createBack = $this->createBack;
			$lang       = $this->lang;
			$message    = $this->message;
			return view("categories/create.php", compact("createBack", "lang", "message"));
		}
		public function store()
		{
			$category_name = isset($_POST['category_name']) ? $_POST['category_name'] : null;
			$this->createBack = [
				'category_name' => $category_name
			];
			if($category_name != null)
			{
				if(!$this->filterDB($category_name))
				{
					$this->create();
				}
				else
				{
					$this->userModel  = new Category($this->config);
					$collection       = $this->userModel->store($category_name);
					if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
						$this->message->setSuccessMessage(null, "Registrado agregado exitosamente.", null);
						$this->index();
					else :
						$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
						$this->index();
					endif;
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
			$id   = isset($_GET['id']) ? $_GET['id'] : null ;
			if($id != null)
			{
				$this->userModel  = new Category($this->config);
				$collection       = $this->userModel->getCategoryById($id);
				if(!$this->userModel->isError() && !is_null($collection)) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
					return view("categories/edit.php", compact("collection", "lang"));
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
			$category_name = isset($_POST['category_name']) ? $_POST['category_name'] : null;
			if(!is_null($category_name))
			{
				if(!$this->filterDB($category_name))
				{
					$this->edit();
				}else
				{
					$this->userModel  = new Category($this->config);
					$collection       = $this->userModel->update($id, $category_name);
					if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
						$this->message->setSuccessMessage(null, "Registrado editado exitosamente.", null, true);
						$this->index();
					else :
						$this->message->setWarningMessage(null, "El registro no se pudo editar. Intente nuevamente", null, true);
						$this->index();
					endif;
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
				$this->userModel  = new Category($this->config);
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
		private function filterDB($name)
		{
			$continue  = true;
			$flagError = "";
			if(strlen($name) > 150)
			{
				$continue = false;
				$flagError = $flagError . strlen($name) . " de	 150." . "\n";  
			}
			if(!$continue)
			{
				$msg = "El nombre de la categoría contiene más carácteres de los permitidos: " . $flagError;
				$this->message->setWarningMessage(null, $msg, null, true);
				return false;
			}
			else
			{
				return true;
			}
		}
	}
}