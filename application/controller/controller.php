<?php

trait Ajax {
	function printJson($dictionary) {
		print(json_encode($dictionary));
	}

	function success($dictionary) {
		$this->printJson(array('result'=>'success', 'datas'=>$dictionary));
		exit();
	}

	function fail($dictionary) {
		$this->printJson(array('result'=>'fail', 'datas'=>$dictionary));
		exit();
	}
}
trait Html {
	private $title;

	function getTitle() {
		$this->title = 'UNTITLED';
	}

	function header() {
		$title = $this->title;
		require_once(_VIEW.'header.php');
	}

	function footer() {
		require_once(_VIEW.'footer.php');
	}

	function content() {
		extract( (array)$this );
		$view = _VIEW."{$this->param->controller}.php";
		if(file_exists($view)) require_once($view);
	}
}
abstract class Controller {
	private $method;
	private $isContentType;
	
	var $param;
	var $model;

	function __construct($param) {
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->isContentType = array(
			'ajax'=>isTrait($this, 'Ajax'),
			'html'=>isTrait($this, 'Html')
		);
		$ext = $this->isContentType['ajax'] ? 'json' : 'html';
		header("content-type: text/{$ext}; charset=utf8");
		$this->param = $param;
		$model = "{$this->param->controller}Model";
		file_exists(_MODEL.strtolower($model).'.php') && $this->model = new $model($this->param);
		$afterModel = 'afterModel';
		method_exists($this, $afterModel) && $this->$afterModel();
		$view = "{$this->param->controller}View";
		file_exists(_VIEW.strtolower($view).'.php') && $this->view = new $view($this->param);
		$this->index();
	}

	function index() {
		$this->action($this->param->action);
		$isHtml = $this->isContentType['html'];
		if ($isHtml) {
			$this->getTitle();
			$this->header();
			$this->content();
			$this->footer();
		}
	}

	function action($action) {
		$post_action = 'post_'.$action;
		if(method_exists($this, $post_action)&&$this->method=='POST') $this->$post_action();
		if(method_exists($this, $action)) $this->$action();
	}
}