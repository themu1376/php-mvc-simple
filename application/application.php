<?php
	class Application {
		// Variable
		var $param;

		// Construct
		function __construct() {
			$this->getParam();
			$controller = $this->param->action.'controller';
			new $controller($this->param);
		}

		// Value or NULL
		function issetOrNull($var, $default = NULL) {
			return isset($var) && $var != '' ? $var : $default;
		}

		// Get Param
		function getParam() {
			if (isset($_GET['param'])) {
				$get = explode('/', $_GET['param']);
			}
			$param = [];
			$param['action'] = $this->issetOrNull($get[0], 'index');
			$param['id'] = $this->issetOrNull($get[1]);
			$param['include_file'] = $param['action'];
			
			$this->param = (object)$param;
		}
	}