<?php
class IndexView {

	function out($dto) {
		$dummy = new DummyVO($dto);
		tag('div')->addChild(
			tag('h3')->text('My Infomation. Welcome.')->close()
		)->addChild(
			tag('p')->text($dummy->name)->close()
		)->addChild(
			tag('p')->text($dummy->hobby)->close()
		)->addChild(
			tag('p')->text($dummy->hobby_upper)->close()
		);
		// printArray($dummy);
	}

}