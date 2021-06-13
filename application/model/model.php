<?php
	class Model {
		// Variable
		var $db;
		var $column;
		var $table;
		var $param;
		var $action;
		var $sql;

		// Construct
		function __construct($param) {
			$this->column = NULL;
			$this->param = $param;
			$this->db = new PDO("mysql:host=localhost; dbname=DBNAME; charset=utf8mb4", "ID", "PASSWORD");
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			if(issetOrNull($_POST, 'action')) {
				$this->action = $_POST['action'];
				$this->action();
			}
		}

		// Query
		function query($sql = false) {
			$sql && $this->sql = $sql;
			$res = $this->db->prepare($this->sql);
			if($res->execute($this->column)) {
				return $res;
			}
			/*
			else {
				print('<pre>');
				print($this->sql);
				print_r($this->column);
				print_r($this->db->errorInfo());
				print('</pre>');
			}
			*/
		}

		// Fetch
		function fetch($sql = false) {
			$sql && $this->sql = $sql;
			return $this->query($this->sql)->fetch();
		}

		// FetchAll
		function fetchAll($sql = false) {
			$sql && $this->sql = $sql;
			return $this->query($this->sql)->fetchAll();
		}

		// Count
		function count($sql = false) {
			$sql && $this->sql = $sql;
			return $this->query($this->sql)->rowCount();
		}

		// Column
		function getColumn($arr, $cancel) {
			$column = '';
			$cancel = explode('/', $cancel);
			foreach ($arr as $key => $value) {
				if (!in_array($key, $cancel)) {
					$column .= ", {$key} = :{$key}\n";
					$this->column[$key] = $value;
				}
			}
			return $column = substr($column, 2);
		}

		// QueryResult
		function combine($column) {
			switch ($this->action) {
				case 'insert': $sql = " INSERT INTO {$this->table} set \n"; break;
				case 'update': $sql = " UPDATE {$this->table} set \n"; break;
				case 'delete': $sql = " DELETE FROM {$this->table} \n"; break;
			}
			return $sql .= $column;
		}
	}