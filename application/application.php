<?php
	class Application {
		private $param;

		function __construct() {
			$this->getParam();
			$controller = "{$this->param->controller}controller";
			new $controller($this->param);
		}

		private function getParam() {
			$get = issetOrNull($_GET, 'param') ? explode('/', $_GET['param']) : array();
			$param = (object) array();
			$param->controller = issetOrNull($get, 0, 'index');
			$param->action = issetOrNull($get, 1, 'base');
			$this->param = $param;
			if( method_exists($this, $param->controller) ) $this->{$param->controller}($get);
		}

		private function api($get) {
			// $this->param->resource = $this->param->action;
			// $this->param->action = 'base';
		}

		private function index($get) {}
	}