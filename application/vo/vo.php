<?php
abstract class VO extends DTO {
}
/*
class ExtendsVO extends VO {
	function __construct($row) {
		parent::__construct($row);
		$parent = strtolower( get_parent_class($this) );
		$class = str_replace($parent, '', strtolower( get_class($this) ));
		$this->setTable($class);
		$this->setHeader(array_keys((array)$row));
		foreach ($row as $key => $value) $this->{$key} = $value;
	}
}
*/