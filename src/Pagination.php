<?php

namespace Widevel\SmartlogViewer;

class Pagination {
	private $skip, $limit, $page, $pages;

	public function __construct(int $limit, int $page = 1) {
		$this->limit = $limit;
		$this->skip = (int)($this->limit * ($page - 1));
		
	}

	public function setCount(int $count) {
		$this->pages = (int) $count / $this->limit;
	}

	public function getMongoSkip() :int { return $this->skip; }
	public function getPagesCount() :int { return $this->pages; }

}