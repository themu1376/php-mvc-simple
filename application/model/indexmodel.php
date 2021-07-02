<?php
class IndexModel extends Model {
	function dummy() {
		return new DummyDTO( array(
			'name' => 'test',
			'hobby' => 'programming',
		));
	}
}