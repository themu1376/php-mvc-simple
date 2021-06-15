<?php
	abstract class VO {
		private $table;
		private $header;

		function __construct($row) {}
		function __get($name) {}

		function makeSqlInsert() {
			$sql = "INSERT INTO `{$this->table}`(";
			foreach ($this->header as $key => $value) {
				$sql .= ($key == 0 ? '' : ',') . "`" . ($value) . "`";
			}
			$sql .= ") VALUES(";
			foreach ($this->header as $key => $value) {
				$sql .= ($key == 0 ? '' : ',') . ($this->$value=='NULL'?'':"\"") . str_replace('"', '""', $this->$value) . ($this->$value=='NULL'?'':"\"");
			}
			$sql .= ");";
			return $sql;
		}

		function setTable($name) {
			$this->table = $name;
		}

		function setHeader($keys) {
			$this->header = $keys;
		}

		function printHeader($len = -1) {
			print("<tr>");
			foreach ($this->header as $i => $key) {
				if ($len>0 && $len<=$i)
					break;
				print("<th>" . $key . "</th>");
			}
			print("</tr>");
		}

		function printRecord($len = -1) {
			print("<tr>");
			foreach ($this->header as $i => $key) {
				if ($len>0 && $len<=$i)
					break;
				print("<td> {$this->$key} </td>");
			}
			print("</tr>");
		}
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