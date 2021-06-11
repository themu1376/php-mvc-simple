<?php
	class Controller {
		// Variable
		var $param;
		var $db;
		var $title;
		var $setAjax;

		// Value or NULL
		function issetOrNull($var, $default = NULL) {
			return isset($var) && $var != '' ? $var : $default;
		}

		// Construct
		function __construct($param) {
			header('content-type: text/html; charset=utf8');
			$this->param = $param;
			$modelName = "{$this->param->action}Model";
			$this->db = new $modelName($this->param);
			$this->setAjax = false;
			$this->index();
		}

		// Index
		function index() {
			$base = 'base';
			if(method_exists($this, $base)) $this->$base();
			$this->getTitle();
			$this->header();
			$this->content();
			$this->footer();
		}

		// Header
		function header() {
			$this->setAjax || require_once(_VIEW.'header.php');
		}

		// Footer
		function footer() {
			$this->setAjax || require_once(_VIEW.'footer.php');
		}

		// Content
		function content() {
			$this_arr = (array)$this;
			extract($this_arr);
			$dir = _VIEW."{$this->param->include_file}.php";
			if(file_exists($dir)) require_once($dir);
		}

		// getTitle
		function getTitle() {
			$this->title = 'UNTITLED';
		}
	}