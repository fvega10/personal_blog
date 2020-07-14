<?php
	if(!function_exists('view')){
		/**
		 * Retorna una instancia de una vista con parámetros
		 *
		 * @param null $view
		 * @param array $data
		 * @return mixed
		 */

		function view($view = null, $data = [])
		{
			$factory = new EasilyPHP\View\ViewFactory($view, $data);
			return $factory->render();
		}
	}