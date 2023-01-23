<?php

class Core
{
	// puroperutisu
	public $currentController = 'Landingpages';
	public $currentMethod = 'index';
	public $params = [];

	// constructor
	public function __construct()
	{
		$url = $this->getURL();

		if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
			$this->currentController = ucwords($url[0]);
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->currentController . '.php';

		$this->currentController = new $this->currentController();

		if (isset($url[1])) {
			if (method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}

		// params list for the method in controllerclass
		$this->params = $url ? array_values($url) : [];

		// the controller method is called
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
	}

	public function getURL()
	{

		if (isset($_GET['url'])) {
			$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			return $url;
		} else {
			return array('Landingpages', 'index');
		}
	}
}
