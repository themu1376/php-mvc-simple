<?php
class DummyVO extends VO {
	private $name;
	private $hobby;

	function _name() { return $this->name; }
	function _hobby() { return $this->hobby; }
	function __construct($dto) {
		foreach ($dto as $key => $value) {
			$this->$key = $value;
		}
	}
	function __get($name) {
		switch ($name) {
			case 'hobby_upper':
				return strtoupper($this->hobby);
			default:
				return $this->$name;
		}
	}
}