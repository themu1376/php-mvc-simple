<?php
abstract class DTO {
	function __construct($row) {
		foreach ($row as $key => $value) {
			$this->$key = $value;
		}
	}
	function __get($name) {
		$_name = '_'.$name;
		$isInheritedPrivate = method_exists($this, $_name);
		return $isInheritedPrivate?$this->$_name():$this->$name;
	}
}
/*
class ExtendsDTO extends DTO {
	function __construct($row) {
		parent::__construct($row);
	}
}
*/