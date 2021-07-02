<?php
class IndexController extends Controller {
	use Html;
	var $view;
	var $dummy;

	function post_base() {
	}

	function base() {
	}

	function afterModel() {
		$this->dummy = $this->model->dummy();
	}
}