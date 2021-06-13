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

		// Get Param
		function getParam() {
			if (isset($_GET['param'])) {
				$get = explode('/', $_GET['param']);
			}
			$param = [];
			$param['action'] = issetOrNull($get, 0, 'index');
			$param['id'] = issetOrNull($get, 1);
			$param['include_file'] = $param['action'];
			
			$this->param = (object)$param;
		}
	}