<?php

	function __autoload($className) {
		$lowerClassName = strtolower($className);
		$baseClassName = preg_replace('/(.*)(model|application|vo)/', '$2', $lowerClassName);
		switch ($baseClassName) {
			case 'application': $dir = _APP; break;
			case 'model': $dir = _MODEL; break;
			case 'vo': $dir = _VO; break;
			default: $dir = _CONTROLLER; break;
		}
		require_once("{$dir}{$lowerClassName}.php");
	}

	function issetOrNull($array, $key, $default = NULL) {
		return array_key_exists($key, $array) ? (is_array($array) ? $array[$key] : $array->$key) : $default;
	}

	function isTrait( $object, $traitName, $autoloader = true )
	{
		$ret = class_uses( $object, $autoloader ) ;
		if( is_array( $ret ) )
		{
			$ret = array_search( $traitName, $ret ) !== false ;
		}
		return $ret ;
	}

	function printObject($object) {
		printArray((array) $object);
	}

	function printArray($array) {
		header("content-type: text/html; charset=utf8");
		print('<pre>');
		print_r($array);
		print('</pre>');
		exit();
	}
		
	function generateToken($length=6) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	function tag($name, $properties=[]) {
		return new Tag($name, $properties);
	}
	class Tag {
		var $name;
		var $children;
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
		public function __destruct() {
			print("</{$this->name}>");
		}
		public function close() {
			unset($this);
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
	