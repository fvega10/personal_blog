<?php
	namespace EasilyPHP\View{
		class ViewFactory{
			private $view = null;
			private $data = null;

			public function __construct($view, $data = []){
				$this->view = VIEWS . '/'. $view;
				$this->data = $data;
			}

			public function render()
			{
				extract($this->data);
				include_once $this->view;
			}
		}
	}