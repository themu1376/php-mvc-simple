<?php
	abstract class Model {
		private $db;
		const HOST = 'localhost';
		const DBNAME = 'DBNAME';
		const USER = 'USER';
		const PASS = 'PASS';

		function __construct($param) {
			$this->db = new PDO (
				"mysql:host=" . $this::HOST .
				"; dbname=" . $this::DBNAME .
				"; charset=utf8mb4", $this::USER, $this::PASS
			);
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}

		function query($sql) {
			$res = $this->db->query($sql);
			if ($res === false)
				throw new Exception("Query fail.");
			return $res;
		}
		// fetch(), fetchAll(), rowCount()
	}