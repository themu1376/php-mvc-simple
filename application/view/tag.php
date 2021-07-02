<?php
function tag($name, $properties=[]) {
	return new Tag($name, $properties);
}
class Tag {
	var $name;
	var $children;
	private $isClosed;
	public function __construct($name, $properties=[]) {
		$this->name = $name;
		$this->children = array();
		print("<{$name}");
		if(is_array($properties)) {
			foreach($properties as $i => $property) {
				if(is_array($property)) {
					foreach($property as $key => $value) {
						print(" $key=\"$value\"");
					}
				}
				else {
					print(' '.$property);
				}
			}
		}
		else {
			print(' '.$properties);
		}
		print(">");
	}
	private function printIfNotClosed() {
		if (!$this->isClosed) {
			$this->isClosed = true;
			print("</{$this->name}>");
		}
	}
	public function __destruct() {
		$this->printIfNotClosed();
	}
	public function close() {
		$this->printIfNotClosed();
		// unset($this);
	}
	public function text($val) {
		print($val);
		return $this;
	}
	public function addChild($obj) {
		array_push($this->children, $obj);
		return $this;
	}
	public function call($func, $params) {
		$func($params);
		return $this;
	}
	public function debug() {
		printArray($this);
	}
}
