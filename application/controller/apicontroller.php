<?php
class ApiController extends Controller {
	use Ajax;

	function post_base() {
	}

	function base() {
		print(json_encode(array(
			'test'=>'bbb',
		)));
	}
}